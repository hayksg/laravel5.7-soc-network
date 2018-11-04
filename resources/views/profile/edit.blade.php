@extends('layouts.app')
@section('title', "| Profile")

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                {{ __('Edit your profile information') }}
                <a href="{{ route('getWithSlug', [$user->slug]) }}" class="float-right">To Profile &raquo;</a>
            </div>

            <div class="card-body">
                <form action="{{ route('profile.update', ['id' => $user->id]) }}" class="app-edit-user-profile" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" name="city" id="city" value="{{ $profile->city }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="country">Country</label>
                        <input type="text" name="country" id="country" value="{{ $profile->country }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="about">About</label>
                        <textarea name="about" class="form-control" id="about">{{ $profile->about }}</textarea>
                    </div>

                    <div class="form-group">
                        <div class="my-4 text-center d-inline-block app-user-profile">
                            @include('layouts.profile-pic')
                        </div>
                        <div class="mb-2">Change image</div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input{{ $errors->has('image') ? ' is-invalid' : '' }}"
                                   id="image"
                                   name="image">
                            <label class="custom-file-label" for="image">Choose file</label>
                        </div>

                        @if ($errors->has('image'))
                            <span class="invalid-feedback" role="alert" style="display: block;">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                        @endif

                    </div>

                    <button type="submit" name="button" class="btn btn-primary mt-3">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
