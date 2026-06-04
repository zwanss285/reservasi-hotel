<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@hotel.com',
            'password' => Hash::make('1234'),
            'role' => 'admin',
        ]);

        // Customers
        $customers = [
            ['name' => 'Budi Santoso', 'email' => 'budi@customer.com'],
            ['name' => 'Ani Wijaya', 'email' => 'ani@customer.com'],
            ['name' => 'Citra Dewi', 'email' => 'citra@customer.com'],
            ['name' => 'Dedi Firmansyah', 'email' => 'dedi@customer.com'],
            ['name' => 'Eka Pratiwi', 'email' => 'eka@customer.com'],
        ];

        foreach ($customers as $customer) {
            User::create([
                'name' => $customer['name'],
                'email' => $customer['email'],
                'password' => Hash::make('123'),
                'role' => 'customer',
            ]);
        }

        $this->command->info('User berhasil dibuat!');
        $this->command->info('Admin: admin@hotel.com / password');
        $this->command->info('Customer: (nama)@customer.com / password');
    }
}