<section class="form-elegant">

        <!--Form without header-->
        <div class="card">

            <div class="card-body mx-4">

                <div class="text-center">
                    <h3 class="dark-grey-text mb-5"><strong>Pretraga pacijenata</strong></h3>
                </div>

                <form js-container="#container-patients" class="ajax-form form-patients"
                    action="{{ route('admin.patients.statistic.submit')}}">

                    @csrf


                    <div class="row">

                        <div class="col-md-3">
                            <div class="md-form">
                                <input type="text" class="form-control" name="search_by_name" placeholder="Pretraži po imenu...">
                            </div>
                        </div>
                        <div class="col-md-3">

                            <div class="md-form">
                                <input class="form-control datepicker" value="" placeholder="Od..." name="dateFrom" type="text">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="md-form">
                                <input type="text" class="datepicker form-control" id="dateTo" placeholder="Do..." name="dateTo" value="">

                            </div>
                        </div>
                        
                        <div class="md-form">
                            <input type="submit" class="js-submit btn btn-primary" value="pretrazi">
                        </div>
                    </div>

                    <div class="table-responsive">
                        <div id="container-patients">
                            @if (isset($patients))
                            @include ('admin.statistic.patients.patients-table')
                            @endif
                        </div>
                    </div>

                </form>

            </div>



        </div>

    </section>