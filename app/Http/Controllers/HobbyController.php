<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Hobby;
use DB;
use Hash;
use Validator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Role;

class HobbyController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct()
     {
         $this->middleware('permission:view-hobbies|create-hobby|edit-hobby|delete-hobby', ['only' => ['index', 'store']]);
         $this->middleware('permission:create-hobby', ['only' => ['create', 'store']]);
         $this->middleware('permission:edit-hobby', ['only' => ['edit', 'update']]);
         $this->middleware('permission:delete-hobby', ['only' => ['destroy']]);
     }


    public function index(Request $request)
    {
        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);
        $data = Hobby::orderBy('id', 'DESC')->paginate(5);
        return view('hobbies.index', compact('data', 'user_role', 'log_user', 'roles'))
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
        $hobbies = Hobby::pluck('hobbies', 'hobbies')->all();
        return view('hobbies.create', compact('hobbies', 'user_role', 'log_user', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'hobbies' => 'required',
            
        ]);

        $input = ($request->all()+['created_by' => Auth::User()->id]);

        //return $input;

        $hobby = Hobby::create($input);

        return redirect()->route('hobbies.index')
            ->with('success', 'Hobby created successfully');
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
        $hobby = Hobby::find($id);
        return view('hobbies.edit', compact('hobby', 'user_role', 'log_user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        
        $this->validate($request, [
            'hobbies' => 'required',

        ]);

        $input = $request->all();

        $hobby = Hobby::find($id);
        $hobby->update($input);

        return redirect()->route('hobbies.index')
            ->with('success', 'Hobby updated successfully');

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       
        Hobby::find($id)->delete();
        return redirect()->route('hobbies.index')
            ->with('success', 'Hobby deleted successfully');
    }
}
