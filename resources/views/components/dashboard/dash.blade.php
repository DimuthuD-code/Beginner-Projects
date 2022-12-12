@extends('dashboard')
@section('content')

<div class="container">
    <h3 class="mt-3" align="left">Dashboard</h3>
    <br>
    <div class="row">
        <div class="col col-md-2">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <h6 class="text-muted">Teachers</h6>
                            <h2>{{ $teacher_count }}</h2>
                        </div>
                        <div class="col-md-3">
                            <span class="border"><i class="fas fa-chalkboard-teacher"></i></span>
                        </div>
                    </div>
                    <div class="row">

                    </div>
                </div>
            </div>
        </div>
        <div class="col col-md-2">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <h6 class="text-muted">Students</h6>
                            <h2>{{ $student_count }}</h2>
                        </div>
                        <div class="col-md-3">
                            <span class="border"><i class="fa-solid fa-user-graduate"></i></span>
                        </div>
                    </div>
                    <div class="row">

                    </div>
                </div>
            </div>            
        </div>
        <div class="col col-md-2">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <h6 class="text-muted">Courses</h6>
                            <h2>{{ $course_count }}</h2>
                        </div>
                        <div class="col-md-3">
                            <span class="border"><i class="fa-solid fa-graduation-cap"></i></span>
                        </div>
                    </div>
                    <div class="row">

                    </div>
                </div>
            </div>            
        </div>
        <div class="col col-md-2">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <h6 class="text-muted">Subjects</h6>
                            <h2>1234</h2>
                        </div>
                        <div class="col-md-3">
                            <span class="border"><i class="fa-solid fa-book"></i></span>
                        </div>
                    </div>
                    <div class="row">

                    </div>
                </div>
            </div>
        </div>
        <div class="col col-md-2">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <h6 class="text-muted">Provinces</h6>
                            <h2>{{ $province_count }}</h2>
                        </div>
                        <div class="col-md-3">
                            <span class="border"><i class="fas fa-map"></i></span>
                        </div>
                    </div>
                    <div class="row">

                    </div>
                </div>
            </div>
        </div>
        <div class="col col-md-2">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <h6 class="text-muted">Districts</h6>
                            <h2>1234</h2>
                        </div>
                        <div class="col-md-3">
                            <span class="border"><i class="fa-solid fa-chart-area"></i></span>
                        </div>
                    </div>
                    <div class="row">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col col-md-6">
            <div class="card">
                <div class="card-body">
                    <div id="teacher_chart" style="width:400px; height:300px;">

                    </div>
                </div>
            </div>
        </div>
        <div class="col col-md-6">
            <div class="card">
                <div class="card-body">
                    <div id="student_chart" style="width:400px; height:300px;">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var analytics = <?php echo $teacherprovince; ?>

    google.charts.load('current', {packages: ['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart()
    {
        var data = google.visualization.arrayToDataTable(analytics);
        var options = {title : 'Teacher Vs Province'};
        var chart = new  google.visualization.ColumnChart(document.getElementById('teacher_chart'));
        chart.draw(data, options);
    }
</script>
<script type="text/javascript">
    var analytics = <?php echo $studentprovince; ?>

    google.charts.load('current', {packages: ['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart()
    {
        var data = google.visualization.arrayToDataTable(analytics);
        var options = {title : 'Student Vs Province'};
        var chart = new  google.visualization.ColumnChart(document.getElementById('student_chart'));
        chart.draw(data, options);
    }
</script>
@endsection