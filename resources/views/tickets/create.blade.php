@extends('layout')
@section('content')
		<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
					@include('partials/error')
						<h1>Nueva Solicitud</h1>
						{!! Form::open(['route' => 'tickets.store', 'method' => 'POST']) !!}
							
							<div class="from-group">
								{!! Form::label('title', 'Titulo')!!}
								{!! Form::textarea('title', null, [
									'row' 	=> 2,
									'class' => 'form-control',
									'placeholder'  	=>	'Describe la Solicitud',
								]) !!}
								{!! Form::label('link', 'Enlace')!!}
								{!! Form::text('link', null, [
									'class' => 'form-control',
									'placeholder' => 'Comparte un tutorial colocando la URL'
								]) !!}
							</div>
							<br>
							<p>
								<button type="submit" class="btn btn-primary">
									Enviar Solicitudes
								</button>
							</p>
						{!! Form::close() !!}
					</div>	
				</div>	
		</div>
@endsection