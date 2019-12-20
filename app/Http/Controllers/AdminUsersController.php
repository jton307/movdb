<?php

 namespace App\Http\Controllers;

 use App\Http\Requests\AddUserRequest;
 use App\Http\Requests\EditUserRequest;
 use App\Role;
 use App\User;

 class AdminUsersController extends Controller
 {
  public function __construct()
  {
   $this->middleware('auth');
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
   $users = User::all();
   return view('admin.users.index', compact('users'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
   $roles = Role::all();
   $user = new User();
   return view('admin.users.create', compact('roles', 'user'));
  }

  public function store(AddUserRequest $request)
  {
   $user = $request->all();
   $user['password'] = bcrypt(trim($request->password));
   User::create($user);
   return redirect(route('admin_users'))->with('message', ' User has been created');
  }

  public function show(User $user)
  {
   $roles = Role::all();
   return view('admin.users.show', compact('user', 'roles'));
  }

  public function edit(User $user)
  {
   $roles = Role::all();
   return view('admin.users.edit', compact('roles', 'user'));
  }

  public function update(EditUserRequest $request, User $user)
  {
   $roles = Role::all();
   $input = \request()->all();

   if (empty(trim($request->password))) {
    $input = $request->except('password');
   } else {
    $input['password'] = bcrypt($request->password);
   }
   $user->update($input);
   return redirect(route('admin_users.show', compact('user')))->with('message', ' User has been updated');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(User $user)
  {
   $name = $user->name;
   $id = $user->id;
   $user->delete();
   return redirect(route('admin_users'))->with('delete_message', 'Username: '.$name.' and ID: '.$id.' has been deleted');
  }
 }
