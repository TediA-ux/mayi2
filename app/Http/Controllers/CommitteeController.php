<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Committee;
use DB;
use Hash;
use Validator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Role;

class CommitteeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct()
     {
         $this->middleware('permission:view-committees|create-committee|edit-committee|delete-committee', ['only' => ['index', 'store']]);
         $this->middleware('permission:create-committee', ['only' => ['create', 'store']]);
         $this->middleware('permission:edit-committee', ['only' => ['edit', 'update']]);
         $this->middleware('permission:delete-committee', ['only' => ['destroy']]);
     }


    public function index(Request $request)
    {
        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);
        $data = Committee::orderBy('id', 'DESC')->paginate(5);
        return view('committees.index', compact('data', 'user_role', 'log_user', 'roles'))
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
        $committees = Committee::all();
        return view('committees.create', compact('committees', 'user_role', 'log_user', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'committee_type' => 'required',
            'committee_name' => 'required'
            
        ]);

        $input = ($request->all()+['created_by' => Auth::User()->id]);

        //return $input;

        $committee = Committee::create($input);

        return redirect()->route('committees.index')
            ->with('success', 'Committee created successfully');
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
        $committee = Committee::find($id);
        return view('committees.edit', compact('committee', 'user_role', 'log_user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        
        $this->validate($request, [
            'committee_type' => 'required',
            'committee_name' => 'required'

        ]);

        $input = $request->all();

        $committee = Committee::find($id);
        $committee->update($input);

        return redirect()->route('committees.index')
            ->with('success', 'Committee updated successfully');

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       
        Committee::find($id)->delete();
        return redirect()->route('hobbies.index')
            ->with('success', 'Committee deleted successfully');
    }
}
