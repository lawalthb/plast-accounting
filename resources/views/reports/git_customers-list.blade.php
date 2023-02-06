
@extends('layouts.report')
@section('content')
<div id="report-title"><h1></h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Git Insurance Id</th>
            <th>Customer Name</th>
            <th>Invoice No</th>
            <th>Amount</th>
            <th>Comment</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->id }}</td>
            <td>{{ $record->git_insurance_id }}</td>
            <td>{{ $record->customer_name }}</td>
            <td>{{ $record->invoice_no }}</td>
            <td>{{ $record->amount }}</td>
            <td>{{ $record->comment }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
