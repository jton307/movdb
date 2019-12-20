@extends('layouts.admin')
@section('content')
  @component('admin.includes.title')
    <h2 class="text-primary text-center">Add User</h2>
  @endcomponent
  <div class="container">
    <div class="row">
      <div class="col-1"></div>
      <div class="col-10">
    <form action="{{ route('admin_users.store') }}" method="post">
      @csrf
      @include('admin.users.form_user')
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Add Customer</button>
      </div>
    </form>
      </div>
      <div class="col-1"></div>
    </div>
  </div>
@endsection