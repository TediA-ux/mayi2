<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Parliament;
use DB;
use Hash;
use Validator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Role;

class ParliamentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:list-parliaments|create-parliament|edit-parliament|delete-parliament', ['only' => ['index', 'store']]);
        $this->middleware('permission:create-parliament', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-parliament', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-parliament', ['only' => ['destroy']]);
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
        $data = Parliament::orderBy('id', 'DESC')->get();
        return view('parliaments.index', compact('data', 'user_role', 'log_user', 'roles'))
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
        $parliaments = Parliament::all();
        return view('parliaments.create', compact('parliaments', 'user_role', 'log_user', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'type' => 'required',
            
        ]);

        $input = ($request->all()+['created_by' => Auth::User()->id]);

        //return $input;

        $parliament = Parliament::create($input);

        return redirect()->route('parliaments.index')
            ->with('success', 'Parliament created successfully');
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
        $parliament = Parliament::find($id);
        return view('parliaments.edit', compact('parliament', 'user_role', 'log_user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        
        $this->validate($request, [
            'type' => 'required',

        ]);

        $input = $request->all();

        $parliament = Parliament::find($id);
        $parliament->update($input);

        return redirect()->route('parliaments.index')
            ->with('success', 'Parliament updated successfully');

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       
        Parliament::find($id)->delete();
        return redirect()->route('parliaments.index')
            ->with('success', 'Parliament deleted successfully');
    }
}
