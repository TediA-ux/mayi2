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
use App\Models\Parliament;
use App\Models\MemberQualification;
use App\Models\MemberParliament;
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

        $ptypes = MemberParliament::select('member_parliaments.*','parliaments.type AS type')
        ->LeftJoin('parliaments','parliaments.id','member_parliaments.parliament_id')
        ->where("member_id", $id)->get();
        

        $member = Member::select('member_info.*','member_info.id','districts.name AS district','political_party.name AS party','constituencies.name AS constituency')
        ->LeftJoin('districts','districts.id','member_info.district_id')
        ->LeftJoin('political_party','political_party.id','member_info.party_id')
        ->LeftJoin('constituencies','constituencies.id','member_info.constituency_id')
        ->where("member_info.id", $id)->first();

        $hobbies = MemberHobby::where("member_id", $id)->get();

        $memberships = ProfessionalBodyMembership::select('professional_body_memberships.*','professional_bodies.name AS body')
        ->LeftJoin('professional_bodies','professional_bodies.id','professional_body_memberships.professional_body_id')
        ->where("member_id", $id)->get();

        $qualifications = MemberQualification::select('member_qualifications.*','qualifications.award_type AS award')
        ->LeftJoin('qualifications','qualifications.id','member_qualifications.award_id')
        ->where("member_id", $id)->get();

        $jobs = WorkExperience::select('mp_work_experience.*','profession.name AS work')
        ->LeftJoin('profession','profession.id','mp_work_experience.profession_id')
        ->where("member_id", $id)->get();
      
        
        return view('members.show', compact('member','ptypes','qualifications','jobs','memberships','hobbies','user_role', 'log_user', 'roles'))->with('i');
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
        MemberHobby::where('member_id',$id)->delete();
        MemberQualification::where('member_id',$id)->delete();
        ProfessionalBodyMembership::where('member_id',$id)->delete();
        MemberParliament::where('member_id',$id)->delete();
        WorkExperience::where('member_id',$id)->delete();
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
        $parliaments = Parliament::all();
        $professionalbodies = ProfessionalBody::all();
        return view('members.addmore', compact('hobbies','parliaments','member','professions','professionalbodies','committees','qualifications','user_role', 'log_user', 'roles'));
    }

    public function storeHobbies(Request $request)
    {   
        $this->validate($request, [
            'hobby' => 'required',

        ]);

        $memberIds = $request->input('member_id');
        $hobby = $request->input('hobby');

        $data = [];

        // Combine member IDs and hobby IDs into an array
        foreach ($memberIds as $index => $memberId) {
            $data[] = [
                'member_id' => $memberId,
                'hobby' => $hobby[$index],
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

    public function store_member_parliaments(Request $request)
    {   
        $this->validate($request, [
            'parliament_id' => 'required',
            'responsibility' => 'required'

        ]);

        $memberIds = $request->input('member_id');
        $parliamentIds = $request->input('parliament_id');
        $responsibilities = $request->input('responsibility');

        $data = [];

        // Combine member IDs and hobby IDs into an array
        foreach ($memberIds as $index => $memberId) {
            $data[] = [
                'member_id' => $memberId,
                'parliament_id' => $parliamentIds[$index],
                'responsibility' => $responsibilities[$index],
                'created_by'=> Auth::User()->id
            ];
        }

        // Store the data in the database
        MemberParliament::insert($data);

        // Additional code as per your requirements

        return redirect()->back()->with('success', 'Member Qualifications saved successfully.');

}
}
