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
})