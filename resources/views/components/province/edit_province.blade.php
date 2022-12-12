@extends('dashboard')
@section('content')

<h2 class="mt-3">Province Managemenet</h2>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/province">Province Management</a></li>
        <li class="breadcrumb-item active">Edit Province</li>
    </ol>
</nav>
<div class="row mt-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Edit Province</div>
            <div class="card-body">
                <form action="{{ route('province.edit_validation') }}" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <label for=""><b>Province Name</b></label>
                        <input type="text" name="province_name" id="province_name" class="form-control" value="{{ $data->province_name }}" />
                        @if($errors->has('province_name'))
                        <span class="text-danger">{{ $errors->first('province_name') }}</span>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for=""><b>District</b></label>
                        @php
                        $district = explode("/ ", $data->district)
                        @endphp

                        @for($i = 0; $i < count($district); $i++)
                        <div class="row mt-2" id="district_{{ $i }}">
                            <div class="col col-md-10">
                                <input type="text" name="district[]" id="" class="form-control province_district" value="{{ $district[$i] }}" />
                            </div>
                            <div class="col col-md-2">
                                @if($i == 0)
                                <button type="button" name="add_district" id="add_district" class="btn btn-success btn-sm">+</button>
                                @else
                                <button type="button" name="remove_district" id="remove_district" class="btn btn-danger btn-sm remove_district" data-id="{{ $i }}">-</button>
                                @endif
                            </div>
                        </div>
                        @endfor
                        <div id="append_district"></div>
                    </div>
                    <div class="form-group mb-3">
                        <input type="hidden" name="hidden_id" value="{{ $data->id }}">
                        <input type="hidden" id="total_district" value="{{ $i }}">
                        <input type="submit" class="btn btn-primary" value="Edit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){

        var count_district = $('#total_district').val();

        $(document).on('click', '#add_district', function(){
            
            count_district++;

            var html = `<div class="row mt-2" id="district_`+count_district+`">
                            <div class="col col-md-10">
                                <input type="text" name="district[]" id="" class="form-control province_district" placeholder="District Name" />
                            </div>
                            <div class="col col-md-2">
                                <button type="button" name="remove_district" id="remove_district" class="btn btn-danger btn-sm remove_district" data-id="`+count_district+`">-</button>
                            </div>
                        </div>`;
            
            $('#append_district').append(html);
        });

        $(document).on('click', '.remove_district', function(){

            var button_id = $(this).data('id');

            $('#district_'+button_id).remove();
        });
    });
</script>
@endsection