jQuery(function() {

    $(document).on('click', '.search-page', function(event) {
        event.preventDefault();
    });

    $(document).on('keyup', '#search-page', function() {

        var arg = $(this).val();

        if (arg.length > 0) {
            $.ajax({
                url: $('.page-list-url').data('url'),
                method: "GET",
                data: { argument: arg },
                success: function(response) {
                    $('.showing-page-list').find('div').remove();

                    response.forEach((elem) => {
                        var titre = elem.title;
                        var content = elem.content;
                        $('.showing-page-list').append('<div class="search-div">' + titre + ' ' + content + '</div>');

                    });
                }
            });
        } else {
            $('.showing-page-list').find('div').remove();
        }


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
    $('.select2').select2();
    save_page();
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

    $('.select2-selection__rendered').on('click', function() {
        if ($('input').hasClass('select2-search__field')) {
            $('.select2-search').on('keyup', 'input', function() {
                var valeur = $('.select2-search').find('input').val();
                $.ajax({
                    url: $('.chapiter-url').val(),
                    method: "GET",
                    data: { search: valeur },
                    success: function(data) {
                        var datas = JSON.parse(data);
                        $('#select2').find('option').remove();
                        datas.items.forEach(elem => {
                            $('#select2').append('<option value="' + elem.id + '">' + elem.name + '</option>');
                        });
                    }
                })
            })
        }
    })


    function save_page() {
        $('#save-page').on('click', function(e) {
            e.preventDefault();
            var datas = $('#form-page-store').serialize();
            $.ajax({
                url: $('.page-store-url').data('url'),
                method: "POST",
                data: datas,
                success: function(resp) {
                    var response = {};

                    $('.modal').modal('hide');

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

    function getLitCapiter() {
        $.ajax({
            url: $('.chapiter-url').data('url'),
            method: "GET",
            success: function(data) {
                var datas = JSON.parse(data);

                datas.items.forEach(elem => {
                    $('#select2').append('<option value="' + elem.id + '">' + elem.name + '</option>');
                });
            }
        })
    }


    $('.select2-search__field').on('keyup', function() {
        alert($(this).val())
    });

    function seach() {
        $('.select2-search__field').on('keyup', function() {
            alert($(this).val())
        });
    }
});