@extends('dashboard')
@section('content')

<h2 class="mt-3">Teachers Managemenet</h2>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Teachers Managemenet</li>
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
                <div class="col col-md-6">Teachers Managemenet</div>
                <div class="col col-md-6">
                    <a href="{{ route('teachers.add') }}" class="btn btn-success btn-sm float-end">Add</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="teachers_table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
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
        var table = $('#teachers_table').DataTable({
            processing:true,
            serverSide:true,
            ajax:"{{ route('teachers.fetchall') }}",
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
                window.location.href = "/teachers/delete/"+id;
            }
            
        });
    });
</script>

@endsection