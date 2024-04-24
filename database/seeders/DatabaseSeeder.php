<?php

namespace Database\Seeders;

use App\Models\Character;
use App\Models\Contest;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Mail\Mailables\Content;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'admin' => true,
        ]);
        User::factory()->create([
            'name' => 'Base User',
            'email' => 'q@q.hu',
            'admin' => false,
        ]);

        $this->call([
            PlaceSeeder::class,
            CharacterSeeder::class,
            ContestSeeder::class,
        ]);
    }
}
