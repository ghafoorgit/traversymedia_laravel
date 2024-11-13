<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Listing;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(5)->create();
        $user =  User::factory()->create([
            'name'=>"John Doe",
            'email'=>'John@gmail.com'
        ]);
        Listing::factory(6)->create([
            'user_id'=>$user->id
        ]);
        // Listing::factory(6)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Listing::create([
        //     'title'=>'Laravel Senior Developer',
        //     'tags'=>'laravel, javascript',
        //     'company'=>'Acme Corp',
        //     'location'=>'Boston, MA',
        //     'email' => 'ghtalash@gmail.com',
        //     'website'=>'https://www.acme.com',
        //     'description'=>'Lorem ipsum dolor site amet consectetur adipisicing elit.
        //     Lorem ipsum dolor site amet consectetur adipisicing elit.
        //     Lorem ipsum dolor site amet consectetur adipisicing elit. Lorem ipsum dolor site amet consectetur adipisicing elit.'
        // ]);
        // Listing::create([
        //     'title'=>'Full-Stack Developer',
        //     'tags'=>'laravel, backend, api',
        //     'company'=>'Afghan Telecom',
        //     'location'=>'Kabul, Afghanistan',
        //     'email' => 'ghafoor.talash@gmail.com',
        //     'website'=>'https://www.Kabul.com',
        //     'description'=>'Lorem ipsum dolor site amet consectetur adipisicing elit.
        //     Lorem ipsum dolor site amet consectetur adipisicing elit.
        //     Lorem ipsum dolor site amet consectetur adipisicing elit. Lorem ipsum dolor site amet consectetur adipisicing elit.'
        // ]);
    }
}
