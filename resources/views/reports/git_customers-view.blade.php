
@extends('layouts.report')
@section('content')
<div id="report-title"><h1></h1></div>
<table class="table table-sm table-striped">
    <tbody>
        <tr>
            <th>Id</th>
            <td>{{ $record->id }}</td>
        </tr>
        <tr>
            <th>Git Insurance Id</th>
            <td>{{ $record->git_insurance_id }}</td>
        </tr>
        <tr>
            <th>Customer Name</th>
            <td>{{ $record->customer_name }}</td>
        </tr>
        <tr>
            <th>Invoice No</th>
            <td>{{ $record->invoice_no }}</td>
        </tr>
        <tr>
            <th>Amount</th>
            <td>{{ $record->amount }}</td>
        </tr>
        <tr>
            <th>Comment</th>
            <td>{{ $record->comment }}</td>
        </tr>
    </tbody>
</table>
@endsection
