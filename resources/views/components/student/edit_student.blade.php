@extends('dashboard')
@section('content')

<h2 class="mt-3">Students Managemenet</h2>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/students">Students Management</a></li>
        <li class="breadcrumb-item active">Edit Student</li>
    </ol>
</nav>
<div class="row mt-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Edit Student</div>
            <div class="card-body">
                <form action="{{ route('students.edit_validation') }}" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <label for=""><b>Student Name</b></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="name" value="{{ $data->name }}" />
                        @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for=""><b>Student Email</b></label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="email" value="{{ $data->email }}" />
                        @if($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    @if(Auth::user()->type == 'Admin')
                    <div class="form-group mb-3">
                        <label for=""><b>Teacher Name</b></label>
                        <select name="teacher_name" id="teacher_name" class="form-control">
                            <option value="{{ $data->teacher_name }}">{{ $data->teacher_name }}</option>
                            @foreach($teacher_list as $teacher)
                                <option value="{{ $teacher->name}}">{{ $teacher->name}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('teacher_name'))
                        <span class="text-danger">{{ $errors->first('teacher_name') }}</span>
                        @endif
                    </div>
                    @else
                    <div class="form-group mb-3 d-none">
                        <select name="teacher_name" id="teacher_name" class="form-control">
                            <option value="{{ $data->teacher_name }}">{{ $data->teacher_name }}</option>
                        </select>
                    </div>
                    @endif
                    
                    <div class="form-group mb-3">
                        <label for=""><b>Province</b></label>
                        <select name="province" id="province" class="form-control dynamic" data-dependent="district" >
                            <option value="{{ $data->province }}">{{ $data->province }}</option>
                            @foreach($province_list as $province)
                                <option value="{{ $province->province_name}}">{{ $province->province_name}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('province'))
                        <span class="text-danger">{{ $errors->first('province') }}</span>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for=""><b>District</b></label>
                        <select name="district" id="district" class="form-control" value="">
                            <option value="{{ $data->district }}">{{ $data->district }}</option>
                        </select>
                        @if($errors->has('district'))
                        <span class="text-danger">{{ $errors->first('district') }}</span>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for=""><b>Password</b></label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" />
                    </div>
                    <div class="form-group mb-3">
                        <input type="hidden" name="hidden_id" value="{{ $data->id }}">
                        <input type="submit" class="btn btn-primary" value="Edit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.dynamic').change(function(){
            if($(this).val() != '')
            {
                var value   = $(this).val();
                var _token  = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('students.getdistrict') }}",
                    method:"POST",
                    data:{value:value, _token:_token},
                    success:function(result)
                    {
                        $('#district').html(result);
                    }
                });

            }
        });
    });
</script>

@endsection