<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->has(UserDetail::factory()->state(fn($attributes, $user) => [
                'user_uuid' => $user->uuid,
            ]))
            ->create();

        // Access the detail like:
        $user = User::first();
        $userDetail = $user->detail; // ← NOT userDetail

    }
}
