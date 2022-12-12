@extends('dashboard')
@section('content')

<h2 class="mt-3">Course Management</h2>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/course">Course Management</a></li>
        <li class="breadcrumb-item">Edit Course</li>
    </ol>
</nav>
<div class="row mt-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Edit Course</div>
            <div class="card-body">
                <form action="{{ route('course.edit_validation') }}" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <label for=""><b>Course Name</b></label>
                        <input type="text" name="course_name" id="course_name" class="form-control" value="{{ $data->course_name }}" />
                        @if($errors->has('course_name'))
                        <span class="text-danger">{{ $errors->first('course_name') }}</span>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for=""><b>Subject</b></label>
                        @php
                        $subject = explode("/ ",$data->subject)
                        @endphp

                        @for($i = 0; $i < count($subject); $i++)
                        <div class="row mt-2" id="subject_{{ $i }}">
                            <div class="col col-md-10">
                                <input type="text" name="subject[]" class="form-control course_subject" value="{{ $subject[$i] }}" />
                            </div>
                            <div class="col col-md-2">
                                @if($i == 0)
                                <button type="button" name="add_subject" id="add_subject" class="btn btn-success btn-sm">+</button>
                                @else
                                <button type="button" name="remove_subject" id="remove_subject" class="btn btn-danger btn-sm">-</button>
                                @endif
                            </div>
                        </div>
                        @endfor
                        <div id="append_subject"></div>
                    </div>
                    <div class="form-group mb-3">
                        <input type="hidden" name="hidden_id" value="{{ $data->id }}">
                        <input type="hidden" id="total_subject" value="{{ $i }}">
                        <input type="submit" name="" id="" class="btn btn-primary" value="Edit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    var count_subject = $('#total_subject').val();

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