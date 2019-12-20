@extends('layouts.admin')
@section('content')
  @component('admin.includes.title')
    <h2 class="text-primary text-center"> {{ $user->name }} Information</h2>
    <h4 class="text-primary text-center">User #: {{ $user->id }}</h4>
    <div class="row">
      <div class="col-8"></div>
      @if (session()->has('message'))
        <div class=" col-4 alert alert-success" role="alert">
          <strong>{{ session()->get('message') }}</strong>
        </div>
        @endif
    </div>
  @endcomponent
  <div class="container">
    <div class="form-group">
      <label for="name" class="font-weight-bold">Name: </label>
      <input type="text" name="name" class="form-control" value="{{ old('name') ?? $user->name}}" readonly>
    </div>
    <div class="form-group">
      <label for="email" class="font-weight-bold">Email: </label>
      <input type="email" name="email" class="form-control" value="{{ old('email') ?? $user->email }}" readonly>
    </div>
    <div class="form-group">
      <label for="role_id" class="font-weight-bold">Role: </label>
      <select name="role_id" id="role_id" class="form-control" disabled>
        <option value="" disabled>Select a Role</option>
        @foreach($roles as $role)
          <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? 'selected' : '' }} readonly=""> {{$role->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="active" class="font-weight-bold">Status: </label>
      <select name="active" id="active" class="form-control" disabled>
        <option value="" disabled>Select a Status</option>
        @foreach($user->activeOptions() as $optionKey =>$optionValue)
          <option value="{{$optionKey}}" {{ $user->active == $optionValue ? 'selected' : '' }} readonly="">{{$optionValue}}</option>
        @endforeach
      </select>
    </div>

  <hr>
  <div class="row">
    <div class="col-1"></div>
    <div class="col-5">
      <a href="{{ route('admin_users.edit',['user' => $user]) }}">
        <button type="submit" class="btn btn-block btn-dark">Edit User</button>
      </a>
    </div>
    <div class="col-5">
      <form action="{{route('admin_users.destroy',['user' => $user])}}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-block btn-danger">Delete User</button>
      </form>
    </div>
    <div class="col-1"></div>
  </div>
  </div>
@endsection