
@extends('layouts.report')
@section('content')
<div id="report-title"><h1></h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Slogan</th>
            <th>Address</th>
            <th>Logo</th>
            <th>Website</th>
            <th>Favicon</th>
            <th>Com Email</th>
            <th>Com Phone</th>
            <th>Signature</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->id }}</td>
            <td>{{ $record->name }}</td>
            <td>{{ $record->slogan }}</td>
            <td>{{ $record->address }}</td>
            <td>{{ $record->logo }}</td>
            <td>{{ $record->website }}</td>
            <td>{{ $record->favicon }}</td>
            <td>{{ $record->com_email }}</td>
            <td>{{ $record->com_phone }}</td>
            <td>{{ $record->signature }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
