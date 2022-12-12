@extends('dashboard')
@section('content')

<h2 class="mt-3">Course Management</h2>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Course Managemenet</li>
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
                <div class="col col-md-6">Course Management</div>
                <div class="col col-md-6">
                    <a href="{{ route('course.add') }}" class="btn btn-success btn-sm float-end">Add</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="course_table">
                    <thead>
                        <tr>
                            <th>Course Name</th>
                            <th>Subjects</th>
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
    var table = $('#course_table').DataTable({
        processing:true,
        serverSide:true,
        ajax:"{{ route('course.fetch_all') }}",
        columns:[
            {
                data:'course_name',
                name:'course_name'
            },
            {
                data:'subject',
                name:'subject'
            },
            {
                data:'created_at',
                name:'created_at'
            },
            {
                data:'updated_at',
                name:'updated_at'
            },
            {
                data:'action',
                name:'action',
                orderable:false
            }
        ]
    });

    $(document).on('click', '.delete', function(){
        var id = $(this).data('id');

        if(confirm('Are you sure want to remove it?'))
        {
            window.location.href = "/course/delete/"+id;
        }
    });
</script>
@endsection