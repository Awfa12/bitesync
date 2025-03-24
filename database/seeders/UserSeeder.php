<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\RestaurantOwner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Admin
        Admin::create([
            'name' => 'Admin User',
            'email' => 'admin@bitesync.com',
            'password' => Hash::make('12345678'),
        ]);

        // Seed Restaurant Owner
        RestaurantOwner::create([
            'name' => 'Restaurant Owner',
            'email' => 'owner@bitesync.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
