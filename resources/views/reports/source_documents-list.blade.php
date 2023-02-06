
@extends('layouts.report')
@section('content')
<div id="report-title"><h1></h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Numbering</th>
            <th>Document Type</th>
            <th>Have Comment</th>
            <th>Auto Print</th>
            <th>Display Title</th>
            <th>Declaration</th>
            <th>Is Active</th>
            <th>User Id</th>
            <th>Company Id</th>
            <th>For Inventory</th>
            <th>Date Created</th>
            <th>Date Updated</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->id }}</td>
            <td>{{ $record->name }}</td>
            <td>{{ $record->numbering }}</td>
            <td>{{ $record->document_type }}</td>
            <td>{{ $record->have_comment }}</td>
            <td>{{ $record->auto_print }}</td>
            <td>{{ $record->display_title }}</td>
            <td>{{ $record->declaration }}</td>
            <td>{{ $record->is_active }}</td>
            <td>{{ $record->user_id }}</td>
            <td>{{ $record->company_id }}</td>
            <td>{{ $record->for_inventory }}</td>
            <td>{{ $record->date_created }}</td>
            <td>{{ $record->date_updated }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
