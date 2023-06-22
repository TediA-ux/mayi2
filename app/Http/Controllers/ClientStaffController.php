<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientStaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:activate-users', ['only' => ['index']]);
        $this->middleware('permission:activate-user', ['only' => ['activate']]);
        $this->middleware('permission:view-company-trips', ['only' => ['viewcompanytrips', 'update']]);
        $this->middleware('permission:approve-trip', ['only' => ['approvetrip']]);
    }

    public function index(Request $request)
    {

        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);
        $data = User::where('companyid', $log_user->companyid)->where('department_id', $log_user->department_id)->orderBy('created_at', 'desc')->get();

        return view('authoriser.index', compact('data', 'user_role', 'log_user'));
    }

    public function viewcompanytrips()
    {
        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);

    }
    public function approvetrip()
    {
        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);

    }

    public function activate($id)
    {
        $user = User::find($id);
        $user->status = '1';
        $user->save();
        return redirect('/authoriser/company/user')->with('success', 'Company User Activated successfully');

    }

    public function deactivate($id)
    {
        $user = User::find($id);
        $user->status = '0';
        $user->save();
        return redirect('/authoriser/company/user')->with('success', 'Company User Deactivated successfully');

    }

}
