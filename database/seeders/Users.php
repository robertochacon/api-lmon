<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'identification' => 40278234266,
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'remember_token' => null,
            'role' => 'admin',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        User::create([
            'identification' => 40278234266,
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => bcrypt('test'),
            'remember_token' => null,
            'role' => 'user',
            'created_at' => date("Y-m-d H:i:s")
        ]);

    }
}
