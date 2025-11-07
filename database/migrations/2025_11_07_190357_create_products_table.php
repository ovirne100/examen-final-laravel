<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('products', function (Blueprint $table) {
            $table->id('idproduct');
            $table->string('name',150);
            $table->text('description')->nullable();
            $table->decimal('price',12,2)->default(0);
            $table->integer('quantity')->default(0);
            $table->string('image')->nullable();
            $table->foreignId('categories_idcategory')->nullable()->constrained('categories','idcategory')->nullOnDelete();
            $table->foreignId('companies_idcompany')->nullable()->constrained('companies','idcompany')->nullOnDelete();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('products');
    }
};
