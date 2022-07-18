<!-- Header -->
<header id="header" class="header">
    <div class="header-top bg-theme-color-2 sm-text-center">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <div class="widget no-border m-0">
              <ul class="list-inline">
                <li class="m-0 pl-10 pr-10"> <i class="fa fa-phone text-white"></i> <a class="text-white" href="#">123-456-789</a> </li>
                <li class="text-white m-0 pl-10 pr-10"> <i class="fa fa-clock-o text-white"></i> Mon-Fri 8:00 to 2:00 </li>
                <li class="m-0 pl-10 pr-10"> <i class="fa fa-envelope-o text-white"></i> <a class="text-white" href="#">contact@yourdomain.com</a> </li>
              </ul>
            </div>
          </div>
          {{-- <div class="col-md-4">
            <div class="widget no-border m-0">
              <ul class="list-inline text-right sm-text-center">
                <li>
                  <a href="#" class="text-white">FAQ</a>
                </li>
                <li class="text-white">|</li>
                <li>
                  <a href="#" class="text-white">Help Desk</a>
                </li>
                <li class="text-white">|</li>
                <li>
                  <a href="#" class="text-white">Support</a>
                </li>
              </ul>
            </div>
          </div> --}}
        </div>
      </div>
    </div>
    <div class="header-nav">
      <div class="header-nav-wrapper navbar-scrolltofixed bg-white">
        <div class="container">
          <nav id="menuzord-right" class="menuzord default">
            <a class="menuzord-brand pull-left flip" href="javascript:void(0)">
              <img src="images/logo-wide.png" alt="">
            </a>
            <ul class="menuzord-menu">
              <li class="active"><a href="{{url('/')}}">Home</a>
              </li>
              <li><a href="#">About</a>
                <ul class="dropdown">
                  <li><a href="{{url('about/about-us')}}">About Us</a></li>
                  <li><a href="{{url('about/founder-info')}}">Founder/Director</a></li>
                  <li><a href="{{url('about/legal-document')}}">Legal Document</a></li>
                  <li><a href="{{url('about/terms-and-condition')}}">Terms & Conditions</a></li>
                  <li><a href="{{url('about/our-policy')}}">Our policy</a></li>
                  <li><a href="{{url('about/more-service')}}">More Services</a></li>
                </ul>
              </li>
              <li><a href="#">What We Do?</a>
                <ul class="dropdown">
                  <li><a href="{{url('home/skill-development-certificate')}}">Skill Development & Certificate Franchies</a></li>
                </ul>
              </li>
              <li><a href="#">Scheme & Initiative</a>
                <ul class="dropdown">
                  <li><a href="{{url('scheme/skill-development-scheme')}}">Skill Development Scheme</a></li>
                      <li><a href="{{url('scheme/pay-after-placement')}}">Pay after Placement</a></li>
                      <li><a href="{{url('scheme/presenting-cum-education-care')}}">Presenting Cum Education care</a></li>
                </ul>
              </li>
              <li><a href="#">New & Info</a>
                <ul class="dropdown">
                  <li><a href="{{url('info/media-promotion')}}">Media & Promotion</a></li>
                  <li><a href="{{url('info/knowledge-hub')}}">Knowledge Hub</a></li>
                  <li><a href="{{url('info/new-letter')}}">New Letter</a></li>
                  <li><a href="{{url('info/career')}}">Career</a></li>
                  <li><a href="{{url('info/update')}}">Update</a></li>
                </ul>
              </li>
              <li><a href="{{url('home/contact-us')}}">Contact us</a>              
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </header>
  
  <!-- Start main-content -->
  <div class="main-content">
    @yield('content')