<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('idorder');
            $table->date('date')->nullable();
            $table->string('name_customer',100)->nullable();
            $table->string('address',255)->nullable();
            $table->string('phone',45)->nullable();
            $table->string('status',45)->nullable();
            $table->integer('quantity')->nullable();
            $table->foreignId('products_idproduct')->nullable()->constrained('products','idproduct')->nullOnDelete();
            $table->foreignId('services_idservice')->nullable()->constrained('services','idservice')->nullOnDelete();
            $table->foreignId('companies_idcompany')->nullable()->constrained('companies','idcompany')->nullOnDelete();
            $table->foreignId('users_iduser')->nullable()->constrained('users','iduser')->nullOnDelete();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('orders');
    }
};
