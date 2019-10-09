{{-- {{dd($patients)}} --}}
<p class ="mt-3 mb-3"><b>Ukupan broj pacijenata: {{ $patients->count() }}</b></p>

<table class="table table-light">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Ime</th>
            <th scope="col">Adresa</th>
            <th scope="col">Broj</th>
            <th scope="col">Skype</th>
            <th scope="col">Datum rođenja</th>
            <th scope="col">Zanimanje</th>
            <th scope="col">Tip sesije</th>
            <th scope="col">Cena</th>
            <th scope="col">Broj sesija</th>
            <th scope="col">Akcije</th>
        </tr>
    </thead>
    <tbody>
        <?php $counter = 0; ?>
        @foreach ($patients as $patient)
        <tr>
            <th scope="row">{{ ++ $counter }}</th>
            <td> <a class="text-primary" href="{{ route('admin.patient.profile', ['id' => $patient->id ])}}" target="_blank">{{$patient->name}}</a></td>
            <td>{{$patient->address}}</td>
            <td>{{$patient->phone}}</td>
            <td>{{$patient->skype_name}}</td>
            <td>{{$patient->date_of_birth}}</td>
            <td>{{$patient->profession}}</td>
            <td>{{$patient->session_type}} <br> <span>{{$patient->session_type_additional}}</span></td>
            <td>{{$patient->price}}</td>
            <td>{{$patient->sessions()->where('session_paid', 'Da')->count(). "/" . $patient->sessions()->count()}}</td>
            <td>
                <a href="" class="text-danger js-delete-patient" data-id="{{ $patient->id }}"> <i class="fas fa-trash-alt"></i> Ukloni pacijenta</a> <br/>
                
                <a class="text-primary  js-modal mb-5" data-modalid='add_backoffice_user'
                    data-modaltitle="Izmena pacijenta: {{$patient->name}}"
                    data-url="{{ route('admin.patient.update', ['id' => $patient->id]) }}" data-savetext="Sačuvaj">
                    <i class="fas fa-edit"></i>Izmeni podatke o pacijentu
                </a>
            </td>
        </tr>
        @endforeach

       
    </tbody>
</table>
