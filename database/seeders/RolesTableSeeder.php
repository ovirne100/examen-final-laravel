<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['name' => 'Administrador'],
            ['name' => 'Supervisor'],
            ['name' => 'Empleado'],
            ['name' => 'Gerente'],
            ['name' => 'Cliente'],
            ['name' => 'Proveedor'],
            ['name' => 'Invitado'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
