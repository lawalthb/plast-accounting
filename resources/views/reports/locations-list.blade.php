
@extends('layouts.report')
@section('content')
<div id="report-title"><h1></h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Company Id</th>
            <th>Created By</th>
            <th>Is Active</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->id }}</td>
            <td>{{ $record->name }}</td>
            <td>{{ $record->company_id }}</td>
            <td>{{ $record->created_by }}</td>
            <td>{{ $record->is_active }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
