@extends ('layouts.admin.admin-app')

@section('content')

@if (Session::has('success'))

<div class="alert alert-success alert-dismissible fade show" role="alert">
    <p>{{Session::get('success')}}</p>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

@endif


<nav class="col-md-12">
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link {{ empty($tab_name) || $tab_name == 'nav-patients-tab' ? 'active' : '' }} "
            id="nav-patients-tab" data-toggle="tab" href="#nav-patients" role="tab" aria-controls="nav-patients"
            aria-selected="true">Pacijenti</a>

        <a class="nav-item nav-link {{ !empty($tab_name) && $tab_name == 'nav-sessions-tab' ? 'active' : '' }}" id="nav-sessions-tab" data-toggle="tab" href="#nav-sessions" role="tab"
            aria-controls="nav-sessions" aria-selected="false">Sesije</a>

    </div>
</nav>

<div class="tab-content col-md-12" id="nav-tabContent">

    <div class="tab-pane fade {{ empty($tab_name) || (!empty($tab_name) && $tab_name == 'nav-patients-tab') ? 'show active' : '' }}  "
        role="tabpanel" aria-labelledby="nav-patients-tab" id = "nav-patients">
        @include('admin.statistic.patients.patients-form')
    </div>

    

    <div class="tab-pane fade {{ !empty($tab_name) && $tab_name == 'nav-sessions-tab' ? 'show active' : '' }}" id = "nav-sessions" role="tabpanel" aria-labelledby="nav-sessions-tab">
        @include('admin.statistic.sessions.sessions-form')
    </div>


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