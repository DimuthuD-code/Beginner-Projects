@extends('dashboard')
@section('content')

<h2 class="mt-3">Course Selection</h2>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/select_course">Course Selection</a></li>
        <li class="breadcrumb-item active">Select New Course</li>
    </ol>
</nav>
<div class="row mt-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Select New Course</div>
            <div class="card-body">
                <form action="{{ route('select_course.edit_validation') }}" method="post">
                    @csrf`
                    <div class="form-group mb-3">
                        <label for=""><b>Select Course</b></label>
                        <select name="course" id="course" class="form-control">
                            <option value="">Select Course</option>
                            @foreach($course_list as $course)
                            <option value="{{ $course->course_name }}">{{ $course->course_name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('course'))
                        <span class="text-danger">{{ $errors->first('course') }}</span>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for=""><b>Select Subjects</b></label>
                        <div class="col col-md-12 mt-2">    
                            <select name="subject[]" id="subject1" class="form-control dynamic" data-dependent="subject2">
                                <option value="">Select Subject</option>
                            </select>
                            @if($errors->has('subject'))
                            <span class="text-danger">{{ $errors->first('subject') }}</span>
                            @endif
                        </div>
                        <div class="col col-md-12 mt-2">    
                            <select name="subject[]" id="subject2" class="form-control dynamic" data-dependent="subject3">
                                <option value="">Select Subject</option>
                                
                            </select>
                            @if($errors->has('subject'))
                            <span class="text-danger">{{ $errors->first('subject') }}</span>
                            @endif
                        </div>
                        <div class="col col-md-12 mt-2">    
                            <select name="subject[]" id="subject3" class="form-control">
                                <option value="">Select Subject</option>
                                
                            </select>
                            @if($errors->has('subject'))
                            <span class="text-danger">{{ $errors->first('subject') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <input type="submit" class="btn btn-primary" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#course').change(function(){
            if($(this).val() != '')
            {
                var value   = $(this).val();
                var _token  = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('select_course.getsubject') }}",
                    method:"POST",
                    data:{value:value, _token:_token},
                    success:function(result)
                    {
                        $('#subject1').html(result);
                    }
                });

            }
        });
        $('.dynamic').change(function(){
            if($(this).val() != '')
            {
                var value = $('#course').val();
                var selectsubject1   = $('#subject1').val();
                var selectsubject2   = $('#subject2').val();
                var dependent = $(this).data('dependent')
                var _token  = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('select_course.getsubject') }}",
                    method:"POST",
                    data:{value:value, selectsubject1:selectsubject1, selectsubject2:selectsubject2, _token:_token},
                    success:function(result)
                    {
                        $('#'+dependent).html(result);
                    }
                });

            }
        });
    });
</script>
@endsection