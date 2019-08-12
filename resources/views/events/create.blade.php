@extends('layouts.app')

@section('content')



<h1>Evénnement</h1>

	<div class="row">
	
			<div class="col-md-12">
				<div class="flex-center position-ref ">
					<form action="{{ route('events.store') }}" method="POST">
					{{ csrf_field() }}
					@include('events/_form', ['submitButtomText'=> "Créer un événement"])

					
					</form>
				</div>
			</div>
			<div class="col-md-12">
				<a style="left:48.5%;top:22px; position: absolute;" href="{{ route('root_web') }}">Annulé</a>
			</div>
		

	</div>



@stop