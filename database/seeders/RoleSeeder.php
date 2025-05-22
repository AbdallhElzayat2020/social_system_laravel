<?php

namespace Database\Seeders;

use App\Models\Authorization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [];

        foreach (config('authorizations.permissions') as $key => $value) {
            $permissions[$key] = $value;
        }

        Authorization::create([
            'role_name' => 'Super Admin',
            'status' => 'active',
            'permissions' => json_encode($permissions),
        ]);
    }
}
