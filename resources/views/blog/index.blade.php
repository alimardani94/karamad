@extends('front/layout/base')

@section('title', 'مجله')

@section('header')
    @include('header.header1', ['headerBG' => asset('assets/img/slider/3.jpg')])
@stop

@section('style')

@endsection

@section('content')

    <section>
        <div class="container-fluid grey lighten-4">
            <hr class="my-5">
            <div class="container">

                <!-- Blog -->
                <div class="row mt-5 pt-3">

                    <!-- Main listing -->
                    <div class="col-lg-8 col-12 mt-1 mx-lg-4">

                        <!-- Section: Blog v.3 -->
                        <section class="pb-3 text-center text-lg-left">

                            @foreach($posts as $post)
                                <div class="row mb-4">

                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="view overlay">
                                                <img src="{{ asset('media/' . $post->image) }}"
                                                     class="card-img-top"
                                                     alt="{{$post->title}}">
                                                <a>
                                                    <div class="mask rgba-white-slight"></div>
                                                </a>
                                            </div>

                                            <div class="card-body mx-4">
                                                <h4 class="card-title">
                                                    <strong>{{$post->title}}</strong>
                                                </h4>
                                                <hr>
                                                <!-- Text -->
                                                <p class="dark-grey-text mb-4"> Disrupt vero ea id fugiat, lo-fi lomo
                                                    post-ironic irony kitsch
                                                    Banksy.
                                                    Tumblr kale stumptown beer elit seitan tote bag Banksy, elit small
                                                    batch fregan sed.
                                                </p>
                                                <p class="font-small font-weight-bold blue-grey-text mb-1">
                                                    <i class="far fa-clock-o"></i> {{ jDate($post->created_at, 'dd MMMM yyyy') }} </p>
                                                <p class="font-small dark-grey-text mb-0 font-weight-bold">Anna Smith</p>
                                                <p class="text-right mb-0 text-uppercase dark-grey-text font-weight-bold">
                                                    <a href="{{route('posts.show', ['post' => $post->id])}}">
                                                        بیشتر
                                                        <i class="fas fa-chevron-right" aria-hidden="true"></i>
                                                    </a>
                                                </p>
                                            </div>
                                            <!-- Card content -->

                                        </div>
                                        <!-- Card -->

                                    </div>
                                    <!-- Grid column -->

                                </div>
                            @endforeach
                        </section>
                        <!-- Section: Blog v.3 -->

                        <!-- Pagination dark grey -->
                        <nav class="mb-5 pb-2">
                            <ul class="pagination pg-darkgrey flex-center">
                                <!-- Arrow left -->
                                <li class="page-item">
                                    <a class="page-link" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>

                                <!-- Numbers -->
                                <li class="page-item active">
                                    <a class="page-link">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link">4</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link">5</a>
                                </li>

                                <!-- Arrow right -->
                                <li class="page-item">
                                    <a class="page-link" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <!-- Pagination dark grey -->

                    </div>
                    <!-- Main listing -->

                    <!-- Sidebar -->
                    <div class="col-lg-3 col-12 mt-1">

                        <!-- Card -->
                        <div class="card">

                            <!-- Card image -->
                            <div class="view overlay">
                                <img src="https://mdbootstrap.com/img/Photos/Others/images/20.jpg" class="card-img-top"
                                     alt="">
                                <a>
                                    <div class="mask rgba-white-slight"></div>
                                </a>
                            </div>
                            <!-- Card image -->

                            <!-- Card content -->
                            <div class="card-body">
                                <!-- Title -->
                                <h5 class="card-title dark-grey-text text-center grey lighten-4 py-2">
                                    <strong>Anna Doe</strong>
                                </h5>

                                <!-- Description -->
                                <p class="mt-3 dark-grey-text font-small text-center">
                                    <em>Hello, I'm Anna. I love travel around the world and take photos of landscapes
                                        and
                                        local people.</em>
                                </p>

                                <ul class="list-unstyled list-inline-item circle-icons list-unstyled flex-center">
                                    <!-- Facebook -->
                                    <li>
                                        <a class="fb-ic">
                                            <i class="fab fa-facebook-f"> </i>
                                        </a>
                                    </li>
                                    <!-- Twitter -->
                                    <li>
                                        <a class="tw-ic">
                                            <i class="fab fa-twitter mx-3"> </i>
                                        </a>
                                    </li>
                                    <!-- Google + -->
                                    <li>
                                        <a class="gplus-ic">
                                            <i class="fab fa-google-plus-g"> </i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Card content -->

                        </div>
                        <!-- Card -->

                        <!-- Section: Featured posts -->
                        <section class="section widget-content mt-5">

                            <!--  Card -->
                            <div class="card card-body pb-0">
                                <div class="single-post">

                                    <p class="font-weight-bold dark-grey-text text-center spacing grey lighten-4 py-2 mb-4">
                                        <strong>POPULAR POSTS</strong>
                                    </p>

                                    <!-- Grid row -->
                                    <div class="row mb-4">
                                        <div class="col-5">

                                            <!-- Image -->
                                            <div class="view overlay">
                                                <img src="https://mdbootstrap.com/img/Photos/Others/photo13.jpg"
                                                     class="img-fluid z-depth-1 rounded-0" alt="sample image">
                                                <a>
                                                    <div class="mask waves-light"></div>
                                                </a>
                                            </div>
                                        </div>

                                        <!-- Excerpt -->
                                        <div class="col-7">
                                            <h6 class="mt-0 font-small">
                                                <a>
                                                    <strong>Title of the news</strong>
                                                </a>
                                            </h6>

                                            <div class="post-data">
                                                <p class="font-small grey-text mb-0">
                                                    <i class="far fa-clock-o"></i> 18/08/2017</p>
                                            </div>
                                        </div>
                                        <!--  Excerpt -->
                                    </div>
                                    <!--  Grid row -->
                                </div>

                                <div class="single-post">
                                    <!-- Grid row -->
                                    <div class="row mb-4">
                                        <div class="col-5">

                                            <!-- Image -->
                                            <div class="view overlay">
                                                <img src="https://mdbootstrap.com/img/Photos/Others/photo12.jpg"
                                                     class="img-fluid z-depth-1 rounded-0" alt="sample image">
                                                <a>
                                                    <div class="mask waves-light"></div>
                                                </a>
                                            </div>
                                        </div>

                                        <!-- Excerpt -->
                                        <div class="col-7">
                                            <h6 class="mt-0 font-small">
                                                <a>
                                                    <strong>Title of the news</strong>
                                                </a>
                                            </h6>

                                            <div class="post-data">
                                                <p class="font-small grey-text mb-0">
                                                    <i class="far fa-clock-o"></i> 18/08/2017</p>
                                            </div>
                                        </div>
                                        <!--  Excerpt -->
                                    </div>
                                    <!--  Grid row -->
                                </div>

                                <div class="single-post">
                                    <!-- Grid row -->
                                    <div class="row mb-4">
                                        <div class="col-5">

                                            <!-- Image -->
                                            <div class="view overlay">
                                                <img src="https://mdbootstrap.com/img/Photos/Others/photo10.jpg"
                                                     class="img-fluid z-depth-1 rounded-0" alt="sample image">
                                                <a>
                                                    <div class="mask waves-light"></div>
                                                </a>
                                            </div>
                                        </div>

                                        <!-- Excerpt -->
                                        <div class="col-7">
                                            <h6 class="mt-0 font-small">
                                                <a>
                                                    <strong>Title of the news</strong>
                                                </a>
                                            </h6>

                                            <div class="post-data">
                                                <p class="font-small grey-text mb-0">
                                                    <i class="far fa-clock-o"></i> 18/08/2017</p>
                                            </div>
                                        </div>
                                        <!--  Excerpt -->
                                    </div>
                                    <!--  Grid row -->
                                </div>

                                <div class="single-post">
                                    <!-- Grid row -->
                                    <div class="row mb-4">
                                        <div class="col-5">

                                            <!-- Image -->
                                            <div class="view overlay">
                                                <img src="https://mdbootstrap.com/img/Photos/Others/photo15.jpg"
                                                     class="img-fluid z-depth-1 rounded-0" alt="sample image">
                                                <a>
                                                    <div class="mask waves-light"></div>
                                                </a>
                                            </div>
                                        </div>

                                        <!-- Excerpt -->
                                        <div class="col-7">
                                            <h6 class="mt-0 font-small">
                                                <a>
                                                    <strong>Title of the news</strong>
                                                </a>
                                            </h6>

                                            <div class="post-data">
                                                <p class="font-small grey-text mb-0">
                                                    <i class="far fa-clock-o"></i> 18/08/2017</p>
                                            </div>
                                        </div>
                                        <!--  Excerpt -->
                                    </div>
                                    <!--  Grid row -->
                                </div>

                                <div class="single-post">
                                    <!-- Grid row -->
                                    <div class="row mb-4">
                                        <div class="col-5">

                                            <!-- Image -->
                                            <div class="view overlay">
                                                <img src="https://mdbootstrap.com/img/Photos/Others/photo9.jpg"
                                                     class="img-fluid z-depth-1 rounded-0" alt="sample image">
                                                <a>
                                                    <div class="mask waves-light"></div>
                                                </a>
                                            </div>
                                        </div>

                                        <!-- Excerpt -->
                                        <div class="col-7">
                                            <h6 class="mt-0 font-small">
                                                <a>
                                                    <strong>Title of the news</strong>
                                                </a>
                                            </h6>

                                            <div class="post-data">
                                                <p class="font-small grey-text mb-0">
                                                    <i class="far fa-clock-o"></i> 18/08/2017</p>
                                            </div>
                                        </div>
                                        <!--  Excerpt -->
                                    </div>
                                    <!--  Grid row -->

                                </div>
                            </div>
                        </section>
                        <!--  Section: Featured posts -->

                        <!-- Newsletter -->
                        <section class="my-5">

                            <!--  Card -->
                            <div class="card card-body pb-0">
                                <div class="single-post">

                                    <p class="font-weight-bold dark-grey-text text-center spacing grey lighten-4 py-2 mb-4">
                                        <strong>NEWSLETTER</strong>
                                    </p>

                                    <!-- Grid row -->
                                    <div class="row mt-4">

                                        <!-- Grid column -->
                                        <div class="col-md-12">

                                            <div class="input-group md-form form-sm form-3 pl-0">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text white black-text"
                                                          id="basic-addon9">@</span>
                                                </div>
                                                <input type="text"
                                                       class="form-control mt-0 black-border rgba-white-strong"
                                                       placeholder="Username" aria-describedby="basic-addon9">
                                            </div>

                                            <button type="button" class="btn btn-grey btn-block my-4">Sign up</button>

                                        </div>
                                        <!-- Grid column -->

                                    </div>
                                    <!-- Grid row -->

                                </div>
                            </div>

                        </section>
                        <!-- Newsletter -->

                        <!-- Archive -->
                        <section class="archive mb-5">

                            <!--  Card -->
                            <div class="card card-body pb-0">
                                <div class="single-post">

                                    <p class="font-weight-bold dark-grey-text text-center spacing grey lighten-4 py-2 mb-4">
                                        <strong>ARCHIVE</strong>
                                    </p>

                                    <!-- Grid row -->
                                    <div class="row mb-4">

                                        <!-- Grid column -->
                                        <div class="col-md-12 text-center">

                                            <!-- List -->
                                            <ul class="list-unstyled">
                                                <li>
                                                    <p class="mb-1">
                                                        <a href="#!" class="dark-grey-text">August 2016</a>
                                                    </p>
                                                </li>
                                                <li>
                                                    <p class="mb-1">
                                                        <a href="#!" class="dark-grey-text">July 2016</a>
                                                    </p>
                                                </li>
                                                <li>
                                                    <p class="mb-1">
                                                        <a href="#!" class="dark-grey-text">June 2016</a>
                                                    </p>
                                                </li>
                                                <li>
                                                    <p class="mb-1">
                                                        <a href="#!" class="dark-grey-text">May 2016</a>
                                                    </p>
                                                </li>
                                                <li>
                                                    <p class="mb-1">
                                                        <a href="#!" class="dark-grey-text">April 2016</a>
                                                    </p>
                                                </li>
                                                <li>
                                                    <p class="mb-1">
                                                        <a href="#!" class="dark-grey-text">March 2016</a>
                                                    </p>
                                                </li>
                                                <li>
                                                    <p class="mb-1">
                                                        <a href="#!" class="dark-grey-text">Febuary 2016</a>
                                                    </p>
                                                </li>
                                            </ul>
                                            <!-- List -->

                                        </div>
                                        <!-- Grid column -->

                                    </div>
                                    <!-- Grid row -->

                                </div>

                            </div>
                            <!--  Card -->

                        </section>
                        <!-- Archive -->

                        <!-- Popular posts -->
                        <section class="mb-4">

                            <!-- Grid row -->
                            <div class="row mt-4">

                                <!-- Grid column -->
                                <div class="col-md-12 col-lg-12">

                                    <!-- Card -->
                                    <div class="card text-left mb-3">

                                        <!-- Card image -->
                                        <div class="view overlay">
                                            <div class="embed-responsive embed-responsive-16by9">
                                                <iframe class="embed-responsive-item"
                                                        src="https://www.youtube.com/embed/v64KOxKVLVg"
                                                        allowfullscreen></iframe>
                                            </div>
                                            <a>
                                                <div class="mask rgba-white-slight"></div>
                                            </a>
                                        </div>
                                        <!-- Card image -->

                                        <!-- Card content -->
                                        <div class="card-body mx-2">

                                            <!-- Title -->
                                            <a>
                                                <h5 class="card-title text-center my-2">
                                                    <strong>Visit my YouTube channel!</strong>
                                                </h5>
                                            </a>

                                        </div>
                                        <!-- Card content -->

                                    </div>
                                    <!-- Card -->
                                </div>
                                <!-- Grid column -->

                            </div>
                            <!-- Grid row -->

                        </section>
                        <!-- Popular posts -->

                        <!-- Section: Categories -->
                        <section class="section mb-5">

                            <!-- Card -->
                            <div class="card card-body pb-0">
                                <div class="single-post">

                                    <p class="font-weight-bold dark-grey-text text-center spacing grey lighten-4 py-2 mb-4">
                                        <strong>CATEGORIES</strong>
                                    </p>

                                    <ul class="list-group my-4">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <a class="">
                                                <p class="mb-0">Travel</p>
                                            </a>
                                            <span class="badge teal badge-pill font-small">4</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <a class="">
                                                <p class="mb-0">Lifestyle</p>
                                            </a>
                                            <span class="badge teal badge-pill">2</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <a class="">
                                                <p class="mb-0">Photography</p>
                                            </a>
                                            <span class="badge teal badge-pill">1</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <a class="">
                                                <p class="mb-0">Culinary</p>
                                            </a>
                                            <span class="badge teal badge-pill">2</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <a class="">
                                                <p class="mb-0">Fashion</p>
                                            </a>
                                            <span class="badge teal badge-pill">1</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <a class="">
                                                <p class="mb-0">Work</p>
                                            </a>
                                            <span class="badge teal badge-pill">2</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <a class="">
                                                <p class="mb-0">Business</p>
                                            </a>
                                            <span class="badge teal badge-pill">5</span>
                                        </li>
                                    </ul>
                                </div>

                            </div>

                        </section>
                        <!-- Section: Categories -->

                        <!-- Featured posts -->
                        <section class="mb-5">

                            <!-- Grid row -->
                            <div class="row mt-4">
                                <!-- Grid column -->
                                <div class="col-md-12">

                                    <!-- Carousel Wrapper -->
                                    <div id="carousel-example-4" class="carousel slide carousel-fade z-depth-1-half"
                                         data-ride="carousel">
                                        <!-- Indicators -->
                                        <ol class="carousel-indicators">
                                            <li data-target="#carousel-example-4" data-slide-to="0" class="active"></li>
                                            <li data-target="#carousel-example-4" data-slide-to="1"></li>
                                            <li data-target="#carousel-example-4" data-slide-to="2"></li>
                                        </ol>
                                        <!-- Indicators -->

                                        <!-- Slides -->
                                        <div class="carousel-inner" role="listbox">
                                            <!-- First slide -->
                                            <div class="carousel-item active">
                                                <!-- Mask color -->
                                                <div class="view">
                                                    <img
                                                        src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/8-col/img%20(126).jpg"
                                                        class="img-fluid" alt="">
                                                    <a href="#!">
                                                        <div class="mask flex-center rgba-stylish-strong"></div>
                                                    </a>
                                                </div>
                                                <!-- Caption -->
                                                <div class="carousel-caption">
                                                    <div class="animated fadeInDown">
                                                        <h4 class="h4-responsive">
                                                            <a href="#!" class="white-text font-weight-bold">Your
                                                                health</a>
                                                        </h4>
                                                        <p>
                                                            <a href="#!" class="white-text">Lorem ipsum</a>
                                                        </p>
                                                    </div>
                                                </div>
                                                <!-- Caption -->
                                            </div>
                                            <!-- First slide -->

                                            <!-- Second slide -->
                                            <div class="carousel-item">
                                                <!-- Mask color -->
                                                <div class="view">
                                                    <img
                                                        src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/8-col/img%20(128).jpg"
                                                        class="img-fluid" alt="">
                                                    <a href="#!">
                                                        <div class="mask flex-center rgba-black-light"></div>
                                                    </a>
                                                </div>
                                                <!-- Caption -->
                                                <div class="carousel-caption">
                                                    <div class="animated fadeInDown">
                                                        <h4 class="h4-responsive">
                                                            <a href="#!" class="white-text font-weight-bold">News
                                                                title</a>
                                                        </h4>
                                                        <p>
                                                            <a href="#!" class="white-text">Lorem ipsum</a>
                                                        </p>
                                                    </div>
                                                </div>
                                                <!-- Caption -->
                                            </div>
                                            <!-- Second slide -->

                                            <!-- Third slide -->
                                            <div class="carousel-item">
                                                <!-- Mask color -->
                                                <div class="view">
                                                    <img
                                                        src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/8-col/img%20(133).jpg"
                                                        class="img-fluid" alt="">
                                                    <a href="#!">
                                                        <div class="mask flex-center rgba-black-light"></div>
                                                    </a>
                                                </div>
                                                <!-- Caption -->
                                                <div class="carousel-caption">
                                                    <div class="animated fadeInDown">
                                                        <h4 class="h4-responsive">
                                                            <a href="#!" class="white-text font-weight-bold">News
                                                                title</a>
                                                        </h4>
                                                        <p>
                                                            <a href="#!" class="white-text">Lorem ipsum</a>
                                                        </p>
                                                    </div>
                                                </div>
                                                <!-- Caption -->
                                            </div>
                                            <!-- Third slide -->
                                        </div>
                                        <!-- Slides -->

                                        <!-- Controls -->
                                        <a class="carousel-control-prev" href="#carousel-example-4" role="button"
                                           data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carousel-example-4" role="button"
                                           data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                        <!-- Controls -->
                                    </div>
                                    <!-- Carousel Wrapper -->

                                </div>
                                <!-- Grid column -->

                            </div>
                            <!-- Grid row -->

                        </section>
                        <!-- Featured posts -->

                    </div>
                    <!-- Sidebar -->

                </div>
                <!-- Blog -->

            </div>

        </div>

    </section>
    <!-- Blog section -->

    <!-- Latest posts -->
    <section>
        <div class="container-fluid white mb-0 pb-0">
            <hr class="mt-0">
            <div class="container">
                <!-- Grid row -->
                <div class="row">

                    <!-- Grid column -->
                    <div class="col-lg-4 col-md-12">
                        <h6 class="font-weight-bold mt-5 mb-3">ABOUT</h6>
                        <hr class="mb-5">
                        <img src="https://mdbootstrap.com/img/Photos/Slides/img (37).jpg" alt="sample image"
                             class="img-fluid z-depth-1">
                        <p class="mt-4 mb-5">Sed ut in perspiciatis unde omnis iste natus error sit on i tatem
                            accusantium
                            doloremque laudantium,
                            totam rem aperiam, eaque ipsa quae.</p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-lg-4 col-md-6">
                        <h6 class="font-weight-bold mt-5 mb-3">LATESTS POSTS</h6>
                        <hr class="mb-5">
                        <!-- Grid row -->
                        <div class="row mt-4">

                            <!-- Grid column -->
                            <div class="col-4">

                                <!-- Image -->
                                <div class="view overlay z-depth-1 mb-3">
                                    <img src="https://mdbootstrap.com/img/Photos/Others/photo12.jpg" class="img-fluid"
                                         alt="Post">
                                    <a>
                                        <div class="mask rgba-white-slight"></div>
                                    </a>
                                </div>

                            </div>
                            <!-- Grid column -->

                            <!-- Second column -->
                            <div class="col-8 mb-1">

                                <!-- Post data -->
                                <div class="">
                                    <p class="mb-1">
                                        <a href="#!" class="text-hover font-weight-bold">Sed ut in perspiciatis unde
                                            omnis</a>
                                    </p>
                                    <p class="font-small grey-text">
                                        <em>July 22, 2017</em>
                                    </p>
                                </div>

                            </div>
                            <!-- Second column -->

                        </div>
                        <!-- Grid row -->

                        <!-- Grid row -->
                        <div class="row">

                            <!-- Grid column -->
                            <div class="col-4">

                                <!-- Image -->
                                <div class="view overlay z-depth-1 mb-3">
                                    <img src="https://mdbootstrap.com/img/Photos/Others/photo11.jpg" class="img-fluid"
                                         alt="Post">
                                    <a>
                                        <div class="mask rgba-white-slight"></div>
                                    </a>
                                </div>

                            </div>
                            <!-- Grid column -->

                            <!-- Second column -->
                            <div class="col-7 mb-1">

                                <!-- Post data -->
                                <div class="">
                                    <p class="mb-1">
                                        <a href="#!" class="text-hover font-weight-bold">At vero eos et accusamus
                                            et </a>
                                    </p>
                                    <p class="font-small grey-text">
                                        <em>July 22, 2017</em>
                                    </p>

                                </div>

                            </div>
                            <!-- Second column -->

                        </div>
                        <!-- Grid row -->

                        <!-- Grid row -->
                        <div class="row">

                            <!-- Grid column -->
                            <div class="col-4">

                                <!-- Image -->
                                <div class="view overlay z-depth-1 mb-3">
                                    <img src="https://mdbootstrap.com/img/Photos/Others/photo15.jpg" class="img-fluid"
                                         alt="Post">
                                    <a>
                                        <div class="mask rgba-white-slight"></div>
                                    </a>
                                </div>

                            </div>
                            <!-- Grid column -->

                            <!-- Second column -->
                            <div class="col-7 mb-1">

                                <!-- Post data -->
                                <div class="">
                                    <p class="mb-1">
                                        <a href="#!" class="text-hover font-weight-bold">Nemo enim ipsam voluptatem</a>
                                    </p>
                                    <p class="font-small grey-text">
                                        <em>July 22, 2017</em>
                                    </p>
                                </div>

                            </div>
                            <!-- Second column -->

                        </div>
                        <!-- Grid row -->

                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-lg-4 col-md-6">
                        <h6 class="font-weight-bold mt-5 mb-3">OLDER POSTS</h6>
                        <hr class="mb-5">

                        <!-- Grid row -->
                        <div class="row mt-4">

                            <!-- Grid column -->
                            <div class="col-4">

                                <!-- Image -->
                                <div class="view overlay z-depth-1 mb-3">
                                    <img src="https://mdbootstrap.com/img/Photos/Others/photo1.jpg" class="img-fluid"
                                         alt="Post">
                                    <a>
                                        <div class="mask rgba-white-slight"></div>
                                    </a>
                                </div>

                            </div>
                            <!-- Grid column -->

                            <!-- Second column -->
                            <div class="col-8 mb-1">

                                <!-- Post data -->
                                <div class="">
                                    <p class="mb-1">
                                        <a href="#!" class="text-hover font-weight-bold">Sed ut in perspiciatis unde
                                            omnis</a>
                                    </p>
                                    <p class="font-small grey-text">
                                        <em>July 22, 2017</em>
                                    </p>
                                </div>

                            </div>
                            <!-- Second column -->

                        </div>
                        <!-- Grid row -->

                        <!-- Grid row -->
                        <div class="row">

                            <!-- Grid column -->
                            <div class="col-4">

                                <!-- Image -->
                                <div class="view overlay z-depth-1 mb-3">
                                    <img src="https://mdbootstrap.com/img/Photos/Others/photo9.jpg" class="img-fluid"
                                         alt="Post">
                                    <a>
                                        <div class="mask rgba-white-slight"></div>
                                    </a>
                                </div>

                            </div>
                            <!-- Grid column -->

                            <!-- Second column -->
                            <div class="col-7 mb-1">

                                <!-- Post data -->
                                <div class="">
                                    <p class="mb-1">
                                        <a href="#!" class="text-hover font-weight-bold">At vero eos et accusamus
                                            et </a>
                                    </p>
                                    <p class="font-small grey-text">
                                        <em>July 22, 2017</em>
                                    </p>
                                </div>

                            </div>
                            <!-- Second column -->

                        </div>
                        <!-- Grid row -->

                        <!-- Grid row -->
                        <div class="row">

                            <!-- Grid column -->
                            <div class="col-4">

                                <!-- Image -->
                                <div class="view overlay z-depth-1 mb-3">
                                    <img src="https://mdbootstrap.com/img/Photos/Others/photo4.jpg" class="img-fluid"
                                         alt="Post">
                                    <a>
                                        <div class="mask rgba-white-slight"></div>
                                    </a>
                                </div>

                            </div>
                            <!-- Grid column -->

                            <!-- Second column -->
                            <div class="col-7 mb-1">

                                <!-- Post data -->
                                <div class="">
                                    <p class="mb-1">
                                        <a href="#!" class="text-hover font-weight-bold">Nemo enim ipsam voluptatem</a>
                                    </p>
                                    <p class="font-small grey-text">
                                        <em>July 22, 2017</em>
                                    </p>
                                </div>

                            </div>
                            <!-- Second column -->

                        </div>
                        <!-- Grid row -->

                    </div>
                    <!-- Grid column -->

                </div>
                <!-- Grid row -->

            </div>
        </div>

    </section>


@endsection

@section('js')

@endsection

@section('footer')
    @include('footer.footer2')
@stop
