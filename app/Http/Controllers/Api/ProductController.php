<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // con esta ruta obtengo productos y productos filtrados GET /api/v1/products
    public function index(Request $request)
    {
        // filtros esperados
        $filters = [
            'name' => $request->query('name'),
            'category_id' => $request->query('category_id'),
            'company_id' => $request->query('company_id'),
            'price_min' => $request->query('price_min'),
            'price_max' => $request->query('price_max'),
            'stock_below' => $request->query('stock_below'),
        ];

        $include = $request->query('include'); // e.g. "category,company"
        $sort = $request->query('sort'); // e.g. -price
        $perPage = (int) $request->query('per_page', 15);

        $query = Products::query()
            ->filter($filters)
            ->include($include)
            ->sort($sort);

        $page = $query->paginate($perPage)->withQueryString();

        return response()->json($page);
    }

    // GET /api/v1/products/{product}
    public function show(Products $product, Request $request)
    {
        $include = $request->query('include');
        if ($include) $product->load(explode(',', $include));
        return response()->json($product);
    }

    // con esta ruta creo los products POST /api/v1/products
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'categories_idcategory' => 'nullable|exists:categories,idcategory',
            'companies_idcompany' => 'nullable|exists:companies,idcompany',
            'image' => 'nullable|image|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return response()->json(['errors'=>$validator->errors()], 422);

        $data = $request->only(['name','description','price','quantity','categories_idcategory','companies_idcompany']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products','public');
            $data['image'] = $path;
        }

        $product = Products::create($data);
        return response()->json($product->load('category','company'), 201);
    }

    // con esta ruta actualizo los products PUT/PATCH /api/v1/products/{product}
    public function update(Request $request, Products $product)
    {
        $rules = [
            'name' => 'sometimes|required|string|max:150',
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
            'quantity' => 'sometimes|required|integer|min:0',
            'categories_idcategory' => 'nullable|exists:categories,idcategory',
            'companies_idcompany' => 'nullable|exists:companies,idcompany',
            'image' => 'nullable|image|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return response()->json(['errors'=>$validator->errors()], 422);

        $data = $request->only(['name','description','price','quantity','categories_idcategory','companies_idcompany']);
        if ($request->hasFile('image')) {
            // borrar antigua si existe
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products','public');
        }

        $product->update($data);
        return response()->json($product->fresh()->load('category','company'));
    }

    // con esta ruta elimino products DELETE /api/v1/products/{product}
    public function destroy(Products $product)
    {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return response()->json(['message' => 'Producto eliminado correctamente']);
    }
}
