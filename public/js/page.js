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
                    '<label for="chapiter">Chapitre</label>'+
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
        $('#modal-default').on('show.bs.modal', function() {
            // Book id 
            var id = $('#input_hidden_id').val();

            if (id != 0)
            {
                $.ajax({
                    url: $('.chapiter-url').data('url'),
                    method: "GET",
                    data : {book_id : id},
                    dataType : 'json',
                    success: function(datas) {

                        datas.items.forEach(elem => {
                            $('#chapiter').append('<option value="' + elem.id + '">' + elem.name + '</option>');
                        });
                    }
                });
            }
            
        });

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
    $('.livre-slct2').select2();

     $('#select2-select-book-container').on('click', function() {

         if ($(this).find('.select2-search__field'))
            {
                $('.select2-search').on('keyup','input', function(){
                    // alert(this)
                   
                });
            }
     });

    $('#select2-chapiter-container').on('click', function() {
        if ($('input').hasClass('select2-search__field')) {
            $('.select2-search').on('keyup', 'input', function() {
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

});

jQuery(function() {

    $(document).on('click', ".suivant-to-write-page", function(e) {
        e.preventDefault();

        $('#book-modal').modal('hide');
    });
    $('.book-modal').modal('hide');
    $(document).on('click','.select_one_book', function(e){
        e.preventDefault();
        $('#modal-default').modal('hide');
        $('#book-modal').modal('show');

        $('#book-modal').on('hidden.bs.modal', function(){
            $('#modal-default').modal('show');
        });
        
        $(document).on('keyup', '#book-search', function() {
             var search = $(this).val();
                    // console.log(valeur);

                        $.ajax({
                            url         : $('.book-url-where').data('url'),
                            method      : 'GET',
                            dataType    : 'json',
                            data        : {search : search},
                            success     : function(datas) 
                            {
                                // alert(search)
                                // console.log(datas);

                                $('.showing-book-list').find('p').remove();
                                datas.items.forEach(elem => {
                                    $('.showing-book-list').append('<p data-id="'+elem.id+'" data-title="'+elem.name+'">'+elem.name+'</p>');
                                });
                            }
                        });
        });

        $(document).on('click','.showing-book-list>p', function() {

            var id = $(this).data('id');
            var name = $(this).data('title');

            $('.showing-book-list').find('p').remove();
            $('#book-search').val(name);
    
            $('#book_title').html(name);
            $('#input_hidden_id').val(id);
            
        });


    });
});