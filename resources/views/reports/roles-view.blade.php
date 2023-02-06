
@extends('layouts.report')
@section('content')
<div id="report-title"><h1></h1></div>
<table class="table table-sm table-striped">
    <tbody>
        <tr>
            <th>Role Id</th>
            <td>{{ $record->role_id }}</td>
        </tr>
        <tr>
            <th>Role Name</th>
            <td>{{ $record->role_name }}</td>
        </tr>
        <tr>
            <th>Company Id</th>
            <td>{{ $record->company_id }}</td>
        </tr>
        <tr>
            <th>Date Created</th>
            <td>{{ $record->date_created }}</td>
        </tr>
        <tr>
            <th>Date Updated</th>
            <td>{{ $record->date_updated }}</td>
        </tr>
    </tbody>
</table>
@endsection
