<?php

class RemindersController extends Controller {

    protected $users;

    public function __construct ( User $user )
    {

        $this->users = $user;

    }

    public function getRemind()
    {
        return View::make('password.remind');
    }

    public function postRemind()
    {

        $usuario_login = Input::get('usuario');
        $tmp = 
            $this->users
                ->where('login','=',$usuario_login)
                ->take(1)
                ->get();
             
        if ($tmp == "[]") {
            return Redirect::back()->with('message_danger', '¡No exite el usuario!');
        }

        $usuario_email = $tmp[0]->email;

        $credentials = 
            array(
                'email' => $usuario_email,
                'login' => $usuario_login,
            );

        switch ($response = Password::remind( $credentials ))
        {
            case Password::INVALID_USER:
                return Redirect::back()->with('message_danger', Lang::get($response));

            case Password::REMINDER_SENT:
                return Redirect::back()->with('message_info', Lang::get($response));
        }

    }

    /**
     * Display the password reset view for the given token.
     *
     * @param  string  $token
     * @return Response
     */
    public function getReset($token = null)
    {
        if (is_null($token)) App::abort(404);

        return View::make('password.reset')->with('token', $token);
    }

    /**
     * Handle a POST request to reset a user's password.
     *
     * @return Response
     */
    public function postReset()
    {

        $credentials = 
            array(
                'login'                 => Input::get('usuario'),
                'password'              => Input::get('password'),
                'password_confirmation' => Input::get('password_confirmation'),
                'token'                 => Input::get('token'),
            );

        $response = Password::reset($credentials, function($user, $password)
        {
            $user->password = Hash::make($password);

            $user->save();
        });

        switch ($response)
        {
            case Password::INVALID_PASSWORD:
            case Password::INVALID_TOKEN:
            case Password::INVALID_USER:
                return Redirect::back()->with('message_danger', Lang::get($response));

            case Password::PASSWORD_RESET:
                return Redirect::to('/');
        }
    }

}
