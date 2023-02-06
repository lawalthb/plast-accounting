
@extends('layouts.report')
@section('content')
<div id="report-title"><h1></h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Company Id</th>
            <th>Sub Account Group Id</th>
            <th>Ledger Name</th>
            <th>Marketer Id</th>
            <th>Address</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Contact Person</th>
            <th>Credit Amount</th>
            <th>Debit Amount</th>
            <th>Is Active</th>
            <th>User Id</th>
            <th>Reg Date</th>
            <th>Date Created</th>
            <th>Date Updated</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->id }}</td>
            <td>{{ $record->company_id }}</td>
            <td>{{ $record->sub_account_group_id }}</td>
            <td>{{ $record->ledger_name }}</td>
            <td>{{ $record->marketer_id }}</td>
            <td>{{ $record->address }}</td>
            <td>{{ $record->email }}</td>
            <td>{{ $record->phone }}</td>
            <td>{{ $record->contact_person }}</td>
            <td>{{ $record->credit_amount }}</td>
            <td>{{ $record->debit_amount }}</td>
            <td>{{ $record->is_active }}</td>
            <td>{{ $record->user_id }}</td>
            <td>{{ $record->reg_date }}</td>
            <td>{{ $record->date_created }}</td>
            <td>{{ $record->date_updated }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
