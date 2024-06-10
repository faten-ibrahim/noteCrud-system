<?php

namespace Database\Seeders;

use App\Models\Notice;
use App\Models\User;
use Database\Factories\NoticeFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = [];
        $users[] = User::factory()->create([
            'name' => 'Ali',
            'email' => 'ali@example.com',
            'password' => Hash::make('12345678')
        ]);

        $users[] = User::factory()->create([
            'name' => 'ahmed',
            'email' => 'ahmed@example.com',
            'password' => Hash::make('12345678')
        ]);

        $users[] = User::factory()->create([
            'name' => 'mona',
            'email' => 'mona@example.com',
            'password' => Hash::make('12345678')
        ]);

        foreach ($users as $user)
            Notice::factory()->count(30)->create(['user_id' => $user->id]);
    }
}
