<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MemberHobby;
use DB;
use Hash;
use Validator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Role;

class MemberHobbyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id = Crypt::decrypt($id);
        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);
        $hobby = MemberHobby::find($id);

        return view('member-hobbies.edit', compact('hobby','user_role', 'log_user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'hobby' => 'required',

        ]);

        $input = ($request->all()+['updated_by' => Auth::User()->id]);

        $hobby = MemberHobby::find($id);
        $hobby->update($input);


        return redirect()->back()->with('success', 'Hobby updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ProfessionalBodyMembership::find($id)->delete();
        return redirect()->back()->with('success', 'Hobby deleted successfully.');
    }
}
