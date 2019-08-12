@extends('layouts.app')

@section('content')

	<div class="body">
		
		<h1>Evénnement</h1>


		<h2>{{ $event->title }}</h2>
		<div>{{ $event->description }}</div>


	</div>

@stop