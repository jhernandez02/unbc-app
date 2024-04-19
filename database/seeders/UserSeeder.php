<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // User::factory(10)->create();
        User::factory()->create([
            'name' => 'Test',
            'last_name' => 'User',
            'telephone'=> '+56 987654321',
            'email'=> 'test@example.com',
            'password'=> Hash::make('123456'),
            'status' => 'A',
        ]);
    }
}
