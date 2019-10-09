@extends('layout.master')
@section('css')
{{-- <link href="css/shop.css" rel="stylesheet"> --}}

<link href="{{ asset('css/shop2.css') }}" rel="stylesheet">


{{-- <link rel="stylesheet" href="css/popup.css" type="text/css" media="all" />

<link rel="stylesheet" href="css/usluge.css" type="text/css" media="all" /> --}}
@endsection

@section('content')

<div class="col border-danger">
    <div class="col-md-6 offset-3 mt-5">
        <h1 class="text-center">Kursevi</h1>
        <div class="row mt-5">

            @foreach ($courses as $course)
            <div class="col-md-4">
                <div class="card card-block">
           
                    <a href="{{route('tutorial', ['id' => $course->id])}}">
                    <img class="img-fluid product__image p-2 " src="images/{{ $course->demo }}" alt="" />
                        <h5 class="card-title mt-3 mb-3 text-center text-dark font-weight-bold">
                            {{ $course->name }}
                        </h5>
                        <p class="card-text p-2">Profesor: Maja Vučković</p>
                        <p class="card-text float-left p-2">BROJ POLAZNIKA 590 <p>
                        <p class="card-text float-right p-2"><strong>{{ $course->price }},00RSD</strong></p>

                    </a>

                </div>
            </div>
            @endforeach
           

        </div>
    </div>


</div>

@endsection