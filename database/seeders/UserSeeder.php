<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'role_id' => 1,
            'password' => Hash::make('admin@gmail.com'),
            'created_at' => Carbon::now()->toDateTimeString(),
            'created_by' => null,
        ]);
    }
}
