<?php

use App\Mail\TokenMail;
use Illuminate\Support\Facades\Mail;
use App\Token;

class AuthenticationTest extends FeatureTestCase
{

    public function test_a_guest_user_can_request_a_token()
    {

        Mail::fake();

        $user = $this->defaultUser(['email' => 'admin@arcoders.com']);

        $this->visitRoute('login')
             ->type('admin@arcoders.com', 'email')
             ->press('Solicitar token');

        $token = Token::where('user_id', $user->id)->first();

        $this->assertNotNull($token, 'A token was not created');

        Mail::assertSentTo($user, TokenMail::class, function ($mail) use ($token) {

            return $mail->token->id === $token->id;

        });

        $this->dontSeeIsAuthenticated();
        $this->see('Enviamos a tu email un enlace para que inicies sesión');

    }

    public function test_a_guest_user_can_request_a_token_without_an_email()
    {

        Mail::fake();

        $this->visitRoute('login')->press('Solicitar token');

        $token = Token::first();

        $this->assertNull($token);

        Mail::assertNotSent(TokenMail::class);

        $this->dontSeeIsAuthenticated();

        $this->see('El campo correo electrónico es obligatorio');

    }

    public function test_a_guest_user_can_request_a_token_an_invalid_email()
    {

        $this->visitRoute('login')
             ->type('Random', 'email')
             ->press('Solicitar token');

        $this->see('Correo electrónico no es un correo válido');

    }

    public function test_a_guest_user_can_request_a_token_with_a_non_existent_email()
    {

        $this->defaultUser(['email' => 'admin@arcoders.com']);

        $this->visitRoute('login')
             ->type('admin@anonisma.com', 'email')
             ->press('Solicitar token');

         $this->see('Este correo electrónico no existe');

    }

}
