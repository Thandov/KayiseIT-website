<!--Footer-->
<footer>
  <div class="footer-content">
    <div class="top">
      <div class="logo-details">
        <img src="{{ asset('images/Logo_White_No_Background.png') }}" alt="footer_logo" width="116.8px" height="53px">
      </div>
      <div class="media-icons">
        <a href="https://www.facebook.com/KAYISEIT?mibextid=ZbWKwL"><i class="fab fa-facebook-f"></i></a>
        <a href="https://instagram.com/kayiseit?igshid=ZDdkNTZiNTM="><i class="fab fa-instagram"></i></a>
        <a href="https://www.linkedin.com/company/kayise-it/"><i class="fab fa-linkedin-in"></i></a>
        <a href="https://www.youtube.com/channel/UCrAixDqFR92LBqC7OBF3Eqw"><i class="fab fa-youtube"></i></a>
      </div>
    </div>
    <div class="row link-boxes">
      <ul class="col-sm-4">
        <div class="mt-1 text-base">
          <li id="footer-underline" class="link_name mb-3 mt-1 text-base fw-bold smalltxt">Company</li>
        </div>
        <div class="mt-1 text-base">
          <li><a href="/" id="footertxt-white">Home</a></li>
        </div>
        <div class="mt-2 text-base">
          <li><a href="../contact" id="footertxt-white">Contact us</a></li>
        </div>
        <div class="mt-2 text-base">
          <li><a href="../about" id="footertxt-white">About us</a></li>
        </div>
        <div class="mt-2 text-base">
          <li><a href="../services" id="footertxt-white">Get started</a></li>
        </div>
        <div class="mt-2 text-base">
          <li><a href="../terms" id="footertxt-white">Terms & Conditions</a></li>
        </div>
      </ul>
      <ul class="col-sm-4">
        <div>
          <li id="footer-underline" class="link_name mb-3 mt-2 text-base fw-bold smalltxt">Services</li>
        </div>
        <div class="mt-1 text-base">
          <li><a href="services" id="footertxt-white">Office Automation</a></li>
        </div>
        <div class="mt-2 text-base">
          <li><a href="services" id="footertxt-white">Network Support</a></li>
        </div>
        <div class="mt-2 text-base">
          <li><a href="services" id="footertxt-white">Marketing</a></li>
        </div>
        <div class="mt-2 text-base">
          <li><a href="services" id="footertxt-white">ICT Skills training</a></li>
        </div>
      </ul>
      <div class="col-sm-4">
        @if (session('error'))
        <div class="alert alert-danger">
          {{ session('error') }}
        </div>
        @endif
        <form action="{{ route('footer.subscribe') }}" method="post" enctype="multipart/form-data">
          @csrf
          @if (Auth::check())
          <p id="footer-underline" class="mt-1 mb-3 text-base fw-bold smalltxt">Subscribe To Our Newsletter</p>
          <div class="input-group">
            <button type="submit" id="btn-primary" class="inline-flex items-center px-4 py-2 bg-gray-800 border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Subscribe</button>
          </div>
      </div>
      @else
      <p id="footer-underline" class="mt-1 mb-3 text-base fw-bold smalltxt">Subscribe</p>
      <div class="input-group">
        <input type="text" name="email" class="form-control rounded-md border-0" placeholder="Enter your email">
        <button type="submit" id="btn-primary" class="inline-flex items-center px-4 py-2 bg-gray-800 border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Subscribe</button>
      </div>
    </div>
    @endif
    </form>
  </div>
  </div>
  <div class="bottom-details">
    <div class="row align-items-center justify-content-center py-2">
      <div class="col-md-6 col-sm-12 d-flex align-items-center justify-content-center">
        @include('_pop')
      </div>
    </div>
    <div class="row justify-content-center py-2">
      <div class="col-6 d-flex align-items-center justify-content-center">
        <span class="text-white">Copyright © <a href="#">KAYISE IT.</a>All rights reserved</span>
      </div>
    </div>
  </div>
</footer>