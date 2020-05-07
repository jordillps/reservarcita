@extends('layouts.layout')

@push('styles')
    <!-- daterange picker -->
    <link rel="stylesheet" href="/datepicker/datepicker.min.css">
@endpush


@section('content')

    <div class="card card-elegant">
        <img class="card-img-top" src="/img/card.jpg" width="100%" alt="Card image cap">
        <div class="card-block">
            <h5 class="card-title">Reserva de cita prèvia</h5>
            <form name="reservationForm" id="reservationForm" action="{{route('reservation.store')}}" method="POST" autocomplete="off">
                {{ csrf_field() }}
                <div class="form-row">
                    <div class="form-group col-md-6" {{ $errors->has('name')? 'has error': ''}}>
                        <label for="inputName">Nom*</label>
                        <input name="name" type="text" class="form-control" id="inputName" value="{{old('name')}}">
                        {!! $errors->first('name', '<span class="help-block" style="color:red;">:message</span>')!!}
                    </div>
                    <div class="form-group col-md-6" {{ $errors->has('email')? 'has error': ''}}>
                        <label for="inputEmail">Correu electrònic*</label>
                        <input  name="email" type="email" class="form-control" id="inputEmail" value="{{old('email')}}">
                        {!! $errors->first('email', '<span class="help-block" style="color:red;">:message</span>')!!}
                    </div>
                </div>
                <div class="form-row" {{ $errors->has('phone')? 'has error': ''}}>
                    <div class="form-group col-md-6">
                        <label for="inputPhone">Telèfon*</label>
                        <input name="phone" type="text" class="form-control" id="inputPhone" value="{{old('phone')}}">
                        {!! $errors->first('phone', '<span class="help-block" style="color:red;">:message</span>')!!}
                    </div>
                    <div class="form-group col-md-6" {{ $errors->has('reservation_date')? 'has error': ''}}>
                        <label for="reservation_date">Data*</label>
                        <input name="reservation_date" type="text" class="form-control" id="reservation_date" value="{{old('reservation_date')}}">
                        {!! $errors->first('reservation_date', '<span class="help-block" style="color:red;">:message</span>')!!}
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Següent</button>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
<!-- date-range-picker -->
    <script src="/js/app.js"></script>
    <script src="/datepicker/datepicker.min.js"></script>
    <script src="/datepicker/datepicker.es.min.js"></script>

    <script>
        $(function () {

            //Date picker
            $('#reservation_date').datepicker({
                startDate: '+1d',
                format: 'dd-mm-yyyy',
                autoclose: true,
                todayHighlight:true,
                language: 'es',
                daysOfWeekDisabled: [0],

            })

        });
        </script>;

@endpush

