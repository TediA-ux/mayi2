<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:list-post|create-post|edit-post|delete-post', ['only' => ['index', 'store']]);
        $this->middleware('permission:create-post', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-post', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-post', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);
        $data = Post::orderBy('created_at', 'desc')->paginate(10);

        return view('posts.index', compact('data', 'user_role', 'log_user'));
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
        $posts = Post::all();

        return view('posts.create', compact('user_role', 'log_user', 'posts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'title' => 'required',
            'description' => 'required',
            'cover_image' => 'required',

        ]);

        //Handle file upload
        if ($request->hasFile('cover_image')) {
            // Get File Name With Extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just file name
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just Extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // upload image
            //$path= $request->file('cover_image')->move('public/cover_images', $fileNameToStore);
            $path = $request->file('cover_image')->move('cover_images', $fileNameToStore);

            //$request->image->move(public_path('cover_images'), $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        //create post

        $posts = new Post;
        $posts->title = $request->input('title');
        $posts->description = $request->input('description');
        // $post->user_id = auth()->user()->id;
        $posts->cover_image = $fileNameToStore;
        $posts->save();

        return redirect('/posts')->with('success', 'Post Successfully Created');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);
        $posts = Post::find($id);

        return view('posts.edit', compact('user_role', 'log_user', 'posts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'cover_image' => 'required',
        ]);
        if ($request->hasFile('cover_image')) {
            // Get File Name With Extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just file name
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just Extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // upload image
            //$path= $request->file('cover_image')->move('public/cover_images', $fileNameToStore);
            $path = $request->file('cover_image')->move('cover_images', $fileNameToStore);

            //$request->image->move(public_path('cover_images'), $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        //create post

        $posts = new Post;
        $posts->title = $request->input('title');
        $posts->description = $request->input('description');
        // $post->user_id = auth()->user()->id;
        $posts->cover_image = $fileNameToStore;
        $posts->save();

        return redirect()->route('posts.index')
            ->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
