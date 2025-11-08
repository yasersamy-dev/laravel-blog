@extends('layouts.app')
@section('title') Show Post @endsection

@section('content')
<div class="container mt-5">

    <!-- تفاصيل البوست -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            📌 Post Details
        </div>
        <div class="card-body">
            <h3 class="card-title">{{ $post->title }}</h3>
            @if($post->image)
    <img src="{{ asset('storage/'.$post->image) }}" 
         alt="Post Image" 
         class="img-fluid my-3" 
         style="max-height:300px;object-fit:cover;">
     @endif
            <p class="card-text fs-5">{{ $post->description }}</p>
            <p class="text-muted">🕒 Created at: {{ $post->created_at->format('Y-m-d H:i') }}</p>
        </div>
    </div>

    <!-- معلومات الكاتب -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-info text-white">
            👤 Post Creator
        </div>
        <div class="card-body">
            <h5>Name: {{ $post->user ? $post->user->name : 'Not Found' }}</h5>
            <h6>Email: {{ $post->user ? $post->user->email : 'Not Found' }}</h6>
        </div>
    </div>

    <!-- Actions -->
    <div class="d-flex justify-content-between">
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">⬅ Back</a>
        <div>
            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">✏ Edit</a>
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('هل أنت متأكد من الحذف 🗑️ ؟')" class="btn btn-danger">
                    🗑 Delete
                </button>
            </form>
        </div>
    </div>

</div>
@endsection

