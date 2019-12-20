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
      <div class=" col-11 text-right">
        <a href="{{route('admin_posts.create')}}" >
          <button type="submit" class="btn btn-secondary text-right">Create Post</button></a>
      </div>
      <div class="container">
        <h2>Posts Table</h2>
        <table class="table table-bordered table-hover table-striped text-center">
          <thead>
          <tr>
            <th>#</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Genre</th>
            <th>Owner</th>
            <th>Created</th>
            <th>Updated</th>
          </tr>
          </thead>
          <tbody>
          @if($posts)
            @foreach($posts as $post)
              <tr>
                <td>{{$post->id}}</td>
                <td>
                  <img src="{{url('/images/posts/'.$post->photo['filename'])}}" width="50px" alt="">
                </td>
               <td><a href="{{ route('admin_posts.edit', ['post' => $post]) }}">{{$post->name}}</a></td>
               <td>{{ $post->category['name'] }}</td>
                <td>{{$post->user['name']}}</td>
                <td>{{$post->created_at->diffForHumans()}}</td>
                <td>{{$post->updated_at->diffForHumans()}}</td>
            @endforeach
          @endif
          </tbody>
        </table>
        {{ $posts->links() }}
      </div>

@endsection