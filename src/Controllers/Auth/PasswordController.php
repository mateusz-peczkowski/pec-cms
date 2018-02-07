<?php

namespace peczis\pecCms\Controllers\Auth;

use peczis\pecCms\Requests\PasswordResetFormRequest;
use peczis\pecCms\Requests\PasswordResetChangeRequest;
//
use peczis\pecCms\Controllers\Controller;
//
use Illuminate\Support\Facades\Auth;
//
use Mail;
use peczis\pecCms\Mail\ResetPassword;
//
use peczis\pecCms\Repositories\Contracts\UserRepositoryInterface;
use peczis\pecCms\Repositories\Contracts\PasswordResetRepositoryInterface;

class PasswordController extends Controller
{
    private $passwords;

    private $users;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        PasswordResetRepositoryInterface $passwords,
        UserRepositoryInterface $users
    )
    {
        $this->passwords = $passwords;
        $this->users = $users;
    }

    /**
     * Show the password reset form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pec-cms::auth.password-reset');
    }

    /**
     * Reset user password action.
     *
     * @param \peczis\pecCms\Requests\PasswordResetFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function reset(PasswordResetFormRequest $request)
    {
        $email = $request->get('email');

        $token = md5($email . time());

        $this->passwords->create([
            'email' => $email,
            'token' => $token
        ]);

        Mail::to($email)->send(new ResetPassword($token));

        return response()->json([
            'redirect' => route('pec-cms.password.sent')
        ]);
    }

    /**
     * Confirmation text action.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmation()
    {
        return view('pec-cms::auth.password-reset-confirmation');
    }

    /**
     * Check token and provide properl view
     *
     * @return \Illuminate\Http\Response
     */
    public function password($token)
    {
        $request = $this->passwords->findBy('token', $token);
        $user = $this->users->findBy('email', $request->email);

        if (!$request || !$user) {
            return redirect()->route('pec-cms.login');
        }

        return view('pec-cms::auth.password-reset-token')->with([
            'token' => $token
        ]);
    }

    /**
     * Reset user password action.
     *
     * @param \peczis\pecCms\Requests\PasswordResetChangeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function change(PasswordResetChangeRequest $request, $token)
    {
        $requested = $this->passwords->findBy('token', $token);
        $user = $this->users->findBy('email', $requested->email);
        $password = $request->get('password');

        $user->password = bcrypt($password);
        $user->save();

        $this->passwords->destroy($requested->id);

        Auth::attempt([
            'login' => $user->login,
            'password' => $password
        ]);

        return response()->json([
            'redirect' => route('pec-cms.login')
        ]);
    }

}
