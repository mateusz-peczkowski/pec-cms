<?php

namespace peczis\pecCms\Controllers\Auth;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use peczis\pecCms\Requests\LoginFormRequest;
//
use peczis\pecCms\Controllers\Controller;
//
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()) {
            return redirect()->route('pec-cms.dashboard');
        }

        return view('pec-cms::auth.login');
    }

    /**
     * Log the user into the application.
     *
     * @param  \peczis\pecCms\Requests\LoginFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginFormRequest $request)
    {
        if (Auth::attempt($request->only(['login', 'password']))) {
            return response()->json([
                'redirect' => route('pec-cms.dashboard')
            ]);
        }

        return response()->json([], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect()->route('pec-cms.login');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'login';
    }

}
