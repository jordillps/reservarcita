@extends('layouts.layout')


@section('content')

    <div class="card card-elegant">
        <img class="card-img-top" src="/img/card.jpg" width="100%" alt="Card image cap">
        <div class="card-block">
            <h6 class="card-title"><small>Reserva Confirmada</small></h6>
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
            <div class="row">
                <div class="col-md-6">
                    <div class="alert alert-success" role="alert">
                        <strong>Hora: </strong> {{$reservation->slot}}
                    </div>
                </div>
            </div>
            @if(session()->has('flash'))
                    <div class="alert alert-success">{{session('flash')}}</div>
            @endif
        </div>
    </div>

@endsection


