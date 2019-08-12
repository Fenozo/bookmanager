@extends('layouts.app')

@section('content')

	<div class="body">
		
		<h1>{{ $events->count() }} {{ str_plural('Evennement', $events->count()) }}</h1>

		@if ($events->count() > 0)
			@foreach($events as $event)
			<article>
				<a href="{!! route('events.show', ['id' => $event->id]) !!} "><h2>{{ $event->title }}</h2></a>
				
				<div>{{ $event->created_at->format('d/m/Y H:m') }}</div>
				<p>{{ $event->description }}</p>
				
			</article>
			@endforeach
		@else
		<p>Pas d'événnement pour le moment</p>
		@endif 
		
	</div>



@stop