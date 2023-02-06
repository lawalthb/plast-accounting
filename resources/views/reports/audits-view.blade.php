
@extends('layouts.report')
@section('content')
<div id="report-title"><h1></h1></div>
<table class="table table-sm table-striped">
    <tbody>
        <tr>
            <th>Id</th>
            <td>{{ $record->id }}</td>
        </tr>
        <tr>
            <th>User Type</th>
            <td>{{ $record->user_type }}</td>
        </tr>
        <tr>
            <th>User Id</th>
            <td>{{ $record->user_id }}</td>
        </tr>
        <tr>
            <th>Event</th>
            <td>{{ $record->event }}</td>
        </tr>
        <tr>
            <th>Auditable Type</th>
            <td>{{ $record->auditable_type }}</td>
        </tr>
        <tr>
            <th>Auditable Id</th>
            <td>{{ $record->auditable_id }}</td>
        </tr>
        <tr>
            <th>Old Values</th>
            <td>{{ $record->old_values }}</td>
        </tr>
        <tr>
            <th>New Values</th>
            <td>{{ $record->new_values }}</td>
        </tr>
        <tr>
            <th>Url</th>
            <td>{{ $record->url }}</td>
        </tr>
        <tr>
            <th>Ip Address</th>
            <td>{{ $record->ip_address }}</td>
        </tr>
        <tr>
            <th>User Agent</th>
            <td>{{ $record->user_agent }}</td>
        </tr>
        <tr>
            <th>Tags</th>
            <td>{{ $record->tags }}</td>
        </tr>
        <tr>
            <th>Created At</th>
            <td>{{ $record->created_at }}</td>
        </tr>
        <tr>
            <th>Updated At</th>
            <td>{{ $record->updated_at }}</td>
        </tr>
    </tbody>
</table>
@endsection
