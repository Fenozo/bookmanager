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
	<div class="row" style="max-width:400px;margin:0 auto">
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
                        <input type="text" id="search-page" name="search" class="form-control" placeholder="Search">

                        <div class="input-group-btn">
                            <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="showing-page-list">

                    </div>
                    <!-- /.input-group -->
                </form>
                
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

<script type="text/javascript">

jQuery(function(){
    $(document).on('keyup', '#search-page', function() {
        // console.log($(this).val())

        

        var arg = $(this).val();
        
        if (arg.length > 0) {
            $.ajax({
                url : "{{ route('api.page.list') }}",
                method : "GET",
                data : { argument : arg},
                success : function (response)
                {
                    $('.showing-page-list').find('div').remove();
                    response.forEach((elem)=> {
                        var titre = elem.title;
                        var content = elem.content;
                        // titre = titre.replace(/\[b\]([\s\S]*?)\[\/b\]/g, '<strong>$1</stong>');
                        // content = content.replace(/\[b\]([\s\S]*?)\[\/b\]/g, '<strong>$1</stong>');

                        $('.showing-page-list').append('<div>'+titre+' '+content+'</div>');
                    // console.log(elem.title)
                    var text = 'bla bla [b]un peu de texte[/b] bla [b]bla bla en gras[/b] bla bla';
                    result = text.replace(/\[b\]([\s\S]*?)\[\/b\]/g, '<strong>$1</strong>');
                    // var result = sentence.replace(/Sébastien/, 'Johann');
                    console.log(result);

                    })
                }
            });
        } else {
            $('.showing-page-list').find('div').remove();
        }
        

    });
});

jQuery(function(){

    $(document).on('click', '#save-livre', (e)=>{
        e.preventDefault()
        
        var datas = $('#form-livre-store').serialize();

        $.ajax({
            url : "{{ route('api.livre.store') }}"
        });
        alert(datas);
    });

    //Date picker
    $('#livre_datepicker').datepicker({
        autoclose: true,
        todayBtn: true,
        today: true,
        format : 'dd-mm-yyyy'
    })

});

jQuery(function(){
    $('.select2').select2();
    save_page ();
    getLitCapiter() ;

    var chap = '<div class="form-group chap"><label for="chapiter">Chapitre</label><input type="text" name="chapiter" class="form-control" id="chapiter" placeholder="Chapitre"></div>';

    $('.add_chapiter').on('click', function (e){
        e.preventDefault();

        if($(this).find('i').hasClass('fa-plus'))
        {
            $('.select-chapiter').find('div').fadeOut();
            $('.input-chapiter').append(chap).parent().fadeIn();
            $(this).find('i').removeClass();
            $(this).find('i').addClass('fa fa-minus');
        } else {
                $(this).find('i').removeClass();
                $(this).find('i').addClass('fa fa-plus');
                $('.input-chapiter').find('.chap').remove();
                
                $('.select-chapiter').find('div').fadeIn();
                $('#chapiter').val('');
            }
        
    });

    $('.select2-selection__rendered').on('click', function (){
        if ($('input').hasClass('select2-search__field')) {
            $('.select2-search').on('keyup','input', function() {
                var valeur = $('.select2-search').find('input').val();
                $.ajax({
                    url : "{{ route('api.chapiter') }}",
                    method : "GET",
                    data : {search: valeur},
                    success : function(data) {
                        var datas = JSON.parse(data);
                        $('#select2').find('option').remove();
                        datas.items.forEach(elem => {
                            $('#select2').append('<option value="'+elem.id+'">'+elem.name+'</option>');
                        });
                        // console.log(datas)
                    }
                })
            })
        }
    })
    

    function save_page () {
        $('#save-page').on('click', function(e){
            e.preventDefault();
            var datas = $('#form-page-store').serialize();
            // console.log(datas)
            // var action = $(document).find('#form-page-store').attr('action');
            $.ajax({
                url : "{{ route('api.page.store') }}",
                method: "POST",
                data : datas,
                success : function(resp) {
                    var response = {};
                    console.log(resp)
                    // response = JSON.parse(resp);
                    // console.log(response);

                    $('.modal').modal('hide');

                    if (! response.hasOwnProperty('message') )
                    {
                        return null;
                    }

                    if (response.message == 1)
                    {
                        
                    } else if (response.message == 'error') {
                    
                    }

                }
            });
            // console.log(JSON.parse(form));
        });
    }

    function getLitCapiter() {
        // console.log("{{ route('api.chapiter') }}")
        $.ajax({
            url : "{{ route('api.chapiter') }}",
            method : "GET",
            success : function(data) {
                var datas = JSON.parse(data);

                datas.items.forEach(elem => {
                    $('#select2').append('<option value="'+elem.id+'">'+elem.name+'</option>');
                });
                // console.log(datas)
            }
        })
    }
    // seach();
    
    $('.select2-search__field').on('keyup',function() {
            alert($(this).val())
        });
    function seach()
    {
        $('.select2-search__field').on('keyup',function() {
            alert($(this).val())
        });
    }
})
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