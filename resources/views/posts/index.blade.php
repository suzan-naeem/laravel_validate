@extends('layouts.app')

@section('title')Index Page @endsection

@section('content')


<a href="{{route('posts.create')}}" class="btn btn-success" style="margin-bottom: 20px;">Create Post</a>

<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Slug</th>
        <th scope="col">Posted By</th>
        <th scope="col">Created At</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
    @foreach($posts as $post)
    {{-- @dd($post) --}}
      <tr>
        <th scope="row">{{ $post->id }}</th>
        <td>{{ $post->title ? $post->title : 'title not found'}}</td>
        <td>{{ $post->slug ? $post->slug : 'slug not found'}}</td>
        <td>{{$post->user ? $post->user->name : 'user not found'}}</td>
        <td>{{$post->created_at->format('Y-m-d')}}</td>
        <td>
         
          <x-button type="info" href="{{ route('posts.show',['post' => $post->id]) }}">View</x-button>
          <x-button type="secondary" href="{{ route('posts.edit',['post' => $post->id]) }}">Edit</x-button>
          <button style="display:inline !important; margin-top:-20px !important" class="btn btn-danger" data-toggle="modal" data-target="#del_post_{{$post->id}}">Delete</button>
           </td>
          </tr>
           <div id="del_post_{{$post->id}}" class="modal fade" role="dialog">
            <div class="modal-dialog">
            <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Delete</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <form style="display:inline !important" method="POST"  action="{{route('posts.destroy', ['post' => $post->id])}}">
                  @csrf
                  @method('DELETE')
                  <div class="modal-body">
                      <h4>Do you want to delete post with title {{$post->title}} ?</h4>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                      <input class="btn btn-danger" type="submit" value="Yes">
                    </div>
                </form>
          </div>
        </div>
      </div>
        
    @endforeach
    </tbody>
</table>
{{$posts->links("pagination::bootstrap-4")}}
@endsection