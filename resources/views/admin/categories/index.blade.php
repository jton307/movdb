@extends('layouts.admin')
@section('content')
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
      <div class="col-sm-11">
        @component('admin.includes.title')
          Categories
        @endcomponent
        <div class="row">
          <div class="col-sm-6">
            <table class="table table-bordered table-hover table-striped text-center">
              <thead>
              <tr>
                <th>ID</th>
                <th>Category Name</th>
                <th>Delete</th>
              </tr>
              </thead>
              <tbody>
              @if($categories)
                @foreach($categories as $category)
                  <tr>
                    <td>{{ $category-> id }}</td>
                    <td ><a href="{{ route('admin_categories.edit', ['category' => $category]) }}" class="text-success">{{ $category-> name }}</a></td>
                    <td>
                      <form action="{{route('admin_categories.destroy', ['category' => $category])}}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete" class="btn btn-sm btn-danger">
                      </form>
                    </td>
                  </tr>

                @endforeach
              @else
                <div>There is no Category</div>
              @endif
              </tbody>
            </table>
          </div>
          <div class="col-sm-1"></div>
          <div class="col-sm-5">
            <form action="{{route('admin_categories.store')}}" method="post">
              @csrf
              <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" name="name" placeholder="Enter New Category" class="form-control">
              </div>
              <button type="submit" class="btn btn-primary">Add New Category</button>
            </form>
          </div>
        </div>
      </div>



@endsection