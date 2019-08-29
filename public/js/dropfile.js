(function($){
	var options ={
		message : 'Déposez vos fichiers ici'
		,script : '../app/Helpers/upload.php'
		,token : ''
		,clone : true
	}
	$.fn.dropfile = function(oo){

		var replace = false;

		if(oo) $.extend(options, oo);

		this.each(function()
		{
			$('<span>').addClass('instructions').append(options.message).appendTo(this);
			
			$(this).bind(
			{
				dragenter: function(e) 
				{
					e.preventDefault();
				},
				dragover: function(e) 
				{
					e.preventDefault();
					$(this).addClass('hover');
				},
				dragleave: function(e) 
				{
					e.preventDefault();
					$(this).removeClass('hover');
				}
			});

			this.addEventListener('drop', function(e)
			{

				e.preventDefault();

				var files = e.dataTransfer.files;
				
				if($(this).data('value') != null)
				{
					replace = true;
				}
				if (replace === true && files.length-1 == 0)
				{
					upload(files, $(this), 0);

				}else if(replace === false)
					{
						upload(files, $(this), 0);

					}else{
							$(this).removeClass('hover');
							alert('Trop de fichiers');
						}

			}, false);
		});

		/**
		* Upload files
		*
		* @param files
		* @param area
		* @param index
		*/
		function upload(files, area, index) 
		{
			var file = files[index];
			
			if (index>0 && options.clone)
			{
				area = area.html("").clone().insertAfter(area).dropfile(options);
				area.data('value', null);
			}

			var xhr = new XMLHttpRequest();

			$('<span>').addClass('progress').css({height:"0%"}).appendTo(area);
			var progress = area.find('.progress'); // recupère l'élément de la progesse upload

			// Evenements
			xhr.addEventListener('load', function(e) {

				var json = jQuery.parseJSON(e.target.responseText);

				if ($(area).data('value') != null)
					{
						options.clone = false;
					}

				area.attr('data-value',json.name);
				area.removeClass('hover');

				// Une erreur a été vue
				if (json.error) {
					return false;
				}

				progress.css({height:"0%"});

				if(index < files.length-1)
				{
					upload(files, area, index+1);
				}

				if ( options.clone === true && !replace && index == files.length-1 && json.hasOwnProperty('content'))
				{
					area.html("").clone().insertAfter(area).dropfile(options).removeAttr('data-value');
				}

				area.data('value', json.name);	
				area.html(json.content);

			}, false);
			xhr.upload.addEventListener('progress', function(e) 
			{
				if (e.lengthComputable) 
				{
					var perc = (Math.round(e.loaded/ e.total) *100) +"%";
					progress.css({height: perc}).html(perc);
				}
			}, false);

			xhr.open('post', options.script, true);
			// xhr.setRequestHeader("Content-Type", "application/x-www-formurlencoded");
			// xhr.setRequestHeader('content-type','multipart/form-data');
			xhr.setRequestHeader('x-file-type',file.type);
			xhr.setRequestHeader('x-file-size',file.size);
			xhr.setRequestHeader('x-file-name',file.name);
			xhr.setRequestHeader('X-CSRF-TOKEN',options.token);

			if (area.data('value'))
			{
				xhr.setRequestHeader('x-file-value', area.data('value'))
			}
			
			var form = new FormData();

			form.append('file', file);
			form.append('_token', options.token);
			if(area.data('value'))
			{
				form.append('x-file-value',area.data('value'));
				console.log(area.data('value'))
			}
			

			if(file.type !="") 
			{
				options.clone = true;

				for(var i in area.data()) 
				{
					if (typeof area.data(i) !== 'object')
					{
						options.clone = false;
						// xhr.setRequestHeader('x-file-'+i, area.data(i))
					}
				}

				xhr.send(form);
			} else {
					alert('type de fichier inconu');
				}
			
		}

		return this;
	}

})(jQuery);