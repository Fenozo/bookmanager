(function($){
	var options = {
		url : $(this).data('url')
		,autocomplate : "script"
		,score_count : "count-search-page"
	}

	$.fn.script = function(o) {

		if(o != undefined) {
			$.extend(options, o)
		}

		$(this).on('keyup', function(){



			var search = $(this).val();
			var parent = $(this).parent();
			$(parent).parent().append("<div id=\""+options.autocomplate+"\" class=\"showing-page-list\"></div>");
			var list_div = $(parent).parent().find('div');
			$.ajax({
				url : $(this).data('url'),
				method : "GET",
				dataType : "json",
				data: { argument: search },
				success : function (response) {
					// alert(response)

					// console.log(rand(1,5,10000));
						
				
					$('#script').find('div').remove();
	                
	                if (search.length == 0) {
	                    $('#'+options.score_count).html(0);
	                } else {
	                    $('#'+options.score_count).html(response.count);
	                }

	                if (response.hasOwnProperty('list') && response.list.length > 0) {
	                    // parcours des élements trouvé
	                    response.list.forEach((elem) => {
	                        // var item = JSON.stringify(elem);
	                        var text = elem.text;
	                        var id = elem.id;
	                        var title = elem.title
	                        var content = elem.content

	                        var pattern = new RegExp(search,"gi");
	                        var subject = text;

	                            // console.log(search)
	                        // var text = subject.replace(pattern,"<strong>"+search+"</strong>");

	                        if (search.length > 1) {
	                        	
	                            $('#'+options.autocomplate).append('<div  data-id="'+id+'" data-title="'+title+'" data-content="'+content+'" class="search-div"> ' + text + '</div>');
	                        } else {

	                            $('#'+options.autocomplate).find('div').remove();
	                        }

	                    });
	                }
				} 
			});
		});
	}

	function rand(min, max, integer) {
		if (!integer) {
			return Math.random() * (max - min) + min;
		}else{
				return Math.floor(Math.random() * (max - min + 1) + min);
			}
	}

	

})(jQuery);
