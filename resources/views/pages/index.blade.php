@extends('layouts.adminLTE')

@section('content')

<section class="content-header">
    <h1>
        {{ config('app.name') }}
        <small>Page</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        {{--
            <li><a href="#">Forms</a></li>
        --}}
        <li class="active">Page</li>
    </ol>
</section>

<section class="content">
	<div class="row" style="max-width:560px;margin:0 auto">
            <div class="col-md-12">
                <button type="button" style="    background-color: #3be826;border-color: #3be826;" class="btn btn-primary nouveau-article" data-toggle="modal" data-target="#modal-default">
                    <i class="fa fa-plus"></i>
                    
                </button>
            </div>
		<div class="col-md-12">
			<div class="box box-primary" style="border: 0px;margin-top: 20px;">
	            <div class="box-header">
	                <h3 class="box-title">La liste des pages par livre</h3>
	            </div>
	            <div class="box-body">
                <!-- <button type="button" class="btn btn-info nouveau-article" data-toggle="modal" data-target="#modal-livre">
                    <i class="fa fa-plus"></i>
                    Nouveau Livre
                </button> -->
                <!--  -->

                <form class="search-form-page">
                    <div class="input-group">
                        <input autocorrect="off" autocomplete="off" autocapitalize="off" type="text" id="search-page" name="search" class="form-control" placeholder="Search">

                        <div class="input-group-btn">
                            <button type="submit" name="submit" class="search-page btn btn-warning btn-flat"><i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="showing-page-list">

                    </div>
                    <!-- /.input-group -->
                </form>
                    <!-- csrt_token() -->
                    
                    <input type="hidden" class="page-list-url" data-url="{{ route('api.page.list') }}" value="{{ route('api.page.list') }}">
                    <input type="hidden" class="livre-store-url" data-url="{{ route('api.livre.store') }}" value="{{ route('api.livre.store') }}">
                    <input type="hidden" class="chapiter-url" data-url="{{ route('api.chapiter') }}" value="{{ route('api.chapiter') }}">
                    <input type="hidden" class="page-store-url" data-url="{{ route('api.page.store') }}" value="{{ route('api.page.store') }}">


                    <!-- /.box-header -->
                    @include('livres.new')
                    <!-- /.modal -->
                    <!-- /.box-header -->
                    @include('pages.new')
                    
                    <!-- /.modal -->

	               <!-- page liste -->
	               <!-- page liste-->
	            </div>
	            <!-- /.box-body -->
	        </div>
		</div>
	</div>
</section>

@stop

@section('javascript')

<script src="{{ asset('js/page.js') }}"></script>
<script type="text/javascript">


// alert("{{ route('api.chapiter') }}")
/**
--------------------------------------------------------------------------------


/**
---------------------------------------------------------------------------------
 */
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