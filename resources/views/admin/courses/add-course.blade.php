@extends ('layouts.admin.admin-app')

@section('content')
@if (Session::has('success'))

<div class="alert alert-success alert-dismissible fade show" role="alert">
    <h4 class="alert-heading">Uspešno ste uneli novi kurs!</h4><br/>
    <p>{{Session::get('success')}}</p>
    <hr>
    <p class="mb-0"> <a href="{{ route('courses')}}" class="alert-link">Pogledajte kurseve</a></p>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>



@endif
<div class="col-md-12 ">
    <section class="form-elegant">
        <!--Form without header-->
        <div class="card">

            <div class="card-body mx-4">
                <!--Header-->
                <div class="text-center">
                    <h3 class="dark-grey-text mb-5"><strong>Unos kursa</strong></h3>
                </div>

                <!--Body-->
                <form action="{{ route('admin.insert.tutorial.submit')}}" method = "POST" enctype="multipart/form-data">
                    @csrf
                    <div class="md-form">
                        <label for="course_name">Naziv kursa</label>
                        <input type="text" class="form-control" name="course_name" id="course_name">
                    </div>
                    <label for="course_description">Opis kursa</label>

                    <div class="md-form pb-3">
                        <textarea name="course_description" id="course_description" cols="50" rows="6"
                            class="form-control"></textarea>
                    </div>

                    <div class="md-form">
                        <label for="course_price">Cena kursa</label>
                        <input type="text" class="form-control" name="course_price" id="course_price">
                    </div>

                    <label for="course_file">Demo:</label>
                    <div class="md-form">
                        <input type="file" name="course_demo" class="form-control">
                    </div>

                    <div class="text-center mb-3 col-md-2 offset-5">
                        <input type="submit" class="btn blue-gradient btn-block btn-rounded z-depth-1a" value = "Unesi kurs">
                    </div>

                </form>

            </div>



        </div>
        <!--/Form without header-->

    </section>


</div>

@endsection