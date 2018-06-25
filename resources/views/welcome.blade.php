<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <title>Synapse Software Technologies</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script>window.Laravel = { csrfToken:'{{ csrf_token() }}' }</script>
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/synapse.ico') }}" rel="icon">
  <link href="{{ asset('assets/img/synapse.ico') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="{{ asset('assets/lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="{{ asset('assets/lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/lib/animate/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/lib/magnific-popup/magnific-popup.css') }}" rel="stylesheet">
  

  <!-- Main Stylesheet File -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

  
</head>

<body id="body">
  <div id="app">

  </div>
  <!--==========================
    Top Bar
  ============================-->
  <section id="topbar" class="d-none d-lg-block">
    <div class="container clearfix">
      <div class="contact-info float-left">
        <i class="fa fa-envelope-o"></i> <a href="mailto:{{$setting->email}}">{{$setting->email}}</a>
        <i class="fa fa-phone"></i> {{$setting->phone_number}}
      </div>
      <div class="social-links float-right">
        <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
        <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
        <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
        <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
        <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
      </div>
    </div>
  </section>

  <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <h1><a href="#body" class="scrollto">Syn<span>Softech</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="#body"><img src="img/logo.png" alt="" title="" /></a>-->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="#body">Home</a></li>
          <li><a href="#about">About Us</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#portfolio">Portfolio</a></li>
          <li><a href="#team">Team</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->

  <!--==========================
    Intro Section
  ============================-->
  <section id="intro">

    <div class="intro-content">
      <h3>{{$setting->slogan}}</h3>
      <div>
        <a href="#about" class="btn-get-started scrollto">Get Started</a>
        <a href="#portfolio" class="btn-projects scrollto">Our Projects</a>
      </div>
    </div>

    <div id="intro-carousel" class="owl-carousel" >
        @foreach ($banners as $banner)
        <div class="item" style="background-image: url({{ asset('storage'.$banner->banner_img) }});"></div>  
        @endforeach 
    </div>

  </section><!-- #intro -->

  <main id="main">

    <!--==========================
      About Section
    ============================-->
    <section id="about" class="wow fadeInUp">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 about-img">
          <img src="{{ asset('storage'.$setting->about_img) }}" alt="">
          </div>

          <div class="col-lg-6 content">
            <h2>{{$setting->about_title}}</h2>
            {!! $setting->about_description !!}

          </div>
        </div>

      </div>
    </section><!-- #about -->

    <!--==========================
      Services Section
    ============================-->
    <section id="services">
      <div class="container">
        <div class="section-header">
          <h2>Services</h2>
          <p>{{$setting->services_description}}</p>
        </div>

        <div class="row">
          @foreach($services as $service)
          <div class="col-lg-6">
              <div class="box wow fadeInLeft">
                <div class="icon"><i class="fa {{$service->icon}}"></i></div>
                <h4 class="title"><a href="">{{$service->title}}</a></h4>
                <p class="description">{{$service->description}}</p>
              </div>
            </div>
          @endforeach
        </div>

      </div>
    </section><!-- #services -->

    <!--==========================
      Clients Section
    ============================-->
    <section id="clients" class="wow fadeInUp">
      <div class="container">
        <div class="section-header">
          <h2>Clients</h2>
          <p>{{$setting->clients_description}}</p>
        </div>

        <div class="owl-carousel clients-carousel">
          @foreach($clients as $client)
          <img src="{{ asset('storage'.$client->client_logo) }}" alt="">
          @endforeach
          
        
        </div>

      </div>
    </section><!-- #clients -->

    <!--==========================
      Our Portfolio Section
    ============================-->
    <section id="portfolio" class="wow fadeInUp">
      <div class="container">
        <div class="section-header">
          <h2>Our Portfolio</h2>
          <p>{{$setting->portfolio_description}}</p>
        </div>
      </div>

      <div class="container-fluid">
        <div class="row no-gutters">
          @foreach($portfolios as $portfolio)
          <div class="col-lg-3 col-md-4">
              <div class="portfolio-item wow fadeInUp">
                <a href="{{ asset('storage'.$portfolio->portfolio_img) }}" class="portfolio-popup">
                  <img src="{{ asset('storage'.$portfolio->portfolio_img) }}" alt="">
                  <div class="portfolio-overlay">
                  <div class="portfolio-info"><h2 class="wow fadeInUp">{{$portfolio->title}}</h2></div>
                  </div>
                </a>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section><!-- #portfolio -->

    <!--==========================
      Testimonials Section
    ============================-->
    <section id="testimonials" class="wow fadeInUp">
      <div class="container">
        <div class="section-header">
          <h2>Testimonials</h2>
          <p>{{$setting->testimonials_description}}</p>
        </div>
        <div class="owl-carousel testimonials-carousel">
            @foreach($testimonials as $testimonial)
            <div class="testimonial-item">
                <p>
                  <img src="{{ asset('storage/images/quote-sign-left.png') }}" class="quote-sign-left" alt="">
                  {{$testimonial->message}}
                  <img src="{{ asset('storage/images/quote-sign-right.png') }}" class="quote-sign-right" alt="">
                </p>
                <img src="{{ asset('storage'.$testimonial->photo) }}" class="testimonial-img" alt="">
                <h3>{{$testimonial->name}}</h3>
                <h4>{{$testimonial->designation}}</h4>
              </div>
            @endforeach

        </div>

      </div>
    </section><!-- #testimonials -->

    {{-- <!--==========================
      Call To Action Section
    ============================-->
    <section id="call-to-action" class="wow fadeInUp">
      <div class="container">
        <div class="row">
          <div class="col-lg-9 text-center text-lg-left">
            <h3 class="cta-title">Call To Action</h3>
            <p class="cta-text">{{$setting->call_to_action}}</p>
          </div>
          <div class="col-lg-3 cta-btn-container text-center">
            <a class="cta-btn align-middle" href="#">Call To Action</a>
          </div>
        </div>

      </div>
    </section><!-- #call-to-action --> --}}

    <!--==========================
      Our Team Section
    ============================-->
    <section id="team" class="wow fadeInUp">
      <div class="container">
        <div class="section-header">
          <h2>Our Team</h2>
        </div>
        <div class="row">
          @foreach($team_members as $team_member)
          <div class="col-lg-3 col-md-6">
              <div class="member">
                <div class="pic"><img src="{{ asset('storage'.$team_member->photo) }}" alt=""></div>
                <div class="details">
                  <h4>{{$team_member->name}}</h4>
                  <span>{{$team_member->designation}}</span>
                  <div class="social">
                    <a href="{{$team_member->twitter_account}}" target="_blank"><i class="fa fa-twitter"></i></a>
                    <a href="{{$team_member->facebook_account}}" target="_blank"><i class="fa fa-facebook"></i></a>
                    <a href="{{$team_member->google_account}}" target="_blank"><i class="fa fa-google-plus"></i></a>
                    <a href="{{$team_member->linkedin_account}}" target="_blank"><i class="fa fa-linkedin"></i></a>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>

      </div>
    </section><!-- #team -->

    <!--==========================
      Contact Section
    ============================-->
    <section id="contact" class="wow fadeInUp">
      <div class="container">
        <div class="section-header">
          <h2>Contact Us</h2>
          <p>{{$setting->contact_us_description}}</p>
        </div>

        <div class="row contact-info">

          <div class="col-md-4">
            <div class="contact-address">
              <i class="ion-ios-location-outline"></i>
              <h3>Address</h3>
              <address>{{$setting->address}}</address>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-phone">
              <i class="ion-ios-telephone-outline"></i>
              <h3>Phone Number</h3>
              <p><a href="tel:+155895548855">{{$setting->phone_number}}</a></p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-email">
              <i class="ion-ios-email-outline"></i>
              <h3>Email</h3>
              <p><a href="mailto:info@example.com">{{$setting->email}}</a></p>
            </div>
          </div>

        </div>
      </div>

      
      <div class="container">
        <div class="form">
          <div id="sendmessage">Your message has been sent. Thank you!</div>
          <div id="errormessage"></div>
          <form action="" method="post" role="form" class="contactForm">
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                <div class="validation"></div>
              </div>
              <div class="form-group col-md-6">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                <div class="validation"></div>
              </div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
              <div class="validation"></div>
            </div>
            <div class="form-group">
              <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
              <div class="validation"></div>
            </div>
            <div class="text-center"><button type="submit">Send Message</button></div>
          </form>
        </div>

      </div>
    </section><!-- #contact -->

  </main>

  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>Synapse Software Technologies</strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!--
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Reveal
        -->
        {{-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> --}}
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="{{ asset('assets/lib/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/lib/jquery/jquery-migrate.min.js') }}"></script>
  <script src="{{ asset('assets/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/lib/easing/easing.min.js') }}"></script>
  <script src="{{ asset('assets/lib/superfish/hoverIntent.js') }}"></script>
  <script src="{{ asset('assets/lib/wow/wow.min.js') }}"></script>
  <script src="{{ asset('assets/lib/superfish/superfish.min.js') }}"></script>
  <script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('assets/lib/magnific-popup/magnific-popup.min.js') }}"></script>
  <script src="{{ asset('assets/lib/sticky/sticky.js') }}"></script>
  <!-- Contact Form JavaScript File -->
  <script src="{{ asset('assets/js/contactform.js') }}"></script>

  <!-- Template Main Javascript File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
