<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                "name" => "admin",
                "company_name" => "field-it_Admin",
                "email" => "admin@fieldit.com",
                "password" => bcrypt("admin"),
                "status" => "3",
            ],
        ]);
    }
}
