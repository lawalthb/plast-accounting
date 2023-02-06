
@extends('layouts.report')
@section('content')
<div id="report-title"><h1></h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Method Numbering</th>
            <th>Prefix</th>
            <th>Starting Num</th>
            <th>Common Description</th>
            <th>Print Onsave</th>
            <th>Desc Each Line</th>
            <th>Document Code</th>
            <th>Company Id</th>
            <th>Date Created</th>
            <th>Date Updated</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->id }}</td>
            <td>{{ $record->name }}</td>
            <td>{{ $record->method_numbering }}</td>
            <td>{{ $record->prefix }}</td>
            <td>{{ $record->starting_num }}</td>
            <td>{{ $record->common_description }}</td>
            <td>{{ $record->print_onsave }}</td>
            <td>{{ $record->desc_each_line }}</td>
            <td>{{ $record->document_code }}</td>
            <td>{{ $record->company_id }}</td>
            <td>{{ $record->date_created }}</td>
            <td>{{ $record->date_updated }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
