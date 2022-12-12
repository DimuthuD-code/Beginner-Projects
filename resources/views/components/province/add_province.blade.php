@extends('dashboard')
@section('content')

<h2 class="mt-3">Province Managemenet</h2>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/province">Province Management</a></li>
        <li class="breadcrumb-item active">Add New Province</li>
    </ol>
</nav>
<div class="row mt-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Add New Province</div>
            <div class="card-body">
                <form action="{{ route('province.add_validation') }}" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <label for=""><b>Province Name</b></label>
                        <input type="text" name="province_name" id="province_name" class="form-control" placeholder="Province Name" />
                        @if($errors->has('province_name'))
                        <span class="text-danger">{{ $errors->first('province_name') }}</span>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for=""><b>District</b></label>
                        <div class="row">
                            <div class="col col-md-10">
                                <input type="text" name="district[]" id="" class="form-control" placeholder="District Name" />
                            </div>
                            <div class="col col-md-2">
                                <button type="button" name="add_district" id="add_district" class="btn btn-success btn-sm">+</button>
                            </div>
                        </div>
                        <div id="append_district"></div>
                    </div>
                    <div class="form-group mb-3">
                        <input type="submit" class="btn btn-primary" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){

        var count_district = 0;

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