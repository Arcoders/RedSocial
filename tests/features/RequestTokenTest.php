<?php

use App\Mail\TokenMail;
use Illuminate\Support\Facades\Mail;
use App\Token;

class RequestTokenTest extends FeatureTestCase
{

    public function test_a_guest_user_can_request_a_token()
    {

        Mail::fake();

        $user = $this->defaultUser(['email' => 'admin@arcoders.com']);

        $this->visitRoute('token')
             ->type('admin@arcoders.com', 'email')
             ->press('Solicitar token');

        $token = Token::where('user_id', $user->id)->first();

        $this->assertNotNull($token, 'A token was not created');

        Mail::assertSent(TokenMail::class, function ($mail) use ($token, $user) {

            return $mail->hasTo($user) && $mail->token->id === $token->id;

        });

        $this->dontSeeIsAuthenticated();
        $this->see('Enviamos a tu email un enlace para que inicies sesión');

    }

    public function test_a_guest_user_can_request_a_token_without_an_email()
    {

        Mail::fake();

        $this->visitRoute('token')->press('Solicitar token');

        $token = Token::first();

        $this->assertNull($token);

        Mail::assertNotSent(TokenMail::class);

        $this->dontSeeIsAuthenticated();

        $this->seeErrors([
            'email' => 'El campo correo electrónico es obligatorio'
        ]);

    }

    public function test_a_guest_user_can_request_a_token_an_invalid_email()
    {

        $this->visitRoute('token')
             ->type('Random', 'email')
             ->press('Solicitar token');

        $this->seeErrors([
            'email' => 'Correo electrónico no es un correo válido'
        ]);

    }

    public function test_a_guest_user_can_request_a_token_with_a_non_existent_email()
    {

        $this->defaultUser(['email' => 'admin@arcoders.com']);

        $this->visitRoute('token')
             ->type('admin@anonisma.com', 'email')
             ->press('Solicitar token');

         $this->seeErrors([
             'email' => 'Este correo electrónico no existe'
         ]);

    }

}
