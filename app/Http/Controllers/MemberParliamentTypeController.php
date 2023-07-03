<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Parliament;
use App\Models\MemberParliament;
use DB;
use Hash;
use Validator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Role;

class MemberParliamentTypeController extends Controller
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
        $parliaments = Parliament::all();

        $ptype = MemberParliament::select('member_parliaments.*','parliaments.type AS type')
        ->LeftJoin('parliaments','parliaments.id','member_parliaments.parliament_id')
        ->where("member_parliaments.id", $id)->first();


        return view('member-parliament-type.edit', compact('ptype','parliaments', 'user_role', 'log_user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'parliament_id' => 'required',

        ]);

        $input = ($request->all()+['updated_by' => Auth::User()->id]);

        $type = MemberParliament::find($id);
        $type->update($input);


        return redirect()->back()->with('success', 'Parliament type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        MemberParliament::find($id)->delete();
        return redirect()->back()->with('success', 'Parliament type deleted successfully.');
    }
}
