<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PoliticalParty;
use DB;
use Hash;
use Validator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Role;

class PartyController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:list-party|create-party|edit-party|delete-party', ['only' => ['index', 'store']]);
        $this->middleware('permission:create-party', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-party', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-party', ['only' => ['destroy']]);
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
        $data = PoliticalParty::orderBy('id', 'DESC')->paginate(5);
        return view('parties.index', compact('data', 'user_role', 'log_user', 'roles'))
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
        $parties = PoliticalParty::pluck('name', 'name')->all();
        return view('parties.create', compact('parties', 'user_role', 'log_user', 'roles'));
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

        $party = PoliticalParty::create($input);

        return redirect()->route('parties.index')
            ->with('success', 'Company created successfully');
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
        $party = PoliticalParty::find($id);
        return view('parties.edit', compact('party', 'user_role', 'log_user', 'roles'));
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

        $party = PoliticalParty::find($id);
        $party->update($input);

        return redirect()->route('parties.index')
            ->with('success', 'Party updated successfully');

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       
        PoliticalParty::find($id)->delete();
        return redirect()->route('parties.index')
            ->with('success', 'Party deleted successfully');
    }
}
