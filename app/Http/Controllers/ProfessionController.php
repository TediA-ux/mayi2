<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ProfessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('permission:view-professions|create-profession|edit-profession|delete-profession', ['only' => ['index', 'store']]);
        $this->middleware('permission:create-profession', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-profession', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-profession', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);
        $data = Profession::orderBy('id', 'DESC')->paginate(5);
        return view('professions.index', compact('data', 'user_role', 'log_user', 'roles'))
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
        $professions = Profession::all();
        return view('professions.create', compact('professions', 'user_role', 'log_user', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',

        ]);

        $input = ($request->all() + ['created_by' => Auth::User()->id]);

        //return $input;

        $profession = Profession::create($input);

        return redirect()->route('professions.index')
            ->with('success', 'Profession created successfully');
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
        $profession = Profession::find($id);
        return view('professions.edit', compact('profession', 'user_role', 'log_user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required',

        ]);

        $input = $request->all();

        $profession = Profession::find($id);
        $profession->update($input);

        return redirect()->route('professions.index')
            ->with('success', 'Profession updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        Hobby::find($id)->delete();
        return redirect()->route('professions.index')
            ->with('success', 'Profession deleted successfully');
    }
}
