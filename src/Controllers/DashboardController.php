<?php

namespace peczis\pecCms\Controllers;

class DashboardController extends Controller
{

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
        return view('pec-cms::dashboard');
    }


}
