
@extends('layouts.report')
@section('content')
<div id="report-title"><h1></h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>User Type</th>
            <th>User Id</th>
            <th>Event</th>
            <th>Auditable Type</th>
            <th>Auditable Id</th>
            <th>Old Values</th>
            <th>New Values</th>
            <th>Url</th>
            <th>Ip Address</th>
            <th>User Agent</th>
            <th>Tags</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->id }}</td>
            <td>{{ $record->user_type }}</td>
            <td>{{ $record->user_id }}</td>
            <td>{{ $record->event }}</td>
            <td>{{ $record->auditable_type }}</td>
            <td>{{ $record->auditable_id }}</td>
            <td>{{ $record->old_values }}</td>
            <td>{{ $record->new_values }}</td>
            <td>{{ $record->url }}</td>
            <td>{{ $record->ip_address }}</td>
            <td>{{ $record->user_agent }}</td>
            <td>{{ $record->tags }}</td>
            <td>{{ $record->created_at }}</td>
            <td>{{ $record->updated_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
