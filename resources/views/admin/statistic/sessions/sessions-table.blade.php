
<p class ="mt-3 mb-3"><b>Ukupan broj sesija: {{ $sessions->count() }}</b></p>
<table class="table table-light">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Ime</th>
                <th scope="col">Datum sesije</th>
                <th scope="col">Rezime</th>
                <th scope="col">Plaćeno?</th>
                <th scope="col">Izmena</th>
            </tr>
        </thead>

        <tbody>
            <?php $counter = 0; ?>
            @foreach ($sessions as $session)


            <tr>
                <th scope="row">{{ ++ $counter }}</th>
                <td> <a class="text-primary" href="{{ route('admin.patient.profile', ['id' => $session->patient_id ])}}">{{$session->patient->name}}</a></td>
                <td>{{date('d-M-Y', strtotime($session->session_date)) }}</td>
                <td>{{$session->session_resime}}</td>
                <td>
                    <form action="{{ route('admin.update.session.paid.status.submit', ['id' => $session->id])}}" method = "POST">
                        @csrf
                        <input type="radio" name = "session_paid_{{ $session->id }}" value = "Da" {{ ($session->session_paid == "Da") ? "checked" : "" }}>Da
                        <input type="radio" class ="ml-2"name = "session_paid_{{ $session->id }}" value = "Ne" {{ ($session->session_paid == "Ne") ? "checked" : "" }}>Ne
                        <input type="submit" class = "btn btn-primary ml-3" value = "Promeni">
                    </form>
                </td>
                <td>

                        <a class="text-primary js-modal mb-5"
                        data-modalid='update_session'
                        data-modaltitle="Izmena sesije za: {{$session->patient->name}}"
                        data-maxwidth = 300,
                        data-url="{{ route('admin.session.update', ['id' => $session->id]) }}"
                        data-savetext="Sačuvaj">

                        <i class="fas fa-edit"></i> Izmeni podatke o sesiji
                    </a>
                </td>

            </tr>
            @endforeach


        </tbody>
    </table>