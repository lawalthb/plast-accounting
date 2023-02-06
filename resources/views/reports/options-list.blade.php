
@extends('layouts.report')
@section('content')
<div id="report-title"><h1></h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Option Name</th>
            <th>Option Value</th>
            <th>Company Id</th>
            <th>Date Created</th>
            <th>Date Updated</th>
            <th>Updated By</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->id }}</td>
            <td>{{ $record->option_name }}</td>
            <td>{{ $record->option_value }}</td>
            <td>{{ $record->company_id }}</td>
            <td>{{ $record->date_created }}</td>
            <td>{{ $record->date_updated }}</td>
            <td>{{ $record->updated_by }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
