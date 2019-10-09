@extends ('layouts.admin.admin-app')

@section('content')

<div class="col-md-6 offset-3 ">
    @if (Session::has('success'))

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <p>{{Session::get('success')}}</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    @endif
    <section class="form-elegant">
        <!--Form without header-->
        <div class="card">

            <div class="card-body mx-4">
                <!--Header-->
                <div class="text-center">
                    <h3 class="dark-grey-text mb-5"><strong>Unos pacijenta</strong></h3>
                </div>

                <!--Body-->
                <form action="{{ route('admin.insert.patient.submit')}}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="md-form">
                                <label for="patient_name">Ime i prezime:</label>
                                <input type="text" class="form-control" name="patient_name" id="patient_name" value = "{{ Request::get('patient_name') }}">
                                @if ( $validator && $validator->errors()->first('patient_name') )
                                <div class="alert alert-danger mt-2">
                                    {{ $validator->errors()->first('patient_name') }}
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="md-form">
                                <label for="patient_address">Prebivalište:</label>
                                <input type="text" class="form-control" name="patient_address" id="patient_address" value = "{{ Request::get('patient_address') }}">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="md-form">
                                <label for="patient_phone">Broj telefona:</label>
                                <input type="text" class="form-control" name="patient_phone" id="patient_phone" value = "{{ Request::get('patient_phone') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="md-form">
                                <label for="patient_skype">Skype name:</label>
                                <input type="text" class="form-control" name="patient_skype" id="patient_skype" value = "{{ Request::get('patient_skype') }}">
                            </div>
                        </div>


                        <div class="col-md-6 mt-5">
                            <label for="patient_dob">Datum rođenja:</label>
                            <div class="md-form">
                                <input class="form-control datepicker" name="patient_dob" type="text" value = "{{ Request::get('patient_dob') }}">
                            </div>
                        </div>

                        <div class="col-md-6 mt-5">
                            <label for="patient_profession">Zanimanje:</label>
                            <div class="md-form">
                                <input class="form-control" name="profession" type="text" value = "{{ Request::get('profession') }}">
                                @if ( $validator && $validator->errors()->first('profession') )
                                <div class="alert alert-danger mt-2">
                                    {{ $validator->errors()->first('profession') }}
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6 mt-5">
                            <label for="session_type">Način održavanja sesija:</label>
                            <div class="md-form">
                                <select name="session_type" id="session_type" class="form-control">
                                    <option value="0">--Izaberite--</option>
                                    <option value="Online" {{ Request::get('session_type') == 'Online' ? 'selected' : ''}}>Online</option>
                                    <option value="Direktno" {{ Request::get('session_type') == 'Direktno' ? 'selected' : ''}}>Direktno</option>
                                    <option value="Mix" {{ Request::get('session_type') == 'Mix' ? 'selected' : ''}}>Mix</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 mt-5" id="hidden_additional" style=" {{ Request::get('session_type') == 'Online' ? 'display:block' : 'display:none' }}">
                            <label for="session_type">Tip online sesije:</label>

                            <div class="md-form">
                                <select name="session_type_additional" class="form-control" id="">
                                    <option value=" ">--Izaberite--</option>
                                    <option value="Skype"    {{ Request::get('session_type_additional') == 'Skype'    ? 'selected' : ''}}>Skype</option>
                                    <option value="Msn"      {{ Request::get('session_type_additional') == 'Msn'      ? 'selected' : ''}}>Msn</option>
                                    <option value="Viber"    {{ Request::get('session_type_additional') == 'Viber'    ? 'selected' : ''}}>Viber</option>
                                    <option value="WhatsApp" {{ Request::get('session_type_additional') == 'WhatsApp' ? 'selected' : ''}}>WhatsApp</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="consultation">Konsultacija:</label>
                            <div class="md-form">
                                <textarea name="consultation" id="" class="form-control" rows="6" >{{ Request::get('consultation') }}</textarea>
                                @if ( $validator && $validator->errors()->first('consultation') )
                                <div class="alert alert-danger mt-2">
                                    {{ $validator->errors()->first('consultation') }}
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for="consultation_date">Datum Konsultacije:</label>
                            <div class="md-form">
                                <input class="form-control datepicker" name="consultation_date" type="text" value="{{ date('d-m-Y')}}">
                                

                                @if ( $validator && $validator->errors()->first('consultation_date') )
                                <div class="alert alert-danger mt-2">
                                    {{ $validator->errors()->first('consultation_date') }}
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="patient_diagnosis">Dijagnoza:</label>
                            <div class="md-form pb-3">
                                <textarea name="patient_diagnosis" id="patient_diagnosis" cols="50" rows="6"
                                    class="form-control">{{ Request::get('patient_diagnosis') }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="patient_therapy">Terapija:</label>
                            <div class="md-form pb-3">
                                <textarea name="patient_therapy" id="patient_therapy" cols="50" rows="6"
                                    class="form-control">{{ Request::get('patient_therapy') }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="md-form">
                                <label for="session_price">Cena sesije:</label>
                                <input type="text" class="form-control" name="session_price" value = "{{ Request::get('session_price') }}">
                                @if ( $validator && $validator->errors()->first('session_price') )
                                <div class="alert alert-danger mt-2">
                                    {{ $validator->errors()->first('session_price') }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="text-center mb-3">
                        <input type="submit" class="btn blue-gradient btn-block btn-rounded z-depth-1a"
                            value="Unesi pacijenta">
                    </div>

                </form>

            </div>



        </div>
        <!--/Form without header-->

    </section>

</div>

@endsection

@section('footer-js')

<script>
    $( "#session_type" ).change(function() {

        var session_type = $('#session_type').val();

        if(session_type == "Online") {
            $('#hidden_additional').show();
        } else{
            $('#hidden_additional').hide();
        }
    });

</script>
@endsection