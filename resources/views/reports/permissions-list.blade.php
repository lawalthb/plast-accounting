
@extends('layouts.report')
@section('content')
<div id="report-title"><h1></h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Permission Id</th>
            <th>Permission</th>
            <th>Role Id</th>
            <th>Company Id</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->permission_id }}</td>
            <td>{{ $record->permission }}</td>
            <td>{{ $record->role_id }}</td>
            <td>{{ $record->company_id }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
