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
                                            required
                                            rows="3"></textarea>

                                        @if ($errors->has('status'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('status') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <input 
                                            type="text" 
                                            name="video" 
                                            class="form-control{{ $errors->has('video') ? ' is-invalid' : '' }}"
                                            placeholder="URL for video">
                                        
                                        @if ($errors->has('video'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('video') }}</strong>
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

                        <div class="card mb-3">
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

                                @if($status->video_url)
                                <div class="mb-3">
                                
                                    <video class="mejs__player video-container img-fluid" preload="preload">
                                        <source type="video/youtube" src="{{ $status->video_url }}" />
                                    </video>
                                    
                                </div>
                                @endif

                                <div>{!! replaceForbiddenWords(app_nl2br($status->body)) !!}</div>

                            </div>

                            <div class="px-3 pb-3">
                                <hr>
                                @if(auth()->user()->isFriendsWith($user))

                                    <vue-like
                                        path="{{ route('status.like', ['statusId' => $status->id]) }}"
                                        status-id="{{ $status->id }}"
                                    >
                                    </vue-like>
                                    
                                @endif
                                <span ref="likesCount{{$status->id}}" class="badge badge-primary app-badge">
                                    {{ $status->likes->count() }}
                                </span>
                                @if(auth()->user()->id === $user->id)
                                    <span>{{ str_plural('Like', $status->likes->count()) }}</span>
                                @endif
                                @if(auth()->user()->isFriendsWith($user))
                                    <button
                                        class="btn btn-outline-info btn-sm float-right"
                                        data-toggle="collapse"
                                        data-target="#collapseExample-{{ $key }}"
                                        aria-expanded="false"
                                        aria-controls="collapseExample"
                                    >
                                        Leave a comment
                                    </button>
                                @endif
                            </div>

                            <div class="collapse{{ $errors->has('reply-' . $status->id) ? ' show' : '' }}" id="collapseExample-{{ $key }}">
                                <div class="card card-body">
                                    <form action="{{ route('status.reply', ['statusId' => $status->id]) }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <textarea 
                                                class="message-textarea form-control{{ $errors->has('reply-' . $status->id) ? ' is-invalid' : '' }}"
                                                name="reply-{{ $status->id }}" 
                                                placeholder="Reply to this status"
                                                required
                                                rows="3"></textarea>

                                                @if ($errors->has("reply-{$status->id}" ))
                                                    <span class="invalid-feedback d-inline" role="alert">
                                                        <strong>{{ $errors->first("reply-{$status->id}" ) }}</strong>
                                                    </span>
                                                @endif
                                        </div>

                                        <button class="btn btn-block btn-outline-primary btn-sm">Send</button>
                                    </form>
                                </div>
                            </div>

                            @if($status->replies->count())
                            <div class="card-body">
                                <div class="mb-3">
                                    <span>{{ str_plural('Comment', $status->replies->count()) }}:</span>
                                    <span class="badge badge-primary app-badge">{{ $status->replies->count() }}</span>
                                </div>
                                <ul class="list-group app-users-comments-block">
                                @foreach($status->replies as $reply)
                                    <li class="list-group-item mb-2">
                                        <div class="reply-user-img">
                                            <a href="{{ route('get.status', ['id' => Hashids::encode($reply->user->id), 'slug' => $reply->user->slug]) }}">
                                                @include('layouts.profile-pic', ['user' => $reply->user])
                                            </a>
                                            <div>
                                                <div>
                                                    <a href="{{ route('get.status', ['id' => Hashids::encode($reply->user->id), 'slug' => $reply->user->slug]) }}">
                                                        {{ $reply->user->name }}
                                                    </a>
                                                </div>
                                                <span class="message-time">{{ $reply->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-3">{!! replaceForbiddenWords(app_nl2br($reply->body)) !!}</div>
                                    </li>
                                @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>

                    @endforeach
                @endif

            </div>

        </div>

        @include('layouts.right-sidebar')
    </div>

@endsection
