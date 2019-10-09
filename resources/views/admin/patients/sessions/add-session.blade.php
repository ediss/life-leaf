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
                    <h3 class="dark-grey-text mb-5"><strong>Unos Sesije</strong></h3>
                </div>

                <!--Body-->
                <form action="{{ route('admin.insert.session.submit')}}" method="POST">
                    @csrf

                    <label for="patient_name">Pacijent:</label>
                    <div class="md-form">
                        <select name="patient_id" id="patient_id" class="form-control">
                            <option value="">--Izaberite pacijenta--</option>
                            @foreach($patients as $patient)
                            <option value="{{ $patient->id }}" {{($patient->id == $patient_id) ? 'selected' : ''}}>
                                {{ $patient->name }}
                            </option>
                            @endforeach
                        </select>
                        @if ( $validator && $validator->errors()->first('patient_id') )
                        <div class="alert alert-danger mt-2">
                            {{ $validator->errors()->first('patient_id') }}
                        </div>
                        @endif
                    </div>

                    <label for="session_date">Datum sesije:</label>
                    <div class="md-form">
                        <input class="form-control datepicker" name="session_date" type="text" value="{{ Request::get('session_date') }}">
                        @if ( $validator && $validator->errors()->first('session_date') )
                        <div class="alert alert-danger mt-2">
                            {{ $validator->errors()->first('session_date') }}
                        </div>
                        @endif
                    </div>


                    <label for="session_resime">Rezime sesije:</label>
                    <div class="md-form">
                        <textarea name="session_resime" id="session_resime" cols="50" rows="6"
                            class="form-control">{{ Request::get('session_resime') }}</textarea>
                    </div>

                    <label for="session_paid">Plaćeno?</label>
                    <div class="md-form">
                        <input type="radio" name="session_paid" value="Da" {{ Request::get('session_paid') == 'Da' ? 'checked' : '' }}>Da<br />
                        <input type="radio" name="session_paid" value="Ne" {{ Request::get('session_paid') == 'Ne' ? 'checked' : '' }}>Ne
                        @if ( $validator && $validator->errors()->first('session_paid') )
                        <div class="alert alert-danger mt-2">
                            {{ $validator->errors()->first('session_paid') }}
                        </div>
                        @endif
                    </div>





                    <div class="text-center mb-3">
                        <input type="submit" class="btn blue-gradient btn-block btn-rounded z-depth-1a"
                            value="Unesi sesiju">
                    </div>

                </form>

            </div>



        </div>
        <!--/Form without header-->

    </section>

</div>

@endsection