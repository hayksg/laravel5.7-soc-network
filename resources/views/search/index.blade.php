@extends('layouts.app')
@section('title', "| Search")

@section('content')

<div class="row">

    @include('layouts.left-sidebar')

    <div class="col-lg-9 order-lg-2 col-md-12 order-3 text-center feature-item rounded py-3 px-1">
        <div class="shadow p-2">

            <h5>Search results for "<em class="text-danger">{{ $searchString }}</em>"</h5>

        </div>
    </div>
</div>

@endsection
