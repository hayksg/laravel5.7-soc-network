@extends('layouts-admin.master')
@section('title', "| Statuses")

@section('content')

<div class="blog-post mx-3">
    <h4 class="mt-3 mb-4">Statuses</h4>

    @if (!$statuses->count())
        <h5>The list is empty</h5>
    @else
        <div class="form-group">
            <label for="status-filter">Filter statuses:</label>
            <input type="text" class="form-control" id="status-filter">
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover" id="admin-statuses-table">
                <tr>
                    <th>#</th>
                    <th>Author</th>
                    <th>Text</th>
                    <th>Date</th>
                    <th>Full Info</th>
                </tr>
                @foreach($statuses as $status)
                <tr>
                    <td>{{ ++$cnt }}</td>
                    <td>{!! shortName($status->user->name, 20) !!}</td>
                    <td>{{ str_limit($status->body, $limit = 70, $end = '...') }}</td>
                    <td>{{ $status->created_at }}</td>
                    <td>
                        <a href="{{ route('admin.status.view', ['id' => $status->id]) }}" class="btn btn-info btn-sm">View</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    @endif
</div>

@endsection
