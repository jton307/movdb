@extends('layouts.admin')
@section('content')
  @component('admin.includes.title')
    <h2 class="text-primary text-center">Edit {{ $user->name }} Information</h2>
    <h4 class="text-primary text-center">User #: {{ $user->id }}</h4>
    @endcomponent
  <div class="container">
  <form action="{{ route('admin_users.update', ['user'=>$user]) }}" method="post">
    @method('PATCH')
    @csrf
    @include('admin.users.form_user')
    <div class="">
      <div class="form-group pt-2">
          <input type="submit" class="btn btn-dark" value="Update User">
          </div>
    </div>
  </form>
  </div>
@endsection