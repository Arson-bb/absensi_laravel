<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->updateOrInsert(['id' => 1], ['name' => 'admin']);
        DB::table('roles')->updateOrInsert(['id' => 2], ['name' => 'user']);
    }
}

