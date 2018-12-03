@extends('layouts.app')
@section('title', "| Home")

@section('content')

<div class="row">

    @include('layouts.left-sidebar')

    <div class="col-lg-6 order-lg-2 col-md-12 order-3 text-center feature-item rounded py-3 px-1">
        <div class="shadow">
            <div class="">
                <h4 class="">Another title.</h4>
                <p class="p-2">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sapiente delectus beatae numquam obcaecati consectetur modi, fugit alias. Sint repellat, dignissimos enim in optio molestiae eveniet consequuntur ducimus tenetur dolorem vitae sequi facere, dolores aspernatur quae alias inventore ad tempora? Maxime reprehenderit molestias ullam? Et qui totam dolor animi facere voluptas similique voluptates aliquam, alias non libero aspernatur tempore delectus quibusdam repudiandae accusantium repellat architecto enim odit consequatur sit quisquam culpa. Autem consequuntur possimus laborum.
                </p>
            </div>
        </div>
    </div>

    @include('layouts.right-sidebar')

</div>

@endsection
