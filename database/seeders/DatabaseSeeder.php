<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Listing;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        /*User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        */
        /*
        Listing::create([
            'title' => 'Laravel Senior Developer',
            'tags' => 'laravel, javascript',
            'company' => 'ACME Corp',
            'location' => 'Boston, MA',
            'email' => 'pH5wK@example.com',
            'website' => 'https://www.acme.com',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa, voluptatem.'
        ]);
        Listing::create([
            'title' => 'Full-Stack Engineer',
            'tags' => 'laravel, backend, javascript',
            'company' => 'Stark Industries',
            'location' => 'New York, NY',
            'email' => 'dHt4A@example.com',
            'website' => 'https://www.starkindustries.com',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa, voluptatem.'
        ]);
        */
        Listing::factory(6)->create();
    
        }
}
