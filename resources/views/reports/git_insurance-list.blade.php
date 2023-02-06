
@extends('layouts.report')
@section('content')
<div id="report-title"><h1></h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Git No</th>
            <th>Vehicle No</th>
            <th>Item Type</th>
            <th>Reg Date</th>
            <th>Driver Name</th>
            <th>Load From</th>
            <th>Going To</th>
            <th>Total Amount</th>
            <th>Is Active</th>
            <th>Date Created</th>
            <th>Date Updated</th>
            <th>Company Id</th>
            <th>Mail Sent</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->id }}</td>
            <td>{{ $record->git_no }}</td>
            <td>{{ $record->vehicle_no }}</td>
            <td>{{ $record->item_type }}</td>
            <td>{{ $record->reg_date }}</td>
            <td>{{ $record->driver_name }}</td>
            <td>{{ $record->load_from }}</td>
            <td>{{ $record->going_to }}</td>
            <td>{{ $record->total_amount }}</td>
            <td>{{ $record->is_active }}</td>
            <td>{{ $record->date_created }}</td>
            <td>{{ $record->date_updated }}</td>
            <td>{{ $record->company_id }}</td>
            <td>{{ $record->mail_sent }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
