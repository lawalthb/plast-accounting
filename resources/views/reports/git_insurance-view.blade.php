
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
            <th>Git No</th>
            <td>{{ $record->git_no }}</td>
        </tr>
        <tr>
            <th>Vehicle No</th>
            <td>{{ $record->vehicle_no }}</td>
        </tr>
        <tr>
            <th>Item Type</th>
            <td>{{ $record->item_type }}</td>
        </tr>
        <tr>
            <th>Reg Date</th>
            <td>{{ $record->reg_date }}</td>
        </tr>
        <tr>
            <th>Driver Name</th>
            <td>{{ $record->driver_name }}</td>
        </tr>
        <tr>
            <th>Load From</th>
            <td>{{ $record->load_from }}</td>
        </tr>
        <tr>
            <th>Going To</th>
            <td>{{ $record->going_to }}</td>
        </tr>
        <tr>
            <th>Total Amount</th>
            <td>{{ $record->total_amount }}</td>
        </tr>
        <tr>
            <th>Is Active</th>
            <td>{{ $record->is_active }}</td>
        </tr>
        <tr>
            <th>Date Created</th>
            <td>{{ $record->date_created }}</td>
        </tr>
        <tr>
            <th>Date Updated</th>
            <td>{{ $record->date_updated }}</td>
        </tr>
        <tr>
            <th>Company Id</th>
            <td>{{ $record->company_id }}</td>
        </tr>
        <tr>
            <th>Mail Sent</th>
            <td>{{ $record->mail_sent }}</td>
        </tr>
        <tr>
            <th>Charges</th>
            <td>{{ $record->charges }}</td>
        </tr>
    </tbody>
</table>
@endsection
