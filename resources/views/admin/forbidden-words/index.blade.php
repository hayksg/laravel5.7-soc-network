@extends('layouts-admin.master')
@section('title', "| Forbidden words")

@section('content')

<div class="blog-post mx-3">
    <h4 class="mt-3">Forbidden words</h4>

    <form action="{{ route('admin.forbidden.words.add') }}" method="post" class="mt-3">
        @csrf

        <div class="form-group">             
            <label for="words">Add words separated by a space:</label> 

            <textarea 
                class="form-control" 
                name="words" 
                placeholder="Leave this field empty if you don't want to have any forbidden words"
                id="words">{{ $wordsFromStorage }}</textarea>

            @if ($errors->has('words'))
                <span class="invalid-feedback" role="alert" style="display: block;">
                    <strong>{{ $errors->first('words') }}</strong>
                </span>
            @endif

        </div>

        <div class="form-group">  
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

</div>

@endsection
