<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MemberQualification;
use App\Models\Qualification;
use DB;
use Hash;
use Validator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Role;

class EducationRecordController extends Controller
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
        $qualifications = Qualification::all();

        $record = MemberQualification::select('member_qualifications.*','qualifications.award_type AS award')
        ->LeftJoin('qualifications','qualifications.id','member_qualifications.award_id')
        ->where("member_qualifications.id", $id)->first();


        return view('education.edit', compact('record','qualifications', 'user_role', 'log_user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {

        $this->validate($request, [
            'award_id' => 'required',
            'institution' => 'required',
            'year' => 'required',

        ]);

        $input = ($request->all()+['updated_by' => Auth::User()->id]);

        $record = MemberQualification::find($id);
        $record->update($input);


        return redirect()->back()->with('success', 'Member Qualification updated successfully.');

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $record = MemberQualification::find($id)->delete();

        return redirect()->back()->with('success', 'Record deleted successfully.');
    }
}
