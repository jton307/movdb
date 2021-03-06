<?php

  namespace App\Http\Controllers;

  use App\Category;
  use App\Http\Requests\AddPostRequest;
  use App\Photo;
  use App\Post;
  use Illuminate\Http\Request;
  use Illuminate\Support\Facades\Auth;

  class AdminPostsController extends Controller
  {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $posts = Post::orderBy('id', 'desc')->paginate(5);

      return view('admin.posts.index', compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $categories = Category::all();
      $post = new Post();
      return view('admin.posts.create', compact('post', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddPostRequest $request)
    {
      $input = $request->all();
      if ($file = $request->file('file')) {
        $name = time().$file->getClientOriginalName();
        dd($name);
        $file->move('images/posts', $name);
        $image = Photo::create(['filename' => $name]);
        $input['photo_id'] = $image->id;
      }
      $input['user_id'] = Auth::user()->id;
      Post::create($input);
      return redirect(route('admin_posts'))->with('message', 'The Post has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
      //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
      //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
      //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
      //
    }
  }
