<?php

namespace App\Http\Controllers;

use App\Models\ProfessionalBody;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ProfessionalBodyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('permission:view-professional-bodies|create-professional-body|edit-professional-body|delete-professional-body', ['only' => ['index', 'store']]);
        $this->middleware('permission:create-professional-body', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-professional-body', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-professional-body', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);
        $data = ProfessionalBody::orderBy('id', 'DESC')->paginate(5);
        return view('professional-bodies.index', compact('data', 'user_role', 'log_user', 'roles'))
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
        $professional_bodies = ProfessionalBody::all();
        return view('professional-bodies.create', compact('professional_bodies', 'user_role', 'log_user', 'roles'));
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

        $professional_bodies = ProfessionalBody::create($input);

        return redirect()->route('professional-bodies.index')
            ->with('success', 'Professional body created successfully');
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
        $professional_body = ProfessionalBody::find($id);
        return view('professional-bodies.edit', compact('professional_body', 'user_role', 'log_user', 'roles'));
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

        $professional_body = ProfessionalBody::find($id);
        $professional_body->update($input);

        return redirect()->route('professional-bodies.index')
            ->with('success', 'Professional Body updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        ProfessionalBody::find($id)->delete();
        return redirect()->route('professional-bodies.index')
            ->with('success', 'Professional body deleted successfully');
    }
}
