@extends('layouts.app')

@section('content')

	<div class="body">
		
		<h1>Evénnement</h1>


		<h2>{{ $event->title }}</h2>
		<div>{{ $event->description }}</div>

		<form method="POST" action="{{ route('events.destroy', $event->id) }}">
			{{ csrf_field() }}
			{{ method_field('DELETE') }}
			<button> supprimer </button>
		</form>
		<div>
			<a href="{{ route('events.edit', $event->id) }}">Modifier</a>
		</div>

	</div>

@stop