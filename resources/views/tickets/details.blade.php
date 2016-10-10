@extends('layout')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h2 class="title-show">
                {{ $ticket->title }}
                {{--{{$ticket->getRouteKey()}}
                {{$ticket->id}}--}}
                @include('tickets/partials/status',  compact('ticket'))
            </h2>
            @if ($ticket->link)
                <p>
                  <a href="{{ $ticket->link }}" target="_blank" class="btn btn-info">Ver recurso</a>
                </p>  
            @endif         
            @if (Session::has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>                        
            @endif


            <p class="date-t">
                <span class="glyphicon glyphicon-time"></span>{{$ticket->created_at->format('d/m/y h:ia')}} - {{ $ticket->author->name}}
            </p>
             
            <h4 class="label label-info news">{{count($ticket->voters)}} Votos</h4>
            <p class="vote-users">
            @foreach ($ticket->voters as $user)
                <span class="label label-info">{{$user->name}}</span>
            @endforeach
            </p>
            @if( ! currentUser()->hasVoted($ticket))
            {!!Form::open(['route' => ['vote.submit', $ticket->id], 'method' => 'POST'])!!}

                 <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-thumbs-up"></span> Votar
                </button>
            {!!Form::Close()!!}
            @else
            {!!Form::open(['route' => ['vote.destroy', $ticket->id], 'method' => 'DELETE'])!!}
                 <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-thumbs-up"></span> Quitar Voto
                </button>
            {!!Form::Close()!!}
            @endif
            <h3>Nuevo Comentario</h3>
            @include('partials/error')
            {!!Form::open(['route' => ['comment.create', $ticket->id], 'method' => 'POST'])!!}
                    <div class="from-group">
                                {!! Form::label('title', 'Comentario')!!}
                                {!! Form::textarea('comment', null, [
                                    'row'   => 2,
                                    'class' => 'form-control',
                                ]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('link', 'Link')!!}
                        <input class="form-control" name="link" type="text" id="link">
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar comentario</button>
            {!!Form::Close()!!}         
            <h3>Comentarios {{ count($ticket->comments)}}</h3>
            @foreach ($ticket->comments as $comment)
                <div class="well well-sm">
                    <p>{{ $comment->user->name }}</p>
                    <p><strong>{{ $comment->comment }}</strong></p>
                    @if ($comment->link)
                        <p>
                            <a href="{{ $comment->link}}" rel="nofollow" target="_blank">
                                {{ $comment->link }}
                            </a>
                        </p>
                        @can('selectResource', $ticket)
                           {!!Form::open(['route' => ['tickets.finish', $ticket->getRouteKey(), $comment->id], 'method' => 'POST'])!!}
                             <button type="submit" class="btn btn-primary" name="comment-{{$comment->id}}">
                                Seleccionar Tutorial
                            </button>
                        {!!Form::Close()!!} 
                        @endcan
                    @endif
                    <p class="date-t"><span class="glyphicon glyphicon-time"></span>{{ $comment->created_at->format('d/m/Y h:ia')}}</p>
                </div>
             @endforeach
        </div>
    </div>
</div>
@endsection
