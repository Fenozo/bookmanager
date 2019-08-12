@extends('layouts.app')

@section('content')



<h1>Evénnement</h1>

	<div class="row">
	
			<div class="col-md-12">
				<div class="flex-center position-ref ">
					<form action="{{ route('events.store') }}" method="POST">
					{{ csrf_field() }}
					<div class="form-group">
						<input class="form-control" type="text" name="title">
					</div>
					{!! $errors->first('title', '<p class="error">:message</p>') !!}
					<div class="form-group">
						<textarea name="description" class="form-control"></textarea>
					</div>
					{!! $errors->first('description', '<p class="error">:message</p>') !!}

					<button class="btn btn-success"> Enregistrer</button>
					</form>
				</div>
			</div>
			<div class="col-md-12">
				<a style="left:48.5%;top:22px; position: absolute;" href="{{ route('root_web') }}">Annulé</a>
			</div>
		

	</div>



@stop