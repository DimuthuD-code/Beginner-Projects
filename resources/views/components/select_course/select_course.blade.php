@extends('dashboard')
@section('content')

<h2 class="mt-3">Course Selection</h2>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Course Selection</li>
    </ol>
</nav>
<div class="mt-4 mb-4">
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col col-md-6">Course Selector</div>
                <div class="col col-md-6">
                    <a href="{{ route('select_course.add') }}" class="btn btn-success btn-sm float-end">Select</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="select_course_table">
                    <thead>
                        <tr>
                            <th>Course</th>
                            <th>Subjects</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    var table = $('#select_course_table').DataTable({
        processing:true,
        serverSide:true,
        ajax:"{{ route('select_course.fetch_all') }}",
        columns:[
            {
                data: 'course',
                name: 'course'
            },
            {
                data: 'subjects',
                name: 'subjects'
            },
            {
                data: 'action',
                name: 'action',
                orderable:false
            }
        ]
    });
</script>
@endsection