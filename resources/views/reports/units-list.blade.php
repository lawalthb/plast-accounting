
@extends('layouts.report')
@section('content')
<div id="report-title"><h1></h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Symbol</th>
            <th>Status</th>
            <th>Company Id</th>
            <th>User Id</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->id }}</td>
            <td>{{ $record->name }}</td>
            <td>{{ $record->symbol }}</td>
            <td>{{ $record->status }}</td>
            <td>{{ $record->company_id }}</td>
            <td>{{ $record->user_id }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
