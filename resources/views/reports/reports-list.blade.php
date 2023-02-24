
@extends('layouts.report')
@section('content')
<div id="report-title"><h1></h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Link</th>
            <th>Company Id</th>
            <th>Is Active</th>
            <th>No Views</th>
            <th>Last View Time</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->id }}</td>
            <td>{{ $record->name }}</td>
            <td>{{ $record->link }}</td>
            <td>{{ $record->company_id }}</td>
            <td>{{ $record->is_active }}</td>
            <td>{{ $record->no_views }}</td>
            <td>{{ $record->last_view_time }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
