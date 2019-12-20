@extends('layouts.admin')
@section('content')
  @component('admin.includes.title')
    <h2 class="text-dark text-center">Edit Post: <span class="text-primary">{{ $post->name }}</span> by Author: <span class="text-primary">{{$post->user->name}}</span></h2>
  @endcomponent
  @if (!empty($post))
    <div class=" text-right">
      <form method="post" action="{{ route('admin_posts.destroy', ['post' => $post]) }}">
        @csrf
        @method('Delete')
        <div class="form-group">
          <button type="submit" class="btn btn-danger">Delete Post</button>
        </div>
      </form>
    </div>
    <form action="{{ route('admin_posts.update', ['post' => $post]) }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('Patch')
      <div class="row">
        <div class="col-sm-3">
          <div class="form-group text-center">
            <label for="file">Movie pic</label>
            <div>
              <img src="{{url('images/posts/'.$post->photo['filename'])}}" id="profile-img-tag" width="fit-content" class="form-control">
            </div>
            <input type="file" name="file" id="profile-img" class="form-control-file">
            <span class="alert text-danger">{{ $errors->first('file') }}</span>
          </div>
        </div>

        <div class="col-sm-9">
          <div class="container form-group">
            <div class="form-group">

              <div class="form-group">
                <label for="title" class="font-weight-bold">Post Title : </label>
                <input type="text" name="title" class="form-control" value="{{ old('title') ?? $post->title}}" placeholder="Enter the title for the post">
                <span class="alert text-danger">{{ $errors->first('title') }}</span>
              </div>

              <div class="form-group">
                <label for="name" class="font-weight-bold">Name : </label>
                <input type="text" name="name" class="form-control" value="{{ old('name') ?? $post->name}}" placeholder="Enter the post title">
                <span class="alert text-danger">{{ $errors->first('name') }}</span>
              </div>
              <div class="form-group">
                <label for="category_id" class="font-weight-bold">Category: </label>
                <select name="category_id" id="category_id" class="form-control">
                  <option disabled="">Select a Category</option>
                  @foreach($categories as $category)
                    <option value="{{ $category->id }}"{{ $category->id == $post->category_id ? 'selected' : '' }} > {{$category->name}}</option>
                  @endforeach
                </select>
                <span class="alert text-danger">{{ $errors->first('category_id') }}</span>
              </div>
              <div class="form-group">
                <label for="description" class="font-weight-bold">Description: </label>
                <textarea name="description" class="form-control" rows="1">{{ old('description') ?? $post->description}}</textarea>
                <span class="alert text-danger">{{ $errors->first('description') }}</span>
              </div>
              <div class="form-group">
                <label for="review" class="font-weight-bold">Review: </label>
                <textarea name="review" id="editor" class="form-control" rows="15" placeholder="Insert your comment">{{old('review') ?? $post->review}}</textarea>
                <span class="alert text-danger">{{ $errors->first('review') }}</span>
              </div>
              {{--          BUTTON--}}
              <div class="row">
                <div class="form-group col-2">
                  <button type="submit" class="btn btn-primary">Save Post</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>

  @else
    <div><h3>Sorry, nothing is found</h3></div>
  @endif

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

Lorem ipsum dolor sit amet.

Lorem ipsum dolor sit amet, consectetur adipisicing elit. A alias amet asperiores aut culpa dignissimos error esse excepturi fuga ipsam laborum magni minus nesciunt, quia tempora tempore, ullam vel voluptas!