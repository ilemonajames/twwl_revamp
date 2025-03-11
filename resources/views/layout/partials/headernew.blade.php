<header>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top mask-custom shadow-0">
      <div class="container">
        <a href="/">
            {{-- <img class="logo-main" src="images/logo.webp" alt="" > --}}
            <img src="{{ asset('assets/images/logo.png') }}" class="logo-main" alt="Logo">
            <img class="logo-scroll" src="{{ asset('assets/images/logo_black.png') }}"
                alt="">
            <img class="logo-mobile" src="{{ asset('assets/images/logo_black.png') }}"
                alt="">
        </a>
        <button class="navbar-toggler" type="button" data-mdb-collapse-init
          data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
          aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto">
            <li class="nav-item">
              <a class="nav-link" href="#!">Offer</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#!">Features</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#!">Portfolio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#!">Reference</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#!">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#!">Team</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#!">Contact</a>
            </li>
          </ul>
          <ul class="navbar-nav d-flex flex-row">
            <li class="nav-item me-3 me-lg-0">
              <a class="nav-link" href="#!">
                <i class="fas fa-shopping-cart"></i>
              </a>
            </li>
            <li class="nav-item me-3 me-lg-0">
              <a class="nav-link" href="#!">
                <i class="fab fa-twitter"></i>
              </a>
            </li>
            <li class="nav-item me-3 me-lg-0">
              <a class="nav-link" href="#!">
                <i class="fab fa-instagram"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
   
  </header>