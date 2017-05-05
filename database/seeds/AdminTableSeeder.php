<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(User::class)->create([

            'first_name' => 'Ismael',
            'last_name' => 'Haytam',
            'username' => 'Arcoders',
            'email' => 'arcoders@gmail.com',
            'role' => 'admin'
        ]);

    }
}
