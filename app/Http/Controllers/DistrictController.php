<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\District;
use App\Models\Constituency;
use DB;
use Hash;
use Validator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Role;

class DistrictController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view-districts', ['only' => ['index','store','update']]);
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
        $data = District::orderBy('id', 'DESC')->paginate(5);
        return view('districts.index', compact('data', 'user_role', 'log_user', 'roles'))
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
        $districts = District::pluck('name', 'name')->all();
        return view('districts.create', compact('districts', 'user_role', 'log_user', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
            

        ]);

        $input = ($request->all()+['created_by' => Auth::User()->id]);

        //return $input;

        $district = District::create($input);

        return redirect()->route('districts.index')
            ->with('success', 'District created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $district = District::find($id);
        $roles = Role::orderBy('id', 'DESC')->paginate(5);
        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);

        $data = Constituency::where('district_id', $district->id)->orderBy('id', 'DESC')->get();
        
        return view('districts.show', compact('data', 'district', 'user_role', 'log_user', 'roles'))->with('i');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);
        $district = District::find($id);
        return view('districts.edit', compact('district', 'user_role', 'log_user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        
        $this->validate($request, [
            'name' => 'required',

        ]);

        $input = $request->all();

        $district = District::find($id);
        $district->update($input);

        return redirect()->route('districts.index')
            ->with('success', 'District updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       
        District::find($id)->delete();
        return redirect()->route('districts.index')
            ->with('success', 'District deleted successfully');
    }

    public function addConstituency($id)
    {

        //$id = Crypt::decrypt($id);
        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);
       

        $district = District::find($id);

        return view('districts.addConstituency', compact('user_role', 'log_user', 'district'));

    }

    public function postConstituency(Request $request)
    {

        $validator = $request->validate([
            'name' => 'required',
            

        ]);

        $input = ($request->all()+['created_by' => Auth::User()->id]);

        //return $input;

        $data = Constituency::create($input);

        return redirect()->route('districts.index')
            ->with('success', 'Constituency created successfully');

    }

    public function editConstituency($id)
    {
        $id = Crypt::decrypt($id);
        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);
        $constituency = Constituency::find($id);
        return view('districts.editConstituency', compact('constituency', 'user_role', 'log_user', 'roles'));
    }

    public function updateConstituency()
    {
        
        $this->validate($request, [
            'name' => 'required',

        ]);

        $input = $request->all();

        $constituency = Constituency::find($id);
        $constituency->update($input);

        return redirect()->route('districts.index')
            ->with('success', 'Constituency updated successfully');
    }
}
