
@extends('layouts.report')
@section('content')
<div id="report-title"><h1></h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Transactions Id</th>
            <th>Ledger Id</th>
            <th>Debit Id</th>
            <th>Credit Id</th>
            <th>Comment</th>
            <th>Company Id</th>
            <th>Date Created</th>
            <th>Date Updated</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->id }}</td>
            <td>{{ $record->transactions_id }}</td>
            <td>{{ $record->ledger_id }}</td>
            <td>{{ $record->debit_id }}</td>
            <td>{{ $record->credit_id }}</td>
            <td>{{ $record->comment }}</td>
            <td>{{ $record->company_id }}</td>
            <td>{{ $record->date_created }}</td>
            <td>{{ $record->date_updated }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
