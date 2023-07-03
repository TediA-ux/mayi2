<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProfessionalBody;
use App\Models\ProfessionalBodyMembership;
use DB;
use Hash;
use Validator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Role;

class MembershipController extends Controller
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
        $bodies = ProfessionalBody::all();

        $membership = ProfessionalBodyMembership::select('professional_body_memberships.*','professional_bodies.name AS body')
        ->LeftJoin('professional_bodies','professional_bodies.id','professional_body_memberships.professional_body_id')
        ->where("professional_body_memberships.id", $id)->first();

        return view('memberships.edit', compact('membership','bodies', 'user_role', 'log_user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'professional_body_id' => 'required',

        ]);

        $input = ($request->all()+['updated_by' => Auth::User()->id]);

        $membership = ProfessionalBodyMembership::find($id);
        $membership->update($input);


        return redirect()->back()->with('success', 'Membership updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        ProfessionalBodyMembership::find($id)->delete();
        return redirect()->back()->with('success', 'Member work experience deleted successfully.');
    }
}
