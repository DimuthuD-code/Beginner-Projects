@extends('dashboard')
@section('content')

<h2 class="mt-3">Course Management</h2>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/course">Course Management</a></li>
        <li class="breadcrumb-item">Add New Course</li>
    </ol>
</nav>
<div class="row mt-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Add New Course</div>
            <div class="card-body">
                <form action="{{ route('course.add_validation') }}" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <label for=""><b>Course Name</b></label>
                        <input type="text" name="course_name" id="course_name" class="form-control" placeholder="Course Name">
                        @if($errors->has('course_name'))
                        <span class="text-danger">{{ $errors->first('course_name') }}</span>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for=""><b>Subject</b></label>
                        <div class="row">
                            <div class="col col-md-10">
                                <input type="text" name="subject[]" class="form-control" placeholder="Subject" />
                            </div>
                            <div class="col col-md-2">
                                <button type="button" name="add_subject" id="add_subject" class="btn btn-success btn-sm">+</button>
                            </div>
                        </div>
                        <div id="append_subject"></div>
                    </div>
                    <div class="form-group mb-3">
                        <input type="submit" name="" id="" class="btn btn-primary" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    var count_subject = 0;

    $(document).on('click', '#add_subject', function(){

        count_subject++;

        var html = `<div class="row mt-2" id="subject_`+count_subject+`">
                        <div class="col col-md-10">
                            <input type="text" name="subject[]" class="form-control course_subject" placeholder="Subject" />
                        </div>
                        <div class="col col-md-2">
                            <button type="button" name="remove_subject" id="remove_subject" class="btn btn-danger btn-sm" data-id="`+count_subject+`">-</button>
                        </div>
                    </div>`;
        $('#append_subject').append(html);
    });

    $(document).on('click', '#remove_subject', function(){

        var button_id = $(this).data('id');
        $('#subject_'+button_id).remove();
    });
</script>

@endsection