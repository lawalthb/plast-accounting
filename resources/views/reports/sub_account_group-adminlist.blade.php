
@extends('layouts.report')
@section('content')
<div id="report-title"><h1></h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Company Id</th>
            <th>Account Group Id</th>
            <th>Name</th>
            <th>Code</th>
            <th>Description</th>
            <th>Total Amount</th>
            <th>User Id</th>
            <th>Date Created</th>
            <th>Date Updated</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->id }}</td>
            <td>{{ $record->company_id }}</td>
            <td>{{ $record->account_group_id }}</td>
            <td>{{ $record->name }}</td>
            <td>{{ $record->code }}</td>
            <td>{{ $record->description }}</td>
            <td>{{ $record->total_amount }}</td>
            <td>{{ $record->user_id }}</td>
            <td>{{ $record->date_created }}</td>
            <td>{{ $record->date_updated }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
