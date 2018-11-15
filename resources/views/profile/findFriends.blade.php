@extends('layouts.app')
@section('title', "| Find friends")

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12 col-lg-12 col-xl-10">
        {{ $allFriends }}
    </div>
</div>

@endsection
