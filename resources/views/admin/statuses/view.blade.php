@extends('layouts-admin.master')
@section('title', "| View Status")

@section('content')

<div class="blog-post mx-3">
    <h4 class="mt-3 mb-4">Status Info</h4>

    <h5>
        Author: <strong><em>{{ $status->user->name }}</em></strong>
        <br>
        <small>Created at: <strong><em>{{ $status->created_at }}</em></strong></small>
    </h5>
    
    <div class="my-4"><em>{!! app_nl2br($status->body) !!}</em></div>
    
    @if($status->image)
    <div class="my-4">
        <img src="{{ asset('storage/status-images/' . $status->image) }}" width="400" alt="status-image" class="img-fluid">
    </div>
    @endif

    @if($status->video_url)
    <div class="mb-3">
    
        <video class="mejs__player video-container-admin-area img-fluid" preload="preload">
            <source type="video/youtube" src="{{ $status->video_url }}" />
        </video>
        
    </div>
    @endif

    <hr>

    <form 
        action="{{ route('admin.status.delete', ['id' => $status->id]) }}"
        method="post"
        onsubmit="return confirm('Are you sure?')"
    >
        @csrf

        <button class="btn btn-danger" type="submit">Delete Status</button>
    </form>

</div>

@endsection
