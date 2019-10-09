<section class="form-elegant">

        <!--Form without header-->
        <div class="card">

            <div class="card-body mx-4">

                <div class="text-center">
                    <h3 class="dark-grey-text mb-5"><strong>Pretraga sesija</strong></h3>
                </div>

                <form js-container="#container-sessions" class="ajax-form form-sessions"
                    action="{{ route('admin.sessions.statistic.submit')}}">

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
                                <input type="text" class="datepicker form-control" placeholder="Do..." name="dateTo" value="">

                            </div>
                        </div>
                        
                        <div class="md-form">
                            <input type="submit" class="js-submit btn btn-primary" value="pretrazi">
                        </div>
                    </div>
                </form>
                    <div class="table-responsive">
                        <div id="container-sessions">
                            @if (isset($sessions))
                            @include ('admin.statistic.sessions.sessions-table')
                            @endif
                        </div>
                    </div>

                

            </div>



        </div>

    </section>