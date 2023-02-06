
@extends('layouts.report')
@section('content')
<div id="report-title"><h1></h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Product Id</th>
            <th>Particular</th>
            <th>Reg Date</th>
            <th>Stock In</th>
            <th>Stock Out</th>
            <th>Stock Balance</th>
            <th>Doc No</th>
            <th>User Id</th>
            <th>Company Id</th>
            <th>Amount In</th>
            <th>Amount Out</th>
            <th>Ledger Id</th>
            <th>Date Created</th>
            <th>Date Updated</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->id }}</td>
            <td>{{ $record->product_id }}</td>
            <td>{{ $record->particular }}</td>
            <td>{{ $record->reg_date }}</td>
            <td>{{ $record->stock_in }}</td>
            <td>{{ $record->stock_out }}</td>
            <td>{{ $record->stock_balance }}</td>
            <td>{{ $record->doc_no }}</td>
            <td>{{ $record->user_id }}</td>
            <td>{{ $record->company_id }}</td>
            <td>{{ $record->amount_in }}</td>
            <td>{{ $record->amount_out }}</td>
            <td>{{ $record->ledger_id }}</td>
            <td>{{ $record->date_created }}</td>
            <td>{{ $record->date_updated }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
