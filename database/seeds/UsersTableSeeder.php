<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Token;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
         factory(User::class)->create([
             'username' => 'Arcoders',
             'first_name' => 'Ismael',
             'last_name' => 'Haytam',
             'email' => 'arcoders@gmail.com'
         ]);

         factory(Token::class)->create();
     }
}
