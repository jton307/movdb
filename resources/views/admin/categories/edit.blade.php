@extends('layouts.admin')
@section('content')
  @component('admin.includes.title')
    <h2 class="text-dark"> Edit Category</h2>
  @endcomponent
  <div class="container">
    <div class="col-sm-5">
      <form action="{{route('admin_categories.update', ['category'=> $category])}}" method="post">
        @csrf
        @method('PATCH')
        <div class="form-group">
          <label for="name">Category Name</label>
          <input type="text" name="name" placeholder="Enter New Category" class="form-control" value="{{ $category->name }}">
        </div>
        <button type="submit" class="btn btn-primary">Edit & Save Category</button>
      </form>
    </div>
  </div>
@endsection