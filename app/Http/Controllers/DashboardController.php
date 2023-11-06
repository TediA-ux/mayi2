<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);

        return view('index', compact('user_role', 'log_user'));
    }

    // public function index()
    // {
    //     $roles = Auth::user()->roles()->first();
    //     $user_role = $roles->name;
    //     $user_id = Auth::user()->id;
    //     $log_user = User::find($user_id);

    //     return view('index', compact('user_role', 'log_user'));
    // }
    //         return view('index', compact('user_role', 'log_user', 'constituenciesSum', 'districtsSum', 'membersCount', 'usersCount', 'parties'))->with('gender', json_encode($array));

}