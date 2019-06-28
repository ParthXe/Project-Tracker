@extends('layouts.admin1')

@section('content')

    <table class="table table-bordered ptable" style="margin-top: 40px;">
        <tr>
            <th>Project Name</th>
            <th>PO No./ WO No. </th>
            <th>Project Type</th>
            <th>Project Value</th>
            <th>Project Start Date</th>
            <th>Project Delivery Date</th>
            <th>Project Duration</th>
            <th>Project Status</th>
            <th>Project Created By</th>
            <th>Active</th>
        </tr>
        <div style="display: none;">{{ $i=1 }}</div>
        @foreach ($projects as $project)
        <tr>
            <td>{{ $projects[0]->project_name }}</td>
            <td>{{ $projects[0]->project_id }}</td>
            <td>{{ $projects[0]->project_type }}</td>
            <td>{{ $projects[0]->project_total_value }}</td>
            <td>{{ $projects[0]->project_start_date }}</td>
            <td>{{ $projects[0]->project_end_date }}</td>
            <td>{{ $projects[0]->project_duration }}</td>
            <td>{{ $projects[0]->project_status }}</td>
            <td>{{ $projects[0]->project_created_by }}</td>
            <td>@if ($projects[0]->active == 1)Yes @else No @endif</td>
        </tr>
        @endforeach
    </table>

@endsection
