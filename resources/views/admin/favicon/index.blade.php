@extends('layouts-admin.master')
@section('title', "| Set favicon")

@section('content')

<div class="blog-post mx-3">
    <h4 class="mt-3">Set favicon</h4>

    <form action="{{ route('admin.favicon.store') }}" method="post" class="mb-3" enctype="multipart/form-data">
        @csrf
        
        <div class="my-5">
            <img src="{{ asset('storage/favicon/favicon.ico') }}" class="img-fluid admin-img-edit" alt="image" width="100">
        </div>
        
        <div class="form-group">             
            <label for="favicon">Favicon image:</label> 

            <div class="custom-file">
                <input type="file" 
                        class="custom-file-input{{ $errors->has('image') ? ' is-invalid' : '' }}" 
                        id="favicon" 
                        name="favicon" 
                        required="required">
                <label class="custom-file-label" for="image">only .ico extension is allowed</label>
            </div>

            @if ($errors->has('favicon'))
                <span class="invalid-feedback" role="alert" style="display: block;">
                    <strong>{{ $errors->first('favicon') }}</strong>
                </span>
            @endif

        </div>

        <hr>
        
        <div class="form-group">  
            <button type="submit" class="btn btn-primary">Upload</button>
        </div>
    </form>
</div>

@endsection
