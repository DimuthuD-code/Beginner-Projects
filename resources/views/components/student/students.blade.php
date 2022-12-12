@extends('dashboard')
@section('content')

<h2 class="mt-3">Students Managemenet</h2>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Students Managemenet</li>
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
                <div class="col col-md-6">Students Managemenet</div>
                <div class="col col-md-6">
                    <a href="{{ route('students.add') }}" class="btn btn-success btn-sm float-end">Add</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="students_table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Course</th>
                            <th>Subjects</th>
                            <th>Teacher Name</th>
                            <th>District</th>
                            <th>Created at</th>
                            <th>Updated at</th>
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
    $(document).ready(function(){
        var table = $('#students_table').DataTable({
            processing:true,
            serverSide:true,
            ajax:"{{ route('students.fetchall') }}",
            columns:[
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'course',
                    name: 'course'
                },
                {
                    data: 'subjects',
                    name: 'subjects'
                },
                {
                    data: 'teacher_name',
                    name: 'teacher_name'
                },
                {
                    data: 'district',
                    name: 'district'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'updated_at',
                    name: 'updated_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable:false
                },
            ]
        });

        $(document).on('click', '.delete', function(){
            var id = $(this).data('id');

            if(confirm('Are you sure want to remove it?'))
            {
                window.location.href = "/students/delete/"+id;
            }
            
        });
    });
</script>

@endsection