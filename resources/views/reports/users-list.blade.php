
@extends('layouts.report')
@section('content')
<div id="report-title"><h1></h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role Id</th>
            <th>Phone</th>
            <th>Photo</th>
            <th>User Type</th>
            <th>Date Join</th>
            <th>Is Active</th>
            <th>Company Id</th>
            <th>Username</th>
            <th>Email Verified At</th>
            <th>User Role Id</th>
            <th>Date Created</th>
            <th>Date Updated</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->id }}</td>
            <td>{{ $record->firstname }}</td>
            <td>{{ $record->lastname }}</td>
            <td>{{ $record->email }}</td>
            <td>{{ $record->role_id }}</td>
            <td>{{ $record->phone }}</td>
            <td>{{ $record->photo }}</td>
            <td>{{ $record->user_type }}</td>
            <td>{{ $record->date_join }}</td>
            <td>{{ $record->is_active }}</td>
            <td>{{ $record->company_id }}</td>
            <td>{{ $record->username }}</td>
            <td>{{ $record->email_verified_at }}</td>
            <td>{{ $record->user_role_id }}</td>
            <td>{{ $record->date_created }}</td>
            <td>{{ $record->date_updated }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
