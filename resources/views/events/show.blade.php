@extends('layouts.app')

@section('content')

	<div class="body">
		
		<h1>Evénnement #{{ $event->id }}</h1>


		<h2>{{ $event->title }}</h2>
		<div>{{ $event->description }}</div>

		<a href="{{ route('events.edit', $event->id) }}" class="btn btn-success"> Modifier</a> <span ></span>

		<a href="{{ route('events.destroy', $event->id) }}" class="btn btn-danger" data-method="DELETE" data-confirm="Etes-vous sûr ?" >Supprimer </a>
	

	</div>

<style>
	span {
		display: inline-block;
		border-left:1px solid #000;
		height:40px;
		margin:0 5px;
		margin-bottom:-15px;
	}
</style>
@stop

@section('javascript')
	<script>

	</script>
@stop