@extends('layout')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="row">
                <h1>
                    {{--trans se utiliza para llamar mutiples titulo segun el resultado--}}
                    {{$title}}
                    <a href="{{ route('tickets.create')}}" class="btn btn-primary">
                        Nueva solicitud                    
                    </a>
                </h1>

                <p class="label label-info news">
                {{--lang::choice se utiliza para llamar opciones donde puede haber multiples resultados en cada uno de los esenarios--}}
                    {{$text_total}}
                    {{-- Base Lang::choice(Route::currentRouteName(). '_total', $tickets->total())--}}
                </p>
                @foreach($tickets as $ticket)
                    @include('tickets/partials/item', compact('ticket'))
                @endforeach
               <div style="text-align: center;">
                 {!! $tickets->render()!!}
               </div>
            </div>

            <hr>

            <p><a href="http://duilio.me" target="_blank">Cuncode</a></p>

        </div>
    </div>
</div>

{!! Form::open(['id' => 'form-vote', 'route' => ['vote.submit', ':id'], 'method' => 'POST'])!!}
{!! Form::close() !!}

{!! Form::open(['id' => 'form-unvote', 'route' => ['vote.destroy', ':id'], 'method' => 'DELETE'])!!}
{!! Form::close() !!}

@endsection