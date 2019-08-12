@extends('layouts.app')

@section('content')

	<div class="body">
		
		<h1>Evénnement</h1>


		<h2>{{ $event->title }}</h2>
		<div>{{ $event->description }}</div>
		<form method="GET" action="{{ route('events.edit', $event->id) }}">
			<button class="btn btn-success"> Modifier </button>
		</form>
		<form method="POST" action="{{ route('events.destroy', $event->id) }}">

			<a>
				{{ csrf_field() }}
				{{ method_field('DELETE') }}
				<button class="btn btn-danger"> supprimer </button>
			</a>
		</form>


		

	</div>

@stop