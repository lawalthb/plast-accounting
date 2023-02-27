
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
            <th>Name</th>
            <td>{{ $record->name }}</td>
        </tr>
        <tr>
            <th>Link</th>
            <td>{{ $record->link }}</td>
        </tr>
        <tr>
            <th>Company Id</th>
            <td>{{ $record->company_id }}</td>
        </tr>
        <tr>
            <th>Is Active</th>
            <td>{{ $record->is_active }}</td>
        </tr>
        <tr>
            <th>No Views</th>
            <td>{{ $record->no_views }}</td>
        </tr>
        <tr>
            <th>Last View Time</th>
            <td>{{ $record->last_view_time }}</td>
        </tr>
        <tr>
            <th>Report Code</th>
            <td>{{ $record->report_code }}</td>
        </tr>
    </tbody>
</table>
@endsection
