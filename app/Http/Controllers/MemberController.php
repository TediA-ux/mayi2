<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image; 
use App\Models\User;
use App\Models\Member;
use App\Models\District;
use App\Models\Hobby;
use App\Models\MemberHobby;
use App\Models\Committee;
use App\Models\Constituency;
use App\Models\Qualification;
use App\Models\PoliticalParty;
use App\Models\ProfessionalBody;
use App\Models\WorkExperience;
use App\Models\ProfessionalBodyMembership;
use App\Models\Profession;
use App\Models\MemberQualification;
use Carbon\Carbon;
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
            'photo' => 'required',
            'marital_status' => 'required',
            'phone_number' => 'required',
            'postal_address' => 'required',
            'landline' => 'required',
            'gender' => 'required',
            'district_id' => 'required',
            'party_id' => 'required',
            'constituency_id' => 'required',
            'photo' => 'required'
            
        ]);

        if ($request->hasFile('photo')) {
            // Get File Name With Extension
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            // Get just file name
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just Extension
            $extension = $request->file('photo')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // upload image
            // $path = $request->file('companylogo')->move('public/company_images', $fileNameToStore);
            $path = $request->file('photo')->move('identification_photos', $fileNameToStore);

            //$request->image->move(public_path('cover_images'), $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $input['photo'] = $fileNameToStore;

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

        if ($request->hasFile('photo')) {
            // Get File Name With Extension
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            // Get just file name
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just Extension
            $extension = $request->file('photo')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // upload image
            // $path = $request->file('companylogo')->move('public/company_images', $fileNameToStore);
            $path = $request->file('photo')->move('identification_photos', $fileNameToStore);

            //$request->image->move(public_path('cover_images'), $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $input['photo'] = $fileNameToStore;

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

    public function add_member_info($id){
        $id = Crypt::decrypt($id);
        $roles = Role::orderBy('id', 'DESC')->paginate(5);
        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);
        $hobbies = Hobby::all();
        $member = Member::find($id);
        $committees = Committee::all();
        $qualifications = Qualification::all();
        $professions = Profession::all();
        $professionalbodies = ProfessionalBody::all();
        return view('members.addmore', compact('hobbies','member','professions','professionalbodies','committees','qualifications','user_role', 'log_user', 'roles'));
    }

    public function storeHobbies(Request $request)
    {   
        $this->validate($request, [
            'hobby_id' => 'required',

        ]);

        $memberIds = $request->input('member_id');
        $hobbyIds = $request->input('hobby_id');

        $data = [];

        // Combine member IDs and hobby IDs into an array
        foreach ($memberIds as $index => $memberId) {
            $data[] = [
                'member_id' => $memberId,
                'hobby_id' => $hobbyIds[$index],
                'created_by'=> Auth::User()->id
            ];
        }

        // Store the data in the database
        MemberHobby::insert($data);

        // Additional code as per your requirements

        return redirect()->back()->with('success', 'Special interests saved successfully.');
    }


        public function storeMemberships(Request $request)
        {   
            $this->validate($request, [
                'professional_body_id' => 'required',
    
            ]);
            $memberIds = $request->input('member_id');
            $bodyIds = $request->input('professional_body_id');
    
            $data = [];
    
            // Combine member IDs and hobby IDs into an array
            foreach ($memberIds as $index => $memberId) {
                $data[] = [
                    'member_id' => $memberId,
                    'professional_body_id' => $bodyIds[$index],
                    'created_by'=> Auth::User()->id
                ];
            }
    
            // Store the data in the database
            ProfessionalBodyMembership::insert($data);
    
            // Additional code as per your requirements
    
            return redirect()->back()->with('success', 'Professional Membership saved successfully.');

    }

    public function store_work_experience(Request $request)
        {   
            $this->validate($request, [
                'profession_id' => 'required',
                'organization' => 'required',
                'year_from' => 'required',
                'year_to' => 'required',
    
            ]);
            $memberIds = $request->input('member_id');
            $professionIds = $request->input('profession_id');
            $organization = $request->input('organization');
            $from = $request->input('year_from');
            $to = $request->input('year_to');
    
            $data = [];
    
            // Combine member IDs and hobby IDs into an array
            foreach ($memberIds as $index => $memberId) {
                $data[] = [
                    'member_id' => $memberId,
                    'profession_id' => $professionIds[$index],
                    'organization' => $organization[$index],
                    'year_from' => $from[$index],
                    'year_to' => $to[$index],
                    'created_by'=> Auth::User()->id
                ];
            }
    
            // Store the data in the database
            WorkExperience::insert($data);
    
            // Additional code as per your requirements
    
            return redirect()->back()->with('success', 'Work Experience saved successfully.');

    }

    public function store_member_qualifications(Request $request)
        {   
            $this->validate($request, [
                'award_id' => 'required',
                'institution' => 'required',
                'year' => 'required',
    
            ]);
            $memberIds = $request->input('member_id');
            $awardIds = $request->input('award_id');
            $institution = $request->input('institution');
            $year = $request->input('year');
    
            $data = [];
    
            // Combine member IDs and hobby IDs into an array
            foreach ($memberIds as $index => $memberId) {
                $data[] = [
                    'member_id' => $memberId,
                    'award_id' => $awardIds[$index],
                    'institution' => $institution[$index],
                    'year' => $year[$index],
                    'created_by'=> Auth::User()->id
                ];
            }
    
            // Store the data in the database
            MemberQualification::insert($data);
    
            // Additional code as per your requirements
    
            return redirect()->back()->with('success', 'Member Qualifications saved successfully.');

    }
}
