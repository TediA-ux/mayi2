<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Mail\SFMail;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:list-users|create-user|edit-user|delete-user', ['only' => ['index', 'store']]);
        $this->middleware('permission:create-user', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-user', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-user', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id', 'DESC')->get();
        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);
        
        return view('users.index', compact('data', 'user_role', 'log_user'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles', 'user_role', 'log_user'));
    }

    // public function sendmail(Request $request)
    // {

    //     $user = User::find($request->id);
    //     \Mail::to($user->email)
    //     ->send(
    //         new SFMail($request->subject, 'Code 3:16', 'no-reply@prophetelvis.com', $request->message)
    //     );

    //     return redirect()->route('users.index')
    //         ->with('success', 'Message Sent Successfully');
    // }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'contact' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['role'] = $request->input('roles');
        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($id);
        return view('users.show', compact('log_user', 'user_role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('user', 'log_user', 'roles', 'user_role', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'contact' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required',


        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        if ($request->hasFile('id_front')) {
            // Get File Name With Extension
            $filenameWithExt = $request->file('id_front')->getClientOriginalName();
            // Get just file name
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just Extension
            $extension = $request->file('id_front')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // upload image
            // $path = $request->file('companylogo')->move('public/company_images', $fileNameToStore);
            $path = $request->file('id_front')->move('identification_photos', $fileNameToStore);

            //$request->image->move(public_path('cover_images'), $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        if ($request->hasFile('id_back')) {
            // Get File Name With Extension
            $filenameWithExt_back = $request->file('id_back')->getClientOriginalName();
            // Get just file name
            $filename_back = pathinfo($filenameWithExt_back, PATHINFO_FILENAME);
            //Get just Extension
            $extension_back = $request->file('id_back')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore_back = $filename_back . '_' . time() . '.' . $extension_back;
            // upload image
            // $path = $request->file('companylogo')->move('public/company_images', $fileNameToStore);
            $path = $request->file('id_back')->move('identification_photos', $fileNameToStore_back);

            //$request->image->move(public_path('cover_images'), $fileNameToStore);
        } else {
            $fileNameToStore_back = 'noimage.jpg';
        }

        $user = User::find($id);
        $input['role'] = $request->input('roles');
        $input['id_front'] = $fileNameToStore;
        $input['id_back'] = $fileNameToStore_back;

        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id)->delete();

        return redirect()->route('users.index', compact('user'))
            ->with('success', 'User deleted successfully');
    }

    public function activate($id)
    {
        $user = User::find($id);
        $user->status = '1';
        $user->save();
        return redirect('/users')->with('success', 'User Activated successfully');

    }

    public function deactivate($id)
    {
        $user = User::find($id);
        $user->status = '0';
        $user->save();
        return redirect('/users')->with('success', 'User Deactivated successfully');

    }
}