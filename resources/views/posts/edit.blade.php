@extends('layouts.app')
@section('title') Edit Post @endsection
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Edit Post</h4>
                </div>
                <div class="card-body">

                    {{-- Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }} </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Form --}}
                    <form method="POST" action="{{ route('posts.update', $post->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" 
                                   class="form-control" 
                                   name="title" 
                                   placeholder="Enter post title" 
                                   value="{{ old('title', $post->title) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" 
                                      name="description" 
                                      rows="3" 
                                      placeholder="Enter post description">{{ old('description', $post->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Post Creator</label>
                            <select class="form-select" name="post_creator">
                                <option value="">-- Select User --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" 
                                        {{ old('post_creator', $post->user_id) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('posts.index') }}" class="btn btn-secondary">
                                🔙 Back
                            </a>
                            <button type="submit" class="btn btn-primary">
                                💾 Update
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
