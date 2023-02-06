
@extends('layouts.report')
@section('content')
<div id="report-title"><h1></h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Company Id</th>
            <th>Name</th>
            <th>User Id</th>
            <th>Is Active</th>
            <th>Date Created</th>
            <th>Date Updated</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->id }}</td>
            <td>{{ $record->company_id }}</td>
            <td>{{ $record->name }}</td>
            <td>{{ $record->user_id }}</td>
            <td>{{ $record->is_active }}</td>
            <td>{{ $record->date_created }}</td>
            <td>{{ $record->date_updated }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
