jQuery(function() {

    $(document).on('click', '.search-page', function(event) {
        event.preventDefault();
    });

    // $('#count-search-page').fadeOut();

    $(document).on('keyup', '#search-page', function() {

        var arg = $(this).val();


        $.ajax({
            url: $('.page-list-url').data('url'),
            method: "GET",
            data: { argument: arg },
            success: function(response) {
                $('.showing-page-list').find('div').remove();
                if (arg.length == 0) {
                    $('#count-search-page').html(0);
                } else {
                    $('#count-search-page').html(response.count);
                }

                if (response.hasOwnProperty('list') && response.list.length > 0) {
                    // parcours des élements trouvé
                    response.list.forEach((elem) => {
                        var text = elem;
                        if (arg.length > 1) {
                            $('.showing-page-list').append('<div class="search-div"> ' + text + '</div>');
                        } else {
                            $('.showing-page-list').find('div').remove();
                        }

                    });
                }
            }
        });


    });
});

jQuery(function() {

    $(document).on('click', '#save-livre', (e) => {
        e.preventDefault()
        var datas = $('#form-livre-store').serialize();
        $.ajax({
            url: $('.livre.store-url').data('url')
        });
        alert(datas);
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

    var chap = '<div class="form-group chap"><label for="chapiter">Chapitre</label><input type="text" name="chapiter" class="form-control" id="chapiter" placeholder="Chapitre"></div>';

    $('.add_chapiter').on('click', function(e) {
        e.preventDefault();

        if ($(this).find('i').hasClass('fa-plus')) {
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
    // $('.select2-selection__rendered')



    function save_page() {
        $('#save-page').on('click', function(e) {
            e.preventDefault();
            var datas = $('#form-page-store').serialize();

            console.log(datas)
            $.ajax({
                url: $('.page-store-url').data('url'),
                method: "POST",
                data: datas,
                success: function(resp) {
                    var response = {};
                    console.log(resp)
                    $('#modal-default').modal('hide');

                    if (!response.hasOwnProperty('message')) {
                        return null;
                    }

                    if (response.message == 1) {

                    } else if (response.message == 'error') {

                    }

                }
            });

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
                var valeur = $('.select2-search').find('input').val();
                var book = JSON.parse($('#input_hidden_book').val());

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
            })
        }
    });

});

jQuery(function() {
    $('.book-modal').modal('hide');
    $(document).on('click','.select_one_book', function(e){
        e.preventDefault();
        $('#modal-default').modal('hide');
        $('#book-modal').modal('show');

        $('#book-modal').on('hidden.bs.modal', function(){
            $('#modal-default').modal('show');
        });
        
        $(document).on('keyup', '#book-search', function() {
             valeur = $(this).val();
                    console.log(valeur);
                        $.ajax({
                            url : $('.book-url-where').data('url'),
                            method : 'GET',
                            dataType : 'json',
                            data : {search : valeur},
                            success : function(datas) 
                            {
                                console.log(datas);

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
                $('#book_title').html(name);
                $('#input_hidden_id').val(id);
                $('#book-modal').modal('hide');
            });
        // $('.modal').modal('hide');
        // $('.book-modal').modal('show');
        // $('.book-modal').css({"position":"absolute", "top":"0","z-index":"30000"})

    });
});