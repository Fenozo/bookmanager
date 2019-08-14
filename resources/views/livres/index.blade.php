@extends('layouts.adminLTE')

@section('content')

<section class="content-header">
    <h1>
        Advanced Form Elements
        <small>Preview</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Advanced Elements</li>
    </ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
	            <div class="box-header">
	                <h3 class="box-title">Date picker</h3>
	            </div>
	            <div class="box-body">
	                <!-- Date -->
	                <div class="form-group">
	                    <label>Date:</label>

	                    <div class="input-group date">
	                        <div class="input-group-addon">
	                            <i class="fa fa-calendar"></i>
	                        </div>
	                        <input type="text" class="form-control pull-right" id="datepicker">
	                    </div>
	                    <!-- /.input group -->
	                </div>
	                <!-- /.form group -->

	                <!-- Date range -->
	                <div class="form-group">
	                    <label>Date range:</label>

	                    <div class="input-group">
	                        <div class="input-group-addon">
	                            <i class="fa fa-calendar"></i>
	                        </div>
	                        <input type="text" class="form-control pull-right" id="reservation">
	                    </div>
	                    <!-- /.input group -->
	                </div>
	                <!-- /.form group -->

	                <!-- Date and time range -->
	                <div class="form-group">
	                    <label>Date and time range:</label>

	                    <div class="input-group">
	                        <div class="input-group-addon">
	                            <i class="fa fa-clock-o"></i>
	                        </div>
	                        <input type="text" class="form-control pull-right" id="reservationtime">
	                    </div>
	                    <!-- /.input group -->
	                </div>
	                <!-- /.form group -->

	                <!-- Date and time range -->
	                <div class="form-group">
	                    <label>Date range button:</label>

	                    <div class="input-group">
	                        <button type="button" class="btn btn-default pull-right" id="daterange-btn">
		                    <span>
		                      <i class="fa fa-calendar"></i> Date range picker
		                    </span>
		                    <i class="fa fa-caret-down"></i>
		                  </button>
	                    </div>
	                </div>
	                <!-- /.form group -->

	            </div>
	            <!-- /.box-body -->
	        </div>
		</div>
	</div>
</section>

@stop

@section('javascript')

<script type="text/javascript">

//Date range picker
$('#reservation').daterangepicker()
    //Date range picker with time picker
$('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        format: 'MM/DD/YYYY h:mm A'
    })

//Date range as a button
            $('#daterange-btn').daterangepicker({
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment()
                },
                function(start, end) {
                    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
                }
            )

//Date picker
$('#datepicker').datepicker({
	autoclose: true
})

</script>
@stop