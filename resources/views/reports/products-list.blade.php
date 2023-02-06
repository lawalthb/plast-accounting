
@extends('layouts.report')
@section('content')
<div id="report-title"><h1></h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Company Id</th>
            <th>Name</th>
            <th>Category</th>
            <th>Image</th>
            <th>Mfg Date</th>
            <th>Exp Date</th>
            <th>Qty</th>
            <th>Selling Price</th>
            <th>Purchase Price</th>
            <th>Dead Stock</th>
            <th>Is Active</th>
            <th>User Id</th>
            <th>Unit</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->id }}</td>
            <td>{{ $record->company_id }}</td>
            <td>{{ $record->name }}</td>
            <td>{{ $record->category }}</td>
            <td>{{ $record->image }}</td>
            <td>{{ $record->mfg_date }}</td>
            <td>{{ $record->exp_date }}</td>
            <td>{{ $record->qty }}</td>
            <td>{{ $record->selling_price }}</td>
            <td>{{ $record->purchase_price }}</td>
            <td>{{ $record->dead_stock }}</td>
            <td>{{ $record->is_active }}</td>
            <td>{{ $record->user_id }}</td>
            <td>{{ $record->unit }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
