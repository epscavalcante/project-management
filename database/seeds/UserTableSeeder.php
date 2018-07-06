<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Homem 01',
            'email' => 'homem1@email.com',
            'image' => 'homem1.jpg',
            'password' => bcrypt('secret')
        ]);

        User::create([
            'name' => 'Homem 02',
            'email' => 'homem2@email.com',
            'image' => 'homem2.jpg',
            'password' => bcrypt('secret')
        ]);

        User::create([
            'name' => 'Homem 03',
            'email' => 'homem3@email.com',
            'image' => 'homem3.jpg',
            'password' => bcrypt('secret')
        ]);

        User::create([
            'name' => 'Mulher 01',
            'email' => 'mulher1@email.com',
            'image' => 'mulher1.jpg',
            'password' => bcrypt('secret')
        ]);

         User::create([
            'name' => 'Mulher 02',
            'email' => 'mulher2@email.com',
            'image' => 'mulher2.jpg',
            'password' => bcrypt('secret')
        ]);

        factory(App\User::class, 10)->create();
    }
}
