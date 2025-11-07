<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('companies', function (Blueprint $table) {
            $table->id('idcompany');
            $table->string('company_name',100);
            $table->string('legal_representative_name',100)->nullable();
            $table->string('legal_representative_lastname',100)->nullable();
            $table->string('legal_representative_dni',45)->nullable();
            $table->string('nit',45)->nullable();
            $table->string('person_type',45)->nullable();
            $table->string('legal_representative_email',100)->nullable();
            $table->string('terms_and_conditions')->nullable();
            $table->text('extra')->nullable();

            // ✅ Clave foránea corregida con motor InnoDB
            $table->unsignedBigInteger('users_iduser')->nullable();
            $table->foreign('users_iduser')
                  ->references('iduser')
                  ->on('users')
                  ->onDelete('set null');

            $table->timestamps();
        });

        //aqui use innoDB para que funcione la clave foranea y no me de errores al crear la migracion
        Schema::table('companies', function (Blueprint $table) {
            $table->engine = 'InnoDB';
        });
    }

    public function down(): void {
        Schema::dropIfExists('companies');
    }
};
