@extends('layout.master')
@section('css')

<link href="{{ asset('css/video-youtube.css') }}" rel="stylesheet" type="text/css" media="all" />
<link href="{{ asset('css/prof.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/shop2.css') }}" rel="stylesheet">

@endsection

@section('content')

<div class="col-md-8 offset-2 mt-5 box-shadow bg-light">
    <h1 class="pt-4">TUTORIJAL 1</h1>
    <div class="row">
        <div class="col-md-8 mt-5">
            <div class="video-wrapper">
                <iframe width="640" height="360" src="{{ asset($tutorial->demo)}}" frameborder="0"
                    webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>
            </div>

            <div class="text-center">
                <a href="#" class="button-style" data-animation="animated fadeInDown" data-aos="fade-down"
                    style="width: 200px;">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Kupi kurs
                </a>
                <a href="#" class="button-style" data-animation="animated fadeInDown" data-aos="fade-down"
                    style="width: 200px;">
                    <i class="fas fa-share" aria-hidden="true"></i> Preporuči kurs
                </a>

                <hr>

                <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            <p><i class="fab fa-youtube ml-2"></i> 1. Tutorijal</p>
                            <div class="mt-3 text-left">
                                <a class="p-2 text-dark" style="background-color: #F0F0F0" href="#">Vestina 1</a>
                                <a class="p-2 text-dark" style="background-color: #F0F0F0" href="#">Vestina 2</a>
                                <a class="p-2 text-dark" style="background-color: #F0F0F0" href="#">Vestina 3</a>

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mt-5 text-right">
                                <span class="fa fa-user"></span> Maja Vučković
                                <span class="fas fa-clock ml-4"></span> 43:15 min
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-6">
                            <p><i class="fab fa-youtube ml-2"></i> 2. Tutorijal</p>
                            <div class="mt-3 text-left">
                                <a class="p-2 text-dark" style="background-color: #F0F0F0" href="#">Vestina 1</a>
                                <a class="p-2 text-dark" style="background-color: #F0F0F0" href="#">Vestina 2</a>
                                <a class="p-2 text-dark" style="background-color: #F0F0F0" href="#">Vestina 3</a>

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mt-5 text-right">
                                <span class="fa fa-user"></span> Maja Vučković
                                <span class="fas fa-clock ml-4"></span> 43:15 min
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-6">
                            <p><i class="fab fa-youtube ml-2"></i> 3. Tutorijal</p>
                            <div class="mt-3 text-left">
                                <a class="p-2 text-dark" style="background-color: #F0F0F0" href="#">Vestina 1</a>
                                <a class="p-2 text-dark" style="background-color: #F0F0F0" href="#">Vestina 2</a>
                                <a class="p-2 text-dark" style="background-color: #F0F0F0" href="#">Vestina 3</a>

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mt-5 text-right">
                                <span class="fa fa-user"></span> Maja Vučković
                                <span class="fas fa-clock ml-4"></span> 43:15 min
                            </div>
                        </div>
                    </div>

                </div>
                {{-- <div class="tutorial-describe mt-5">
                            <h4 class="tittle text-left text-uppercase text-dark font-weight-bold">Opis kursa</h4><br/>
    
                            <p>Ako tražiš podršku na svom putu ka ispunjenom životu, ličnom i profesionalnom, ako si
                                    na životnoj raskrsnici ili ti se sav teret ovoga sveta sručio na leđa, ako se osećaš kao da
                                    te vrtlog neraspoloženja i neuspeha vuče ka dnu sve više, da ti nedostaje usmerenje ili
                                    neko ko će da ti pomogne da sav taj haos u glavi pretočiš u jasne misli i uspešne akcije
                                    - nastavi sa čitanjem, na pravom si mestu.<br/><br/>
                                    Zovem se Maja, ja sam <b>doktor medicine, psihoterapeut i life coach</b>, majka jednog
                                    tinejdžera i tetka jedne 6-godišnjakinje. Ovo su važne stvari u mom životu.<br/></p>
                    </div> --}}
                <hr>

                {{-- @include('courses.tutorial.comments-display') --}}


                <div class="col-12 text-left">
                    <h3 class="mb-3"><i class="fa fa-comment"></i> Komentari ({{ $comments->count() }}) </h3>

                    @foreach($comments as $comment)
                    
                    <div class="display-comment" @if($comment->parent_id != null) style="margin-left:40px;" @endif>

                        <div class="author-info">
                            <img src="{{ "https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp&f=y" }}"
                                class="author-image mr-4">

                            <div class="author-name ml-3">
                                <h4>{{ $comment->user->name }}</h4>
                                <p class="comment-time">{{ $comment->created_at}}</p>
                            </div>
                        </div>

                        <div class="comment-content ml-5">
                            <div class="row">

                                <div class="col-md-10">
                                    <p class="ml-4 ">{{ $comment->body }}</p>
                                </div>

                                @if($comment->parent_id == null)
                                <div class="col-md-2 m-auto">
                                    <p class="text-right m-auto" id="js-reply"> Reply</p>
                                </div>
                                @endif
                            </div>
                        </div>


                        <form method="post" action="{{ route('comments.store') }}">
                            @csrf
                            <div class="form-group">
                                @if($comment->parent_id == null)
                                <div class="reply-body ml-5">
                                    <input type="text" name="body" placeholder="Vaš komentar.."
                                        class=" ml-4 mb-4 form-control w-50" />
                                </div>

                                @endif
                                <input type="hidden" name="tutorial_id" value="{{$tutorial->id}}" />
                                <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
                            </div>

                        </form>
                        {{-- @include('posts.commentsDisplay', ['comments' => $comment->replies]) --}}
                    </div>
                    @endforeach
                </div>
                <hr>
                <form method="POST" action="{{ route('comments.store') }}" class="mt-4">
                    @csrf
                    <div class="form-group">
                        <textarea rows="5" class="form-control" name="body"></textarea>
                        <input type="hidden" name="tutorial_id" value="{{ $tutorial->id }}" />
                    </div>
                    <div class="form-group text-left">
                        <input type="submit" class="btn btn-success" value="Add Comment" />
                    </div>
                </form>
            </div>

        </div>



        <div class="col-md-4 mt-5">
            <div class="card card-block m-auto">
                <div class="banner">
                    <div class="avatar"></div>
                </div>

                <h3 style="color: rgba(81, 164, 60, 0.801);"> <br /><br /><br />Maja Vučković</h3>
                <p style="text-align: center; font-size: 15px; color: rgba(81, 164, 60, 0.801);;">Psihoterapeut</p>
                <a href="mailto: info@life-leaf.com" style="color: rgba(81, 164, 60, 0.801);"><i
                        class="fas fa-envelope mr-2"></i> info@life-leaf.com</a>
                <a href="" style="color: rgba(81, 164, 60, 0.801);"><i class="fas fa-phone mr-2 "></i> +381 (0)65 35 19
                    563</a>

                <ul>
                    <a href="https://www.twitter.com/___cbrown___" target="_blank"><i class="fab fa-twitter"
                            style="font-size:16px"></i></a>
                    <a href="https://www.linkedin.com/in/-cbrown-" target="_blank"><i class="fab fa-linkedin"
                            style="font-size:16px"></i></a>
                    <a href="https://www.codepen.io/___cbrown___" target="_blank"><i class="fab fa-codepen"
                            style="font-size:16px"></i></a>
                    <a href="https://dribbble.com/___cbrown___" target="_blank"><i class="fab fa-dribbble"
                            style="font-size:16px"></i></a>
                </ul>
            </div>
        </div>
    </div>
</div>




<script>
    $("#js-reply").click(function(){
            

            $(".reply-body").css('display', 'block');
        });    

</script>
@endsection