(function($){
	var options ={
		message : 'Déposez vos fichiers ici'
		,script : '../app/Helpers/upload.php'
		,token : ''
	}
	$.fn.dropfile = function(oo){
		if(oo) $.extend(options, oo);

		this.each(function(){
			$('<span>').addClass('instructions').append(options.message).appendTo(this);

			$(this).bind({
				dragenter: function(e) {
					e.preventDefault();
					// console.log('dragenter');
				},
				dragover: function(e) {
					e.preventDefault();
					$(this).addClass('hover');
					// console.log('dragover');
				},
				dragleave: function(e) {
					e.preventDefault();
					$(this).removeClass('hover');

					// console.log('dragleave');
				}
			});
			this.addEventListener('drop', function(e){
				e.preventDefault();
				var files = e.dataTransfer.files;
				// console.log(files);
				upload(files, $(this), 0);
			}, false);
		});


		function upload(files, area, index) {
			var file = files[index];
			console.log(file);
			console.log(file.type);
			console.log(file.name);
			var xhr = new XMLHttpRequest();

			// Evenements
			xhr.addEventListener('load', function(e){
				var json = jQuery.parseJSON(e.target.responseText);
				area.removeClass('hover')
				if (json.error) {
					alert(json.error);
					return false;
				} 
				console.log(json);
				// area.append(json.content);
			});


			xhr.open('post', options.script, true);
			// xhr.setRequestHeader("Content-Type", "application/x-www-formurlencoded");
			// xhr.setRequestHeader('content-type','multipart/form-data');
			xhr.setRequestHeader('x-file-type',file.type);
			xhr.setRequestHeader('x-file-size',file.size);
			xhr.setRequestHeader('x-file-name',file.name);
			xhr.setRequestHeader('x-file-token',options.token);
			xhr.setRequestHeader('X-CSRF-TOKEN',options.token);
			// xhr.setRequestHeader('token',options.token);
				// console.log(options.script)
			var form = new FormData();
			form.append('file', file);
			form.append('test','je suis un test');
			form.append('_token', options.token);
			
			xhr.send(form);

		}
	}

})(jQuery);