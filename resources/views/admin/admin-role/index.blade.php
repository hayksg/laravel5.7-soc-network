@extends('layouts-admin.master')
@section('title', "| Admins")

@section('content')

<div class="blog-post mx-3">
    <h4 class="mt-3 mb-4">Admins</h4>

    @if(!$admins->count())
        <h5>The list is empty</h5>
    @else
        <div class="table-responsive">
            <table class="table table-hover table-striped" id="admin-admins-table">
                <tr>
                    <th>#</th>
                    <th>Admin Name</th>
                    <th>Created at</th>
                    <th>Picture</th>
                    <th>Action</th>
                </tr>
                @foreach($admins as $admin)
                <tr>
                    <td>{{ ++$cnt }}</td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->created_at }}</td>
                    <td>
                        <div class="admin-user-table-thumbnail">
                            @include('layouts.profile-pic', ['user' => $admin])
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('admin.role.admin.edit', ['id' => $admin->id]) }}">Edit</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    @endif
</div>

@endsection
