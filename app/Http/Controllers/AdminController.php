<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Models\Patient;
use App\Models\Session as SessionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use View;
use Response;
use Validator;
use Auth;
use Carbon\Carbon;


class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:admin');
    }

    /**
     *
     * Show the admin dashboard.
     *
     */
    public function index(Request $request) {
        return view('admin.dashboard');
    }


    /* #region Courses  */
    public function addCourse(Request $request) {

        if ($request->isMethod('post')) {
            //  validation first

            //  then
            $course_name      = $request->input('course_name');
            $description      = $request->input('course_description');
            $price            = $request->input('course_price');
            $expiration_date  = Carbon::now()->addMonths(6)->toDateTimeString();



            if ($request->hasFile('course_demo')) {

                $demo = $request->file('course_demo');
                $name = time() . '.' . $demo->getClientOriginalExtension();
                $path = $demo ? $demo->move('videos/demos/', $name) : null;
            }

            $course = new Course();

            $course->name               = $course_name;
            $course->demo               = $path;
            $course->description        = $description;
            $course->price              = $price;
            $course->expiration_date    = $expiration_date;

            $course->save();

            Session::flash('success', 'Kurs je dostupan do: ' . date('d-M-Y', strtotime($expiration_date)));

            return redirect('/aadmin/kursevi/unos-kursa');
        }

        return view('admin.courses.add-course');
    }
    /* #endregion */

    /* #region  Patients */
    public function addPatient(Request $request) {
        $validator = null;
        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                "patient_name"       => "required",
                "consultation"       => "required",
                "consultation_date"  => "required",
                "session_price"      => "required|numeric",
                "profession"         => "max:60"
            ],
            [
                "patient_name.required"      => "Polje 'Ime: ' ne sme biti prazno",
                "consultation.required"      => "Polje 'Konsultacija: ' ne sme biti prazno",
                "consultation_date.required" => "Izaberite datum",
                "profession.max"             => "Maksimum broj karaktera koji mozete da uneste za zanimanje je: 60",
                "session_price.required"     => "Unesite cenu!",
                "session_price.numeric"      => "Unesite cenu bez razmaka",


            ]);

            if ($validator->passes()){
                $name               = $request->input('patient_name');
                $address            = $request->input('patient_address');
                $phone              = $request->input('patient_phone');
                $skype_name         = $request->input('patient_skype');
                $dob                = $request->input('patient_dob');

                $dob ? (date('Y-m-d H:i:s', strtotime($request->input('patient_dob')))) : $dob;
                //$dob                = date('Y-m-d H:i:s', strtotime($request->input('patient_dob')));
                $profession         = $request->input('profession');
                $session_type       = $request->input('session_type');
                $diagnosis          = $request->input('patient_diagnosis');
                $therapy            = $request->input('patient_therapy');
                $consultation_date  = $request->input('consultation_date');
                $consultation_date ? $consultation_date = date('Y-m-d H:i:s', strtotime($request->input('consultation_date'))) : "";

                $consultation       = $request->input('consultation');
                $session_price      = $request->input('session_price');
                $session_type_add   = $request->input('session_type_additional');


                $patient = new Patient();

                //  @todo this can be write in Model or Repository or Service
                $patient->name                      = $name;
                $patient->address                   = $address;
                $patient->phone                     = $phone;
                $patient->skype_name                = $skype_name;
                $patient->date_of_birth             = $dob;
                $patient->profession                = $profession;
                $patient->session_type              = $session_type;
                $patient->session_type_additional   = $session_type_add;
                $patient->diagnosis                 = $diagnosis;
                $patient->therapy                   = $therapy;
                $patient->consultation              = $consultation;
                $patient->price                     = $session_price;
                $patient->date_of_consultation      = $consultation_date;


                if($patient->save()) {
                    Session::flash('success', 'Uspesno ste uneli pacijenta ' . $name);
                    return redirect()->back();
                }

            }


        }
        return view('admin.patients.add-patient', ['validator' => $validator]);
    }

    public function editPatient(Request $request, $patient_id) {
        $success = null;
        $validator = null;
        $patient = Patient::find($patient_id);

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                "new_consultation"  => "required",
                "new_profession"    => "max:60"
            ],
            [

                "new_consultation.required" => "Polje 'Konsultacija: ' ne sme biti prazno",
                "new_profession.max"        => "Maksimum broj karaktera koji mozete da uneste za zanimanje je: 60",
            ]);

            if ($validator->passes()){

                $patient = Patient::find($patient_id);

                $patient->address            = $request->input('new_address');
                $patient->phone              = $request->input('new_phone');
                $patient->skype_name         = $request->input('new_skype');
                $patient->profession         = $request->input('new_profession');
                $patient->diagnosis          = $request->input('new_patient_diagnosis');
                $patient->therapy            = $request->input('new_patient_therapy');
                $patient->consultation       = $request->input('new_consultation');


                if($patient->save()) {
                    Session::flash('success', 'Uspesno ste izmenili podatke o pacijentu ');
                    $success = true;
                }
            }
        }

        $html = View::make('admin.modals.update-patient', [

            'patient' => $patient,
            'validator' => $validator
        ])->render();

        return Response::json( ["html"=>$html, "success" => $success]);

    }
    /* #endregion */

    /* #region  Sessions */
    public function addSession(Request $request, $patient_id = null) {

        $validator = null;
        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                "patient_id"    => "required",
                "session_date"  => "required",
                "session_paid"  => "required",
            ],
            [
                "patient_id.required"   => "Izaberite pacijenta",
                "session_date.required" => "Izaberite datum sesije.",
                "session_paid.required" => "Izaberite status",
            ]);

            if ($validator->passes()){
                $patient_id     = $request->input('patient_id');
                $session_date   = date('Y-m-d H:i:s', strtotime($request->input('session_date')));
                $session_resime = $request->input('session_resime');
                $session_paid   = $request->input('session_paid');

                $session = new SessionModel();

                $session->patient_id        = $patient_id;
                $session->session_date      = $session_date;
                $session->session_resime    = $session_resime;
                $session->session_paid      = $session_paid;

                if($session->save()) {
                    $patient = Patient::where('id', $patient_id)->first();
                    Session::flash('success', 'Uspesno ste uneli sesiju za pacijenta: ' . $patient->name);
                    return redirect()->back();
                }
            }
        }

        $patients = Patient::all();
        return view('admin.patients.sessions.add-session', [
            'patients'      => $patients,
            'patient_id'    => $patient_id,
            'validator'     => $validator
        ]);
    }

    public function getSessions(Request $request) {
        $sessions = SessionModel::all()->sortByDesc('session_date');

        if($request->isMethod('post')) {

            $date_from = $request->input('dateFrom');
            $date_to   = $request->input('dateTo');

            $search = $request->input('search_by_name');

            // searching patient sessions based on patient name, without providing patient id
            // Solved with Laravel Relationship
            if($date_from && $date_to && $search) {
                $sessions = SessionModel::whereHas('patient', function ($query) use ($search, $date_from, $date_to){
                    $query->whereBetween('session_date', [
                        date('Y-m-d', strtotime($date_from)),
                        date('Y-m-d', strtotime($date_to))
                    ])
                    ->where('name', 'like', $search.'%');
                })->get();
            }

            if($date_from && $date_to) {
                $sessions = SessionModel::whereBetween('session_date', [
                    date('Y-m-d', strtotime($date_from)),
                    date('Y-m-d', strtotime($date_to))
                ])->orderBy('session_paid', 'asc')
                  ->get();
            }


            if($search) {
                $sessions = SessionModel::whereHas('patient', function ($query) use ($search){
                    $query->where('name', 'like', $search.'%');
                })->get();
            }

        }

        //dd($sessions);
        $html = View::make('admin.statistic.sessions.sessions-table', [
            'sessions' => $sessions,
        ])->render();

        return Response::json(['html'=>$html]);
    }

    // update status paid
    public function updateSessionStatus(Request $request, $session_id) {


        if ($request->isMethod('post')) {


            $session_paid = $request->input('session_paid_'.$session_id);

            $session = SessionModel::find($session_id);

            $session->session_paid = $session_paid;

            $session->save();


            Session::flash('success', 'Uspesno ste promenili status "plaćeno" u '. $session_paid. ' za pacijenta');

            return redirect()->back();

        }
    }

    public function updateSession(Request $request, $session_id) {
        $session = SessionModel::find($session_id);
        $success = null;
        $validator = null;

        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                "new_session_resime" => "required",
            ],
            [
                "new_session_resime.required" => "Upišite rezime!",

            ]);

            if ($validator->passes()){
                $session_paid   = $request->input('session_paid_'.$session_id);
                $session_date   = date('Y-m-d H:i:s', strtotime($request->input('new_session_date')));
                $session_resime = $request->input('new_session_resime');

                $session->session_date   = $session_date;
                $session->session_resime = $session_resime;
                $session->session_paid   = $session_paid;

                if($session->save()) {
                    Session::flash('success', 'Uspesno ste promenili podatke o sesiji za pacijenta');
                    $success = true;
                }
            }

        }

        $html = View::make('admin.modals.update-session', [
             'session'   => $session,
             'validator' => $validator,
        ])->render();

        return Response::json( ["html"=>$html, "success" => $success]);
    }


    /* #endregion */

    public function showStatistic($tab_name = null) {
        $patients = Patient::all();
        $sessions = SessionModel::all()->sortByDesc('session_date');

        return view('admin.statistic.statistic', [
            'patients' => $patients,
            'sessions' => $sessions,
            'tab_name' => $tab_name,
            ]);
    }

    public function getPatients(Request $request) {
        $patients = Patient::all();
        $paided_sessions = null;
        if($request->isMethod('post')) {

            $date_from = $request->input('dateFrom');
            $date_to   = $request->input('dateTo');

            $search = $request->input('search_by_name');

            if($search) {
                $patients = Patient::where('name', 'like', $search.'%' )->get();
            }

            if($date_from && $date_to) {
                $patients = Patient::whereBetween('created_at', [date('Y-m-d', strtotime($date_from)), date('Y-m-d', strtotime($date_to))])->get();
            }

            if($date_from && $date_to && $search) {
                $patients = Patient::whereBetween('created_at', [
                    date('Y-m-d', strtotime($date_from)),
                    date('Y-m-d', strtotime($date_to))
                    ])
                    ->where('name', 'like', $search.'%')
                    ->get();
            }


            $paided_sessions = Patient::whereHas('sessions', function ($query){
                $query->where('session_paid', 'Da');

            })->count();


        }


        $html = View::make('admin.statistic.patients.patients-table', [
            'patients' => $patients,
            'paided_sessions' => $paided_sessions
        ])->render();

        return Response::json(['html'=>$html]);

    }

    public function patientProfile(Request $request, $patient_id = null) {

        $validator = null;
        $selected_patient = $request->input('search_by_selected_name');

        // checking if patient_id comes from header search or from statistic page search
        $patient_id = $patient_id ? $patient_id : $selected_patient;
        $patient = Patient::find($patient_id);


        $sessions = SessionModel::where('patient_id', $patient_id)
                                  ->orderBy('session_date', 'desc')->get();


        return view('admin.patients.patient-profile', [
            'patient'  => $patient,
            'sessions' => $sessions,
            'validator' => $validator
        ]);
    }

    public function deletePatient($patient_id) {
        $patient = Patient::find($patient_id);

        $success = true;

        if($patient->delete()) {
            $success = true;
        }

        return Response::json(["success" => $success]);

    }


    public function updatePassword(Request $request, $admin_id) {
        $validator = null;

        $validator = Validator::make($request->all(), [
            "new_password"       => "required",
        ],
        [
            "new_password.required" => "Ne sme biti prazno!",
        ]);

        if ($validator->passes()){
            $new_password = $request->input('new_password');

            $admin = Admin::find($admin_id);

            $admin->password = Hash::make($new_password);

            if($admin->save()) {
                Session::flash('success-password-change', 'Uspesno ste promenili lozinku za korisnika: ' . Auth::user()->email );
                Auth::logout();

              return redirect()->back();

            }

        }
    }

}
