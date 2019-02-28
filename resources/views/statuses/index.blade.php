@extends('layouts.app')
@section('title', "| Statuses")

@section('content')

    <div class="row">

        @include('layouts.left-sidebar')

        <div class="col-lg-6 order-lg-2 col-md-12 order-3 feature-item rounded py-3 px-1">

            @if(auth()->user()->id === $user->id)
            <div class="shadow p-2 mb-3">

                <div class="row justify-content-center">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header find-friends-card-header">
                                <h5 class="d-inline-block">Type your message here</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('post.status') }}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <textarea
                                            placeholder="What's up {{ onlyName(Auth::user()->name, false) }}?"
                                            name="status"
                                            class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}"
                                            rows="3"></textarea>

                                        @if ($errors->has('status'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('status') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="upload-image d-inline-block btn btn-outline-success btn-sm">
                                        <span>Upload image</span>
                                        <input type="file" name="image" class="{{ $errors->has('image') ? 'is-invalid' : '' }}">
                                    </div>
                                    <span class="upload-img-name text-muted"></span>

                                    @if ($errors->has('image'))
                                        <span class="invalid-feedback d-inline" role="alert">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif

                                    <button type="submit" class="btn btn-outline-primary btn-sm float-right">Submit</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            @endif

            <div class="shadow p-2 mb-3">

                @if(!$statuses->count())
                
                    <h5 class="text-center">
                        @if(auth()->user()->id === $user->id)
                            There's nothing in your timeline, yet.
                        @else
                            There's nothing in {!! shortName($user->name, 20) !!}'s timeline, yet.
                        @endif
                    </h5>
                @else
                    @foreach($statuses as $key => $status)

                        <div class="card">
                            <div class="card-body">
                                <div class="user-profile-in-messages">
                                    <span class="user-img-in-messages">@include('layouts.profile-pic')</span>
                                    <span class="name-and-message-time">
                                        <a href="{{ route('getWithSlug', ['id' => Hashids::encode($status->user->id), 'slug' => $status->user->slug]) }}">{{ $user->name }}</a>
                                        <span class="message-time">{{ $status->created_at->diffForHumans() }}</span>
                                    </span>
                                </div>

                                @if($status->image)
                                <div class="mb-3">
                                    <img src="{{ asset('storage/status-images/' . $status->image) }}" alt="status-img" class="img-fluid">
                                </div>
                                @endif

                                <p>{{ $status->body }}</p>

                            </div>

                            <div class="px-3 pb-3">
                                <hr>
                                <span>Likes</span>
                                <button
                                    class="btn btn-outline-info btn-sm float-right"
                                    data-toggle="collapse"
                                    data-target="#collapseExample-{{ $key }}"
                                    aria-expanded="false"
                                    aria-controls="collapseExample"
                                >
                                    Leave a comment
                                </button>
                            </div>

                            <div class="collapse" id="collapseExample-{{ $key }}">
                                <div class="card card-body">
                                    <form action="#">
                                        <div class="form-group">
                                            <textarea class="message-textarea form-control" name="" id="" rows="3"></textarea>
                                        </div>

                                        <button class="btn btn-block btn-outline-primary btn-sm">Send</button>
                                    </form>
                                </div>
                            </div>

                        </div>

                    @endforeach
                @endif

            </div>

        </div>

        @include('layouts.right-sidebar')
    </div>

@endsection
