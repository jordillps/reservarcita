@extends('layouts.layout')


@section('content')

    <div class="card card-elegant">
        <img class="card-img-top" src="/img/card.jpg" width="100%" alt="Card image cap">
        <div class="card-block">
            <div class="row">
                <div class="col-md-6">
                    <div class="alert alert-success" role="alert">
                        <strong>Nom: </strong> {{$reservation->name}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="alert alert-success" role="alert">
                        <strong>Email: </strong> {{$reservation->email}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="alert alert-success" role="alert">
                        <strong>Telèfon: </strong> {{$reservation->phone}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="alert alert-success" role="alert">
                        <strong>Data: </strong> {{$reservation->reservation_date->format('d-m-Y')}}
                    </div>
                </div>
            </div>

            <h6 class="card-title"><small>Hores disponibles</small></h6>
            <form name="reservationForm" id="reservationForm" action="{{route('reservation.update', $reservation)}}" method="POST" autocomplete="off">
                {{ csrf_field() }}
                {{ method_field('PUT')}}
                <div class="form-row">
                    <div class="form-group col-md-12 input__button" {{ $errors->has('slot')? 'has error': ''}}>
                            @foreach($slots as $slot)
                                @if(in_array($slot, $slotsunavaliable))
                                    <label class="btn btn-danger unavailable">
                                        <input type="radio" name="slot" id="option" value="{{$slot}}" disabled>{{$slot}}
                                    </label>

                                @else
                                    <label class="btn btn-success">
                                        <input type="radio" name="slot" id="option" value="{{$slot}}">{{$slot}}
                                    </label>

                                @endif
                            @endforeach
                            {!! $errors->first('slot', '<span class="help-block" style="color:red;">:message</span>')!!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" name="accept_politics" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            Accepto la política de privacitat
                        </label>
                    </div>
                    {!! $errors->first('accept_politics', '<span class="help-block" style="color:red;">:message</span>')!!}
                </div>
                <button type="submit" class="btn btn-primary">Reservar</button>
            </form>
        </div>
    </div>

@endsection



