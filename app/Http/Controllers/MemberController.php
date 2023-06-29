<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Member;
use App\Models\District;
use App\Models\Hobby;
use App\Models\Committee;
use App\Models\Constituency;
use App\Models\Qualification;
use App\Models\PoliticalParty;
use DB;
use Hash;
use Validator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Role;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:list-member|create-member|edit-member|delete-member', ['only' => ['index', 'store']]);
        $this->middleware('permission:create-member', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-member', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-member', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);
        $data = Member::orderBy('id', 'DESC')->paginate(5);
        return view('members.index', compact('data', 'user_role', 'log_user', 'roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);
        $members = Member::all();
        $parties = PoliticalParty::all();
        $districts = District::all();
        $hobbies = Hobby::all();
        $committees = Committee::all();
        return view('members.create', compact('members','parties','districts','committees','hobbies', 'user_role', 'log_user', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'title' => 'required',
            'surname' => 'required',
            'other_names' => 'required',
            'email'=> 'required',
            'dob' => 'required',
            'religion' => 'required',
            'marital_status' => 'required',
            'phone_number' => 'required',
            'postal_address' => 'required',
            'landline' => 'required',
            'gender' => 'required',
            'district_id' => 'required',
            'party_id' => 'required',
            'constituency_id' => 'required'
            
        ]);

        $input = ($request->all()+['created_by' => Auth::User()->id]);

        //return $input;

        $member = Member::create($input);



        return redirect()->route('members.index')
            ->with('success', 'Member created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $roles = Role::orderBy('id', 'DESC')->paginate(5);
        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);
        $member = Member::find($id);
        $parties = PoliticalParty::all();
        $districts = District::all();
        $hobbies = Hobby::all();
        $committees = Committee::all();
        $qualifications = Qualification::all();
        
        return view('members.show', compact('member','qualifications','parties','districts','committees','hobbies','user_role', 'log_user', 'roles'))->with('i');
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
        $member = Member::find($id);
        $parties = PoliticalParty::all();
        $districts = District::all();
        return view('members.edit', compact('member','parties','districts', 'user_role', 'log_user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        
        $this->validate($request, [
            'title' => 'required',
            'surname' => 'required',
            'other_names' => 'required',
            'email'=> 'required',
            'dob' => 'required',
            'religion' => 'required',
            'marital_status' => 'required',
            'phone_number' => 'required',
            'postal_address' => 'required',
            'landline' => 'required',
            'gender' => 'required',
            'district_id' => 'required',
            'party_id' => 'required',
            'constituency_id' => 'required'

        ]);

        $input = $request->all();

        $member = Member::find($id);
        $member->update($input);

        return redirect()->route('members.index')
            ->with('success', 'Member updated successfully');

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       
        Member::find($id)->delete();
        return redirect()->route('members.index')
            ->with('success', 'Member deleted successfully');
    }

    public function get_district_constituencies($id)
    {
        $constituencies = Constituency::where('district_id', $id)->get();
        return $constituencies;
    }
}
