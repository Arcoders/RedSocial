<?php

class ExampleTest extends FeatureTestCase
{

    public function test_basic_example()
    {

        $user = factory(\App\User::class)->create([
            'name' => 'Ismael Haytam',
            'email' => 'arcoders@gmail.com'
        ]);

        $this->actingAs($user, 'api')
             ->visit('api/user')
             ->see('Ismael Haytam')
             ->see('arcoders@gmail.com');

    }

}
