<form method="POST" action="{{ route('admin.session.update', ['id' => $session->id]) }}" js-callbacks="reloadPage">
    @csrf

    <div class="form-group row">

        <div class="modal-body mx-auto mx-3 ">

            <div class="mt-3  form-group col-md-12">
                <label for="">Datum sesije</label>
                <input class="form-control datepicker"  value="{{ date('d-m-Y', strtotime($session->session_date)) }}" name="new_session_date" type="text">
            </div>

            <div class="row p-3">

                <div class="mt-3 form-group col-md-12">
                    <label for="">Rezime sesije</label>
                    <textarea name="new_session_resime" id="" class="form-control"
                        rows="6">{{ $session->session_resime }}</textarea>
                    @if ( $validator && $validator->errors()->first('new_session_resime') )
                    <div class="alert alert-danger mt-2">
                        {{ $validator->errors()->first('new_session_resime') }}
                    </div>
                    @endif
                </div>

                <div class="mt-3 col-md-12">
                    <label for="">Plaćeno?</label>
                    <input type="radio" name="session_paid_{{ $session->id }}" value="Da"
                        {{ ($session->session_paid == "Da") ? "checked" : "" }}>Da
                    <input type="radio" class="ml-2" name="session_paid_{{ $session->id }}" value="Ne"
                        {{ ($session->session_paid == "Ne") ? "checked" : "" }}>Ne
                </div>

            </div>
        </div>

    </div>



</form>