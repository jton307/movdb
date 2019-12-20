@extends('layouts.admin')
@section('content')
  @component('admin.includes.title')
    Administrators / Author
  @endcomponent
  {{--Flash Message--}}

  <div class="row">
    <div class="col-8"></div>
    @if (session()->has('message'))
      <div class=" col-4 alert alert-success" role="alert">
        <strong>{{ session()->get('message') }}</strong>
        @elseif (session()->has('delete_message'))
          <div class=" col-4 alert alert-danger" role="alert">
            <strong>{{ session()->get('delete_message') }}</strong>
            @endif
          </div>
      </div>
      <div class="container">
        <h2>Users Table</h2>
        <table class="table table-bordered table-hover table-striped text-center">
          <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Active</th>
            <th>Created</th>
            <th>Updated</th>
          </tr>
          </thead>
          <tbody>
          @if($users)
            @foreach($users as $user)
              <tr>
                <td>{{$user->id}}</td>
                <td><a href="{{ route('admin_users.show', ['user' => $user])}}"> {{$user->name}}</a></td>
                <td>{{$user->email}}</td>
                <td>{{$user->role->name}}</td>
                <td>{{$user->active}}</td>
                <td>{{$user->created_at->diffForHumans()}}</td>
                <td>{{$user->updated_at->diffForHumans()}}</td>
            @endforeach
          @endif
          </tbody>
        </table>
      </div>
@endsection