
	<div class="form-group">
		<input class="form-control" type="text" name="title" value="{{ old('title') ??  $event->title }}">
	</div>

	{!! $errors->first('title', '<p class="error">:message</p>') !!}

	<div class="form-group">
		<textarea name="description" class="form-control">{{ old('description') ?? $event->description }}</textarea>
	</div>

	{!! $errors->first('description', '<p class="error">:message</p>') !!}
	