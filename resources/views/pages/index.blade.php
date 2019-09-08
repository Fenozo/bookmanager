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
                
            </div>
		<div class="col-md-12">
            <span class="pull-right-container">
                <span class="label label-primary pull-right" id="count-search-page">0</span>
            </span>
			<div class="box box-primary" style="border: 0px;margin-top: 85px;padding-top:16px;">
	            <div class="box-header">
                <button type="button" style="" class="btn btn-primary nouvelle-page" data-toggle="modal" data-target="#modal-default">
                    <i class="fa fa-plus"></i>
                </button><h3 class="box-title box-search-page">La liste des pages par livre</h3>
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
                    <h2 class="h2 title">Recents shows</h2>
                    <div class="content-recent-list">
                        <ul class="recent-list">
                            <li class="search-div" data-title="recent 2" data-show="{{ route('api.page.show', ['id' => 2] ) }}">
                                <h3>recent 2</h3>
                            </li>
                            <li class="search-div" data-title="recent 2" data-show="{{ route('api.page.show', ['id' => 1] ) }}">
                                <h3>recent 1</h3>
                            </li>
                        </ul>
                    </div>
                    <!-- /.input-group -->
                </form>
                    <!-- csrt_token() -->
                    <input type="hidden" class="book-url-where" data-url="{{ route('api.livre.where') }}" >
                    <input type="hidden" class="livre-index-url" data-url="{{ route('api.livre.index') }}" >
                    <input type="hidden" class="page-list-url" data-url="{{ route('api.page.list') }}" value="{{ route('api.page.list') }}">
                    <input type="hidden" class="livre-store-url" data-url="{{ route('api.livre.store') }}" value="{{ route('api.livre.store') }}">
                    <input type="hidden" class="chapiter-url" data-url="{{ route('api.chapiter') }}" value="{{ route('api.chapiter') }}">
                    <input type="hidden" class="page-store-url" data-url="{{ route('api.page.store') }}" value="{{ route('api.page.store') }}">


                    <div class="book-modal">
                        
                    </div>
                    <!-- /.box-header -->
                    @include('livres.new')
                    <!-- /.modal -->
                    <!-- /.box-header -->
                    @include('pages.new')
                    <div class="modal fade" id="datail-modal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                    <h4>Détail sur le recherche #<span></span></h4>
                                </div>
                                <div class="modal-body">
                                    <div style="margin-bottom:12px">
                                        <a href="#" class="btn btn-info">Editer</a>
                                    </div>
                                    <h1 class="title-mini">Title...</h1>
                                    <div class="data-content">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <!-- /.box-header -->
                    <div class="modal fade" id="book-modal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form id="form-page-store" role="form" action="" method="post">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title text-shadow">Chercher <strong class="">livre</strong></h4>
                                    </div>
                                    <div class="modal-body">
                                        <h1>Liste des livres</h1>
                                      
                                            <div class="input-group">
                                                <input autocorrect="off" autocomplete="off" autocapitalize="off" type="text" id="book-search" name="search" class="form-control" placeholder="Search">

                                                <div class="input-group-btn">
                                                    <button type="submit" name="submit" class="search-page btn btn-warning btn-flat"><i class="fa fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="showing-book-list">

                                            </div>
                                            <!-- /.input-group -->
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
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

<script src="{{ asset('js/page.js') }}"></script>
<script type="text/javascript">


// alert("{{ route('api.chapiter') }}")
    

    jQuery(function(){

    recent_search_list();

    function recent_search_list () {
        $.ajax({
            url : "{{ route('api.stories.index') }}",
            method : "GET",
            dataType : "json",
            success : function(response) {
                $('.recent-list').html("");
                response.data.forEach(elem => {
                    var id = elem.id;

                    $('.recent-list').append('<li class="search-div" data-title="'
                        +elem.title+'" data-show="{{ route("api.page.show", "" ) }}/'+id+'">'
                        +elem.title+'</li>');
                    // console.log(elem);
                });
            }
        });
    }

    $(document).on("click", ".search-div", function(){
        // alert($(this).data('id')+' '+ $(this).data('title')+ ' '+ $(this).data('content'));
        $('#datail-modal').modal('show');
        $('#datail-modal').find('h4').find('span').html($(this).data('id'));
        $('#datail-modal').find('.modal-body').find('h1').html($(this).data('title'));
        // $('#datail-modal').find('.data-content').find('p').remove();
        $('#datail-modal').find('.data-content').html("");
        // $('#datail-modal').find('.data-content').html('<p>'
        //     +$(this).data('content')+
        //     '</p>');
        
        var url_show = $(this).attr('data-show');
        $.ajax({
            url : url_show,
            method : "GET",
            dataType : "json",
            success : function (response) {
                
                // Convertion de balise <?php ?>
                
                var data = response.content.replace(/\[php\]/, "&lt;?php <br/><section><code>");
                data = data.replace(/\[\/php\]/, "</code></section>?&gt;");

                // Convertion acolade
                data = data.replace(/\[acolade\]/g, "{");
                data = data.replace(/\[\/acolade\]/g, "}");

                $('#datail-modal').find('.data-content').html("<code>"+data+"</code>");
                
            },
            error : function(error) {
                console.log(error);
            }
        });

        recent_search_list();

    });
});
    (function($) {
        
        
    })(jQuery);

    // $(".content-recent-list").html();


    $(document).on('keyup', '#search-page', function() {

        var search = $(this).val();

        $.ajax({
            url: $('.page-list-url').data('url'),
            method: "GET",
            dataType : 'json',
            data: { argument: search },
            success: function(response) {
                $('.showing-page-list').find('div').remove();
                
                if (search.length == 0) {
                    $('#count-search-page').html(0);
                } else {
                    $('#count-search-page').html(response.count);
                }

                if (response.hasOwnProperty('list') && response.list.length > 0) {
                    // parcours des élements trouvé
                    response.list.forEach((elem) => {
                        // var item = JSON.stringify(elem);
                        var text = elem.text;
                        var id = elem.id;
                        var title = elem.title
                        var content = elem.content                       

                        if (search.length >0 ) {

                            $('.showing-page-list').append('<div data-id="'
                                +id+'" data-title="'
                                +title+'" data-content="'
                                +content+'" class="search-div" data-show="{{ route("api.page.show", "" ) }}/'+id+'"> '
                                + text + '</div>');
                        } else {
                            $('#count-search-page').html(0);
                            $('.showing-page-list').find('div').remove();
                        }

                    });
                }
            }
        });

    });

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