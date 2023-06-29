<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Qualification;
use DB;
use Hash;
use Validator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Role;

class QualificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:list-qualifications|create-qualification|edit-qualification|delete-qualification', ['only' => ['index', 'store']]);
        $this->middleware('permission:create-qualification', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-qualification', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-qualification', ['only' => ['destroy']]);
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
        $data = Qualification::orderBy('id', 'DESC')->paginate(5);
        return view('qualifications.index', compact('data', 'user_role', 'log_user', 'roles'))
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
        $qualifications = Qualification::all();
        return view('qualifications.create', compact('qualifications', 'user_role', 'log_user', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'award_type' => 'required',
            
        ]);

        $input = ($request->all()+['created_by' => Auth::User()->id]);

        //return $input;

        $qualification = Qualification::create($input);

        return redirect()->route('qualifications.index')
            ->with('success', 'Qualification created successfully');
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
        $qualification = Qualification::find($id);
        return view('qualifications.edit', compact('qualification', 'user_role', 'log_user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        
        $this->validate($request, [
            'award_type' => 'required',

        ]);

        $input = $request->all();

        $qualification = Qualification::find($id);
        $qualification->update($input);

        return redirect()->route('qualifications.index')
            ->with('success', 'Qualification updated successfully');

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       
        Qualification::find($id)->delete();
        return redirect()->route('qualifications.index')
            ->with('success', 'Qualification deleted successfully');
    }
}
