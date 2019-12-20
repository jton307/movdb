@extends('layouts.admin')
@section('content')
  @component('admin.includes.title')
    <h2 class="text-primary text-center">Add Post</h2>
  @endcomponent

  <form action="{{ route('admin_posts.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-sm-3">
        <div class="form-group text-center">
          <label for="file">Movie pic</label>
          <div>
            <img src="{{url('images/no_movie_ph.png')}}" id="profile-img-tag" width="fit-content" class="form-control">
          </div>
          <input type="file" name="file" id="profile-img" class="form-control-file">
          <span class="alert text-danger">{{ $errors->first('file') }}</span>
        </div>
      </div>

      <div class="col-sm-9">
        <div class="container form-group">
          <div class="form-group">
            <label for="title" class="font-weight-bold">Post Title : </label>
            <input type="text" name="title" class="form-control" value="{{ old('post') ?? $post->title}}" placeholder="Enter the title for the post">
            <span class="alert text-danger">{{ $errors->first('title') }}</span>
          </div>

          <div class="form-group">
            <label for="name" class="font-weight-bold">Name : </label>
            <input type="text" name="name" class="form-control" value="{{ old('post') ?? $post->name}}" placeholder="Enter the post title">
            <span class="alert text-danger">{{ $errors->first('name') }}</span>
          </div>
          <div class="form-group">
            <label for="category_id" class="font-weight-bold">Category: </label>
            <select name="category_id" id="category_id" class="form-control">
              <option disabled="">Select a Category</option>
              @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == $post->category_id ? 'selected' : '' }}> {{$category->name}}</option>
              @endforeach
            </select>
            <span class="alert text-danger">{{ $errors->first('category_id') }}</span>
          </div>
          <div class="form-group">
            <labecl for="description" class="font-weight-bold">Description: </labecl>
            <textarea name="description" class="form-control" rows="1"></textarea>
            <span class="alert text-danger">{{ $errors->first('description') }}</span>
          </div>
          <div class="form-group">
            <label for="review" class="font-weight-bold">Review: </label>
            <textarea name="review" id="editor" class="form-control" rows="15"></textarea>
            <span class="alert text-danger">{{ $errors->first('review') }}</span>
          </div>
          {{--          BUTTON--}}
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Add Post</button>
          </div>
        </div>
        @component('admin.includes.errors')

          @endcomponent
      </div>
    </div>
  </form>

  <!-- CkEditor -->
  <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>

  <script>
      ClassicEditor
          .create(document.querySelector('#editor'))
          .catch(error => {
              console.error(error);
          });

      // Preview Photo
      function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                  $('#profile-img-tag').attr('src', e.target.result);
              }
              setTimeout(function () {

              })
              reader.readAsDataURL(input.files[0]);
          }
      }

      $("#profile-img").change(function () {
          readURL(this);
      });
  </script>
@endsection
