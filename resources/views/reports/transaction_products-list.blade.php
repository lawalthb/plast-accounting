
@extends('layouts.report')
@section('content')
<div id="report-title"><h1></h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Transactions Id</th>
            <th>Product Id</th>
            <th>Quantity</th>
            <th>Rate</th>
            <th>Amount</th>
            <th>Comment</th>
            <th>Location Id</th>
            <th>Company Id</th>
            <th>Tp Date</th>
            <th>Date Created</th>
            <th>Date Updated</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->id }}</td>
            <td>{{ $record->transactions_id }}</td>
            <td>{{ $record->product_id }}</td>
            <td>{{ $record->quantity }}</td>
            <td>{{ $record->rate }}</td>
            <td>{{ $record->amount }}</td>
            <td>{{ $record->comment }}</td>
            <td>{{ $record->location_id }}</td>
            <td>{{ $record->company_id }}</td>
            <td>{{ $record->tp_date }}</td>
            <td>{{ $record->date_created }}</td>
            <td>{{ $record->date_updated }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
