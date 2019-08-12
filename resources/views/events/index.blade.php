@extends('layouts.app')

@section('content')

	<div class="row">
		
		<div class="col-md-12">
			<div class="div-center">
				<h1>{{ $events->count() }} {{ str_plural('Evennement', $events->count()) }}</h1>

				@if ($events->count() > 0)

					@foreach($events as $event)

					<article>
						<a href="{!! route('events.show', ['id' => $event->id]) !!} "><h2>{{ $event->title }}</h2></a>
						
						<div class="box-center">{{ $event->created_at->format('d/m/Y H:m') }}</div>
						<p>{{ $event->description }}</p>
						
					</article>
					@endforeach
					<div class="box-center">
						{{ $events->links() }}
					</div>

				@else
				<p style="display: inline-block;margin:0 auto;min-width: 449px;">Pas d'événnement pour le moment</p>
				@endif 
			</div>
		</div>
		
	</div>



@stop