@extends('layouts.app')

@section('content')



<h1>Evénnement</h1>

	<div class="row">
	
			<div class="col-md-12">
				<div class="flex-center position-ref ">
					<form action="{{ route('events.update', $event->id) }}" method="POST">
					{{ csrf_field() }}

					{{-- 
						<!-- <input type="hidden" name="_method" value="PUT"> -->
					 --}}
						{{ method_field('PUT') }}
					 

						@include('events/_form')



					<button class="btn btn-success"> Modifier </button>
					</form>
				</div>
			</div>
			<div class="col-md-12">
				<a style="left:48.5%;top:22px; position: absolute;" href="{{ route('root_web') }}">Annulé</a>
			</div>
		

	</div>



@stop