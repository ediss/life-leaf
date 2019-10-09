@extends ('layouts.admin.admin-app')

@section('content')

@if (Session::has('success'))

<div class="alert alert-success alert-dismissible fade show col-12" role="alert">
    <p>{{Session::get('success')}} {{$patient->name}}</p>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

@endif

<div class="col-md-4">
    <a href="" class="text-danger js-delete-patient" data-id="{{ $patient->id }}"> <i class="fas fa-trash-alt"></i>
        Ukloni pacijenta</a> <br />
</div>

<div class="col-md-4">
    <a class="text-primary  js-modal mb-5" data-modalid='update_patient'
        data-modaltitle="Izmena pacijenta: {{$patient->name}}"
        data-url="{{ route('admin.patient.update', ['id' => $patient->id]) }}" data-savetext="Sačuvaj">
        <i class="fas fa-edit"></i> Izmeni podatke o pacijentu
    </a>

</div>

<div class="col-md-4 text-right">
    <a href="{{ route('admin.insert.session', ['id' => $patient->id]) }}" class="btn btn-primary" target="_blank">Dodaj
        sesiju</a>
</div>

<div class="card text-dark bg-light col-md-3">
    <h3 class="dark-grey-text mb-3 mt-4 text-center"><strong>{{ $patient->name }}</strong></h3>

    {{-- <img class="card-img-top" src="..." alt="Card image cap"> --}}
    <div class="card-body">
        <h5 class="card-title font-weight-bold">Opšti podaci</h5>
        <hr>
        <p class="card-text">Datum rođenja: {{ $patient->date_of_birth }}</p>
        <hr>
        <p class="card-text">Adresa: {{ $patient->address }}</p>
        <hr>
        <p class="card-text">Broj: {{ $patient->phone }}</p>
        <hr>
        <p class="card-text">Skype: {{ $patient->skype_name }}</p>
        <hr>
        <p class="card-text">Zanimanje: {{ $patient->profession }}</p>

    </div>
</div>

<div class="col-md-4">
    <section class="form-elegant">
        <!--Form without header-->
        <div class="card">

            <div class="card-body mx-4 ">

                <!--Header-->
                <div class="text-left">

                    <p class="card-text"><b>Tip sesije:</b> <br>{{ $patient->session_type }}
                        {{ ($patient->session_type_additional) ? ($patient->session_type_additional) : ""}}</p>
                    <hr>
                    <p class="card-text"><b>Dijagnoza:</b> <br>{{$patient->diagnosis}}</p>
                    <hr>
                    <p class="card-text"><b>Terapija: </b> <br>{{$patient->therapy}}</p>
                    <hr>
                    <p class="card-text"><b>Konsultacija:</b> <br> {{$patient->consultation}} </p>
                    <hr>
                    <p class="card-text"><b>Datum konsultacije:</b> <br>
                        {{($patient->date_of_consultation !=null) ? date('d-M-Y', strtotime($patient->date_of_consultation)) : ""}}
                    </p>
                    <hr>
                    <p class="card-text"><b>Cena sesije:</b> <br> {{$patient->price}} </p>
                    <hr>

                    <p class="card-text"><b>Plaćeno:</b> <br>
                        {{  $patient->sessions()->where('session_paid', 'Da')->count(). " od " . $patient->sessions()->count()}}
                    </p>
                    <hr>
                    <p>Ukupno: {{ ($patient->sessions()->where('session_paid', 'Da')->count()) * ($patient->price) }}
                    </p>

                </div>

            </div>
        </div>


    </section>
</div>

<div class="col-md-5">
    <section class="form-elegant">
        <!--Form without header-->
        <div class="card">

            <div class="card-body mx-4 ">
                <!--Header-->
                <div class="text-left">
                    <h3 class="dark-grey-text mb-3 mt-2 text-center"><strong>Obavljene sesije</strong></h3>

                    @if($sessions)
                    @foreach ($sessions as $session)

                    <p class="card-text">{{ $session->session_resime }}</p>
                    <p class="card-text">Plaćeno? </p>
                    <div class="row">
                        <div class="col-7">

                            <form js-callbacks="reloadPage"
                                action="{{ route('admin.update.session.paid.status.submit', ['id' => $session->id])}}"
                                method="POST">
                                @csrf
                                <input type="radio" name="session_paid_{{ $session->id }}" value="Da"
                                    {{ ($session->session_paid == "Da") ? "checked" : "" }}>Da
                                <input type="radio" class="ml-2" name="session_paid_{{ $session->id }}" value="Ne"
                                    {{ ($session->session_paid == "Ne") ? "checked" : "" }}>Ne
                                <input type="submit" class="btn btn-primary ml-3" value="Promeni">

                            </form>
                        </div>
                        <div class="col-5">
                            <p class="text-right card-text"> {{ date('d-M-Y', strtotime($session->session_date)) }}</p>
                        </div>

                    </div>
                    <a class="text-primary js-modal mb-5"
                        data-modalid='update_session'
                        data-modaltitle="Izmena sesije za: {{$patient->name}}"
                        data-maxwidth = 300,
                        data-url="{{ route('admin.session.update', ['id' => $session->id]) }}"
                        data-savetext="Sačuvaj">
                        
                        <i class="fas fa-edit"></i> Izmeni podatke o sesiji
                    </a>
                    <hr>
                    @endforeach
                    @endif




                </div>

            </div>
        </div>


    </section>
</div>
@endsection
@section('footer-js')

<script>
    $(document).on('click', '.js-delete-patient', function (e) {
        e.preventDefault();
            var id = $(this).attr('data-id');
            var success_url = "{{ url('') }}/aadmin/pacijenti/statistika";
            Swal.fire({
                title: "Da li ste sigurni?",
                text: "",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#02a499",
                cancelButtonColor: "#ec4561",
                confirmButtonText: "Da, ukloni pacijenta!"
              }).then(function (result) {
                if (result.value) {

                    $.ajax({
                        data: {"_token": "{{ csrf_token() }}"},
                        type: 'POST',
                        url: "{{ url('') }}/aadmin/pacijenti/pacijent/brisanje/" + id,

                        success: function (response) {
                            if (response.success){

                                Swal.fire({
                                    title: "Uklonjen!",
                                    text : "Pacijent je uspešno uklonjen iz sistema.", 
                                    type : "success"
                                }).then(function (result) {
                                    if (result.value) {
                                        window.location = success_url;
                                    }
                                })
                            }
                            else {
                                Swal.fire("Greška!", "Ne mogu da uklonim pacijenta. Obratite se programeru.", "error");
                            }
                        }
                    });
                }
            });
        });
</script>

@endsection