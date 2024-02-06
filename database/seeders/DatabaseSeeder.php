<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $user=new User();
        $user->name='john doe';
        $user->email='john@gmail.com';
        $user->password=bcrypt('password');
        $user->save();

        $user=new User();
        $user->name='ali smith';
        $user->email='ali@gmail.com';
        $user->password=bcrypt('password');
        $user->save();

        $this->call(CategoryTableSeeder::class);
        $this->call(CommentTableSeeder::class);
        $this->call(PostTableSeeder::class);
    }
}
