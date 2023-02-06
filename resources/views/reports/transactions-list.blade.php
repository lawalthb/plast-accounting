
@extends('layouts.report')
@section('content')
<div id="report-title"><h1></h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Trans Date</th>
            <th>Reference</th>
            <th>Party Ledger Id</th>
            <th>Against Ledger Id</th>
            <th>Document Type Id</th>
            <th>Document Type Code</th>
            <th>Total Debit</th>
            <th>Total Credit</th>
            <th>Created By</th>
            <th>Company Id</th>
            <th>Trans No</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->id }}</td>
            <td>{{ $record->trans_date }}</td>
            <td>{{ $record->reference }}</td>
            <td>{{ $record->party_ledger_id }}</td>
            <td>{{ $record->against_ledger_id }}</td>
            <td>{{ $record->document_type_id }}</td>
            <td>{{ $record->document_type_code }}</td>
            <td>{{ $record->total_debit }}</td>
            <td>{{ $record->total_credit }}</td>
            <td>{{ $record->created_by }}</td>
            <td>{{ $record->company_id }}</td>
            <td>{{ $record->trans_no }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
