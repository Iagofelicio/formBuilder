<?php

use FormBuilder\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Role::class, 1)
            ->create([
                'name' => 'Admin',
                'description' => "Administrador do sistema"
        ]);
        factory(Role::class, 1)
            ->create([
                'name' => 'Manager',
                'description' => "Criador de formulários"
        ]);
        factory(Role::class, 1)
            ->create([
                'name' => 'Guest',
                'description' => "Usuário convidado"
        ]);
    }
}
