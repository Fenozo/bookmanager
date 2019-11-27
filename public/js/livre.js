

jQuery(function() {

    // var url = $('#livre-url').data('url');

    // alert(url)
    $(document).on('click', '#livre-save', function(event) {
        event.preventDefault();
        var livre = $('#form-livre-store').serialize();

        $.ajax({
            url: $('#livre-url').data('url'),
            method: "POST",
            dataType: 'json',
            data: livre,
            success: function(response) {
                console.log(response);
                if (response.notify == 1)
                {
                    flashy(response.message, response.link, response.type);
                    $('#booklist').load($('#booklist').data('url'));
                }
                $('.modal').modal('hide');

            }
        });
    });
});

jQuery(function() {

    $.ajax({

        url : $('.livre-index-url').data('url'),

        method : 'GET',

        dataType : 'json',

        success : function (data) {
            // var datas = JSON.parse(data);
            datas.items.forEach(elem => {

                $('#select-book').append('<option>'+elem.name+'</option>');
            });
        }

    });

});

jQuery(function() {


/**
* Faire une ajout d'une vouvelle livre
*
*/
$(document).on('click', '.nouveau-article', function(e) {
    e.preventDefault();
    var h4 = '<h4 class="modal-title text-shadow">Nouveau <strong class="">Livre</strong></h4>';
    $('.livre.modal-header').find('.modal-title').remove();
    $('.livre.modal-header').append(h4);

    $('#book_id').val('');
    $('#name').val('');
    $('#author').val('');
    $('#description').val('');
    $('#date_publication').val('');
    $('.modal-footer').find('#livre-update').remove();
    $('.modal-footer').find('#livre-save').remove();
    $('.modal-footer').append('<button type="submit" class="btn btn-primary" id="livre-save">Enregistrer</button>');
    

});

/**
* Faire une édite du champ livre
*
*/
$(document).on('click', 'a.edit', function(a){
    a.preventDefault()
    // console.log($(this).data('id'))
    // console.log($(this).data('name'))
    // console.log($(this).data('author'))
    // console.log($(this).data('description'))
    // console.log($(this).data('publication'))
    var publication = $(this).data('publication');
    var array_publication = publication.split(' ');
    var array_date = array_publication[0].split('-');
    var year    = array_date[0];
    var month   = array_date[1];
    var day     = array_date[2];


    var h4 = '<h4 class="modal-title text-shadow bookupdate">Modification <strong class="">Livre</strong></h4>';
    $('.livre.modal-header').find('.modal-title').remove();
    $('.livre.modal-header').append(h4);

    $('#modal-livre').modal('show');

    $('#book_id').val($(this).attr('href'));
    $('#name').val($(this).data('name'));
    $('#author').val($(this).data('author'));
    $('#description').val($(this).data('description'));
    $('#date_publication').val(day+'-'+month+'-'+year);

    $('.modal-footer').find('#livre-save').remove();
    $('.modal-footer').find('#livre-update').remove();
    $('.modal-footer').append('<button type="submit" class="btn btn-success" id="livre-update">Modifier</button>');
    
});

$(document).on('click','#livre-update', function(e){
    e.preventDefault();
    // console.log($('#form-livre-store').serialize())

    var datas = $('#form-livre-store').serialize();

    $.ajax({
        url : $('#livre-url-update').data('url'),
        method : 'POST',
        dataType : 'json',
        data : datas,
        success : function(response) {
            // console.log(response)
            // if ($('.page-item').attr('aria-current') == 'page') {
            //     var  page = $('.page-item').find('.page-link').html();
            //     alert(page)
            // }
            flashy("Enregistrer avec succès", '#', 'success');
            var numberCurrentPage = $('.active').find('span').html();
            $('#booklist').load($('#booklist').data('url')+'?livrepage='+numberCurrentPage);
                
            $('#modal-livre').modal('hide');
        }
    })

});


});



