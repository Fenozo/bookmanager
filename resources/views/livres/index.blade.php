@extends('layouts.adminLTE')

@section('content')

<input type="hidden" id="livre-url" data-url="{{ route('api.livre.store')}}">

<section class="content-header">
    <h1>
        {{config('app.name')}}
        <small>livre</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Advanced Elements</li>
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
                <button type="button" class="btn btn-primary nouveau-article" data-toggle="modal" data-target="#modal-livre">
				<i class="fa fa-plus"></i>
                </button>
                    @include('livres.new')
	               <div id="booklist" data-url="{{ route('api.livre.list') }}">
                    <!-- page liste -->
                    <table class="table">
                        <thead>
                            <tr>
                                <td style="width:105px;">#</td>
                                <td> Nom du livre </td>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach ($livres as $livre)
                            <tr>
                                <td> {{ $livre->id }} </td>
                                <td> {{ $livre->name }} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $livres->links() }}
	               <!-- page liste-->
                   </div>
	            </div>
	            <!-- /.box-body -->
	        </div>
		</div>
	</div>
</section>


@stop

@section('javascript')

<script src="{{ asset('js/livre.js') }}"></script>

<script type="text/javascript">

$('#booklist').load($('#booklist').data('url'));
// $('#booklist').data('url')

$(document).on('click','.page-item > a', function(e){
    e.preventDefault()

    var url = this;

    $.ajax({
        url : url,
        dataType : 'html',
        success : function(response) {
            $('#booklist').html(response)
        }
    });

});

/**
* Faire une ajout d'une vouvelle livre
*
*/
$(document).on('click', '.nouveau-article', function(e) {
    e.preventDefault();
    var h4 = '<h4 class="modal-title text-shadow">Nouveau <strong class="">Livre</strong></h4>';
    $('.livre.modal-header').find('.modal-title').remove();
    $('.livre.modal-header').append(h4);
})
/**
* Faire une édite du champ livre
*
*/
$(document).on('click', 'a.edit', function(a){
    a.preventDefault()
    // alert($(this).data('id'))
    // alert($(this).data('name'))
    // alert($(this).data('author'))
    var h4 = '<h4 class="modal-title text-shadow">Modification <strong class="">Livre</strong></h4>';
    $('.livre.modal-header').find('.modal-title').remove();
    $('.livre.modal-header').append(h4);

    $('#modal-livre').modal('show')
    
})


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
        })

//Date picker
$('#date_publication').datepicker({
	autoclose: true,
	todayBtn: true,
	today: true,
	format: 'dd-mm-yyyy'
})

</script>
@stop