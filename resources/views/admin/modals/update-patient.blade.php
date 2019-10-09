<form method="POST" action="{{ route('admin.patient.update', ['id' => $patient->id]) }}" js-callbacks="reloadPage">
        @csrf

        <div class="form-group row">

            <div class="modal-body mx-auto mx-3 ">
                <div class="mt-3  form-group col-md-12">
                    <label for="">Datum rođenja</label>
                    <input type="text" class="form-control" value="{{ $patient->date_of_birth }}" readonly>
                </div>

                <div class="row p-3">
                    <div class="mt-3 form-group col-md-6">
                        <label for="">Adresa</label>
                        <input type="text" class="form-control" value="{{ $patient->address }}" name="new_address">
                    </div>

                    <div class="mt-3 col-md-6">
                        <label for="">Broj</label>
                        <input type="text" class="form-control" value="{{ $patient->phone }}" name="new_phone">
                    </div>

                    <div class="mt-3 col-md-6">
                        <label for="">Skype</label>
                        <input type="text" class="form-control" value="{{ $patient->skype_name }}" name="new_skype">
                    </div>

                    <div class="mt-3 col-md-6">
                        <label for="">Zanimanje</label>
                        <input type="text" class="form-control" value="{{ $patient->profession }}" name="new_profession">
                        @if ( $validator && $validator->errors()->first('new_profession') )
                        <div class="alert alert-danger mt-2">
                            {{ $validator->errors()->first('new_profession') }}
                        </div>
                        @endif
                    </div>


                    <div class="mt-4 col-md-6">
                        <label for="">Dijagnoza</label>
                        <textarea name="new_patient_diagnosis" id="new_patient_diagnosis" cols="50" rows="6" class="form-control">{{ $patient->diagnosis }}</textarea>
                    </div>

                    <div class="mt-4 col-md-6">
                        <label for="">Terapija</label>
                        <textarea name="new_patient_therapy" id="new_patient_therapy" cols="50" rows="6" class="form-control">{{ $patient->therapy }}</textarea>
                    </div>

                    <div class="mt-3 col-md-12">
                        <label for="">Konsultacija</label>
                        <textarea name="new_consultation" id="" class="form-control" rows="6">{{ $patient->consultation }}</textarea>

                        @if ( $validator && $validator->errors()->first('new_consultation') )
                        <div class="alert alert-danger mt-2">
                            {{ $validator->errors()->first('new_consultation') }}
                        </div>
                        @endif
                    </div>


                </div>
            </div>

        </div>

     

    </form>