(function($){

    $.fn.selectNode = function() 
    {

    }
    
    $('#type').select2({
        selectMe : function(params) {
            alert(params)
        }
    });


})(jQuery);

jQuery(function() {

    $(document).on('click', '.search-page', function(event) {
        event.preventDefault();
    });

    // $('#count-search-page').fadeOut();

});

/**
*/
jQuery(function() {

    $(document).on('click', '#save-livre', (e) => {
        e.preventDefault()
        var datas = $('#form-livre-store').serialize();
        $.ajax({
            url: $('.livre.store-url').data('url')
        });
        // alert(datas);
    });

    //Date picker
    $('#livre_datepicker').datepicker({
        autoclose: true,
        todayBtn: true,
        today: true,
        format: 'dd-mm-yyyy'
    })

});


jQuery(function() {
    $('#chapiter').select2();
    save_page();
    getListBook();
    getLitCapiter();

    var chap = '<div class="form-group chap">'+
                    '<label for="chapiter">Nouveau Chapitre</label>'+
                    '<input type="text" name="chapiter" class="form-control" id="chapiter" placeholder="Chapitre">'+
                '</div>';

    $('.add_chapiter').on('click', function(e) {
        e.preventDefault();

        if ($(this).find('i').hasClass('fa-plus')) {
            $('.select-chapiter').hide();
            $('.input-chapiter').append(chap).parent().show();
            $(this).find('i').removeClass();
            $(this).find('i').addClass('fa fa-minus');
        } else {
            $(this).find('i').removeClass();
            $(this).find('i').addClass('fa fa-plus');
            $('.input-chapiter').find('.chap').remove();

            $('.select-chapiter').fadeIn();
            $('#chapiter').val('');
        }

    });
    // $('.select2-selection__rendered')

    function save_page() {
        $('#save-page').on('click', function(e) {
            e.preventDefault();
            var datas = $('#form-page-store').serialize();

            save_in_database(datas);

        });
    }

    function save_in_database(datas) {
            $.ajax({
                url: $('.page-store-url').data('url'),
                method: "POST",
                data: datas,
                success: function(resp) {
                    var response = {};
                    // console.log(resp)
                    $('#modal-default').modal('hide');

                    if (!response.hasOwnProperty('message')) {
                        return null;
                    }

                    if (response.message == 1) {
                        flashy("Enregistrer avec succès", '#', 'success');
                    } else if (response.message == 'error') {

                    }
                }
            });
    }

    function getListBook() {

        $.ajax({
            url : $('.livre-index-url').data('url'),
            method : 'GET',
            dataType : 'json',
            success : function (datas) {
                // var datas = JSON.parse(datas);

                datas.forEach(elem => {
                    // console.log(elem);
                    if ($('#input_hidden_book').val() == ""){
                        $('#input_hidden_book').val(JSON.stringify(elem));

                    }
                    $('#select-book').append('<option value= "'+elem.id+'">'+elem.name+'</option>');
                });
            }
        });
    }

    function getLitCapiter() {
        // $('#modal-default').on('show.bs.modal', function() {
        //     // Book id 
        //     var id = $('#input_hidden_id').val();

        //     if (id != 0)
        //     {
        //         $.ajax({
        //             url: $('.chapiter-url').data('url'),
        //             method: "GET",
        //             data : {book_id : id},
        //             dataType : 'json',
        //             success: function(datas) {

        //                 datas.items.forEach(elem => {
        //                     $('#chapiter').append('<option value="' + elem.id + '">' + elem.name + '</option>');
        //                 });
        //             }
        //         });
        //     }
            
        // });
    }

    $('.select2-search__field').on('keyup', function() {
        alert($(this).val())
    });

    function seach() {
        $('.select2-search__field').on('keyup', function() {
            // alert($(this).val())
        });
    }
});



jQuery(function(){

    var panier = $(this).panier();

    var i   = 1;

    $('.content-list').html("");

    put_field_for_new_page();

    function put_field_for_new_page() {
        $('.content-list').append(
            '<div class="col-md-7 list-'+i+'">'
            +'<div class="form-group">'
                +'<label for="content">Content</label>'
                +'<textarea  class="page-content form-control" id="content-'+i+'" name="page[content][]" placeholder="content"></textarea>'
            +'</div>'
            +'</div>'

            +'<div class="col-md-5 list-'+i+'">'
            +'<div class="form-group">'
                +'<label for="content">Content</label>'
                +'<textarea  class="page-code form-control" id="code-'+i+'" name="page[code][]" placeholder="code"></textarea>'
            +'</div>'
            +'</div>'
            +'<div class="col-md-12 delete-list-'+i+'">'
                +'<button class="btn btn-danger pull-right delete-list" data-indice="'+i+'"><i class="fa fa-minus"></i></button>'
            +'</div>'
            );
        panier.push(i)
        i++;

        if (panier.length() == 1) {
                $('.delete-list-'+panier.getCurrentValue()).addClass('hidden');
            }
        if (panier.length() > 1) {
            if ($('body').find('.hidden')) {
                $('body').find('.hidden').removeClass('hidden');   
            }
        }
            
    }

    $(document).on('click', ".add-new-page-field", function(e) {
        e.preventDefault();
        put_field_for_new_page();
    });

    $(document).on('click','.delete-list', function(e){
        e.preventDefault();
        var i= $(this).data('indice');
            $('.list-'+i).remove();
            $('.delete-list-'+i).remove();
            panier.splice(i); // supprimer un champ

            if (panier.length() == 1) { // ajout de la classe hidden
                $('.delete-list-'+panier.get(0)).addClass('hidden');
            } 

            
    });

});



jQuery(function(){

    /**
    * Permet de chercher un livre 
    * 
    */
    $(document).on("keyup", "#book-search", function(e){
        e.preventDefault();
        var search = $(this).val();
        $.ajax({
                url         : $('.book-url-where').data('url')
                ,method      : 'GET'
                ,dataType    : 'json'
                ,data        : {search : search}
                ,success     : function(datas) 
                {
                    $('.showing-book-list').find('p').remove();

                    datas.items.forEach(elem => {
                        $('.showing-book-list').append('<p data-id="'+elem.id+'" data-title="'+elem.name+'">'+elem.name+'</p>');
                    });
                }
            });
    });

    /**
    * 
    *  
    */
    $(document).on('change','#chapiter', function(e) 
    {
        e.preventDefault();
        var chapiter_id = $(this).val();
        // alert($(this).val());
         $.ajax({
            url         : $('.chapiter-url').val()+"/"+chapiter_id+"/chapiter"
            ,method     : "GET"
            ,dataType   : "json"
            ,success    : function (data) {
                var chapiter_name = data.item.name;
                var chapiter_id = data.item.id;
                $('#page_chapiter').html(chapiter_name);
            }
        })
    });

    /**
    * Permet de séléctioner une chapitre
    *
    */
    $(document).on('click','.showing-book-list>p', function(e) 
    {

        e.preventDefault();

        var id = $(this).data('id');
        var name = $(this).data('title');

        $.ajax({
            url         : $('.chapiter-url').val()+"/"+id
            , method    : "GET"
            ,dataType   : "json"
            ,success    : function (datas) {
                var id      = 0;
                var name    = "";
                if(datas.hasOwnProperty('count')) 
                {
                    if (datas['count'] >= 1) 
                    {
                        id      = datas.items[0].id;
                        name    = datas.items[0].name;
                        // console.log(datas.items[0]);
                        $('#chapiter').val(id)
                        $('#page_chapiter').html(name);
                    }else
                        {
                            $('#page_chapiter').html("");
                        }
                }

                $('#chapiter').find('option').remove();
                datas.items.forEach(elem => {
                    $('#chapiter').append('<option value="' + elem.id + '">' + elem.name + '</option>');
                });
            }
        })

        $('.showing-book-list').find('p').remove();
        $('#book-search').val(name);

        $('#book_title').html(name);
        $('#input_hidden_id').val(id);
        
    });

    $('#select2-chapiter-container').on('click', function() 
    {
        if ($('input').hasClass('select2-search__field')) 
        {
            $('.select2-search').on('keyup', 'input', function() 
            {
                var valeur  = $('.select2-search').find('input').val();
                var book    = JSON.parse($('#input_hidden_book').val());

                // $.ajax({
                //     url: $('.chapiter-url').val(),
                //     method: "GET",
                //     dataType: 'json',
                //     data: { search: valeur ,book_id : book.id},
                //     success: function(datas) {
                //                     console.log(datas)
                //         // var datas = JSON.parse(data);
                //         $('#chapiter').find('option').remove();
                //         datas.items.forEach(elem => {
                //             $('#chapiter').append('<option value="' + elem.id + '">' + elem.name + '</option>');
                //         });
                //     }
                // });
            });
        }
    });

    /********************************************/

    var i = 0;
    var p = $(this).panier();
    /**
    *   Permet de créer un nouveau titre
    *
    */
    $(document).on('keyup', "#title", function(e) 
    {
        e.preventDefault();
        var title = $(this).val();
        var choice = $('.shoice').text();

        if (i == 0) 
        {
           p.push(choice);
        }

        i++;

        $('#page_title').html(title);

        if (title.length == 0) 
        {
            
            $('.shoice').html(p.get(0))
        }else{
                $('.shoice').html(" "+title)
            }
    });
    /**
    *  Permet de créer un nouveau chapitre
    *   
    */
    $(document).on('keyup', "#chapiter", function(e) 
    {
        e.preventDefault();
        var val = $(this).val();
        $('#page_chapiter').html(val);
    });
    /**
    *   Permet de passé à la modal suivante
    * 
    */
    $(document).on('click', ".suivant-to-write-page", function(e) {
        e.preventDefault();

        $('#book-modal').modal('hide');
        $('#modal-default').modal('show');
    });
    /*
    *   Permet de passé à la page précedante
    *
    */
    $(document).on('click','.preview-to-write-page', function(e){
        e.preventDefault();
        $('#modal-default').modal('hide');
        $('#book-modal').modal('show');

        $('#book-modal').on('hidden.bs.modal', function(){
            $('#modal-default').modal('show');
        });
    });

});



/**
*
*   ############ LES SELECT 2 : section de livre et de chapitre
*/

jQuery(function(){
    $('.livre-slct2').select2();

     $('#select2-select-book-container').on('click', function() {

         if ($(this).find('.select2-search__field'))
            {
                $('.select2-search').on('keyup','input', function(){
                    // alert(this)
                   
                });
            }
     });



});
