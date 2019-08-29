@extends('layouts.adminLTE')

@section('content')

<section class="content-header">
    <h1>
        {{ config('app.name') }}
        <small>Livre</small>
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
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
	            <div class="box-header">
	                <h3 class="box-title">La liste des livres</h3>
	            </div>
	            <div class="box-body">
                <button type="button" class="btn btn-primary nouveau-article" data-toggle="modal" data-target="#modal-default">
                    Nouvelle lecture
                </button>
                    <!-- /.box-header -->
                    <div class="modal fade" id="modal-default">
                        <div class="modal-dialog">
                            <div class="modal-content">

                            <form role="form" action="#" method="post">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title text-shadow">Nouvelle <strong class="">page</strong></h4>
                                </div>
                                <div class="modal-body">
                                        <!-- form start -->
                
                                        {{ csrf_field() }}
                                        
                                        <div class="box-body">
                                            {{--
                                            <div class="form-group">
                                                <label for="slug">Categories</label>
                                                    <select name="category_id" class="form-control select2" style="width: 100%;">                                                                    
                                                    @foreach( $categories as $category):
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            --}}

                                            <div class="form-group">
                                                <label for="titre">Titre</label>
                                                <input type="text" name="titre" class="form-control" id="titre" placeholder="Titre">
                                            </div>

                                            {{--
                                                <div class="form-group">
                                                    <label for="slug">Slug</label>
                                                    <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug">
                                                </div>
                                            --}}

                                            <div class="form-group">
                                                <label for="content">Content</label>
                                                <textarea  id="content" name="content" placeholder="content" class="form-control"></textarea>
                                            </div>
                                            

                                            {{--
                                                <div class="form-group">
                                                    <label for="published">Plubié
                                                    <input type="checkbox"  id="published" name="published" checked value="1" >
                                                </div>
                                            --}}

                                        </div>
                                    <!-- /.box-body -->


                                <!-- end modal-body -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                </div>
                            </form>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                    <!-- /.modal-dialog -->
                    </div>
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