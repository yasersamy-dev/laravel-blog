@extends('layouts.app')
@section('title') All Posts @endsection
@section('content')
<div class="container mt-5">

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>📋 All Posts</h2>
    <a href="{{ route('posts.create') }}" class="btn btn-success">
      <i class="bi bi-plus-circle"></i> Create Post
    </a>
  </div>

  <table class="table table-hover table-striped table-bordered text-center">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>Title</th>
        <th>Posted By</th>
        <th>Created At</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($posts as $post)
      <tr>
        <td>{{ $post->id }}</td>
        <td>{{ $post->title }}</td>
        <td>{{ $post->user ? $post->user->name : "Not found" }}</td>
        <td>{{ $post->created_at->format('M d, Y') }}</td>
        <td>
          <a href="{{ route('posts.show',$post->id) }}" class="btn btn-info btn-sm">
            <i class="bi bi-eye"></i> View
          </a>
          <a href="{{ route('posts.edit',$post->id) }}" class="btn btn-primary btn-sm">
            <i class="bi bi-pencil"></i> Edit
          </a>
          <form action="{{ route('posts.destroy',$post->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من الحذف 🗑️؟')">
              <i class="bi bi-trash"></i> Delete
            </button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <div class="d-flex justify-content-center">
    <div class="d-flex justify-content-center mt-4">
    {{ $posts->links('pagination.custom') }}
</div>

  </div>

</div>
@endsection
