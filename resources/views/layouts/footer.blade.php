<!--Footer-->
<footer>
    <div class="footer-content">
      <div class="top">
        <div class="logo-details">
          <img src="./images/Logo_White_No_Background.png" alt="footer_logo" width="116.8px" height="53px">
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
                <div class="mt-1 fs-6">
                    <li class="link_name mt-1 fs-6 fw-bold" style = "color:#183ea4">Company</li>
                </div>
                <div class="mt-1 fs-6">
                    <li><a href="/"style="color: #ffffff" class="text-decoration-underline">Home</a></li>
                </div>
                <div class="mt-1 fs-6">
                    <li><a href="contact"  style="color: #ffffff">Contact us</a></li>
                </div>
                <div class="mt-1 fs-6">
                    <li><a href="about" style="color: #ffffff">About us</a></li>
                </div>
                <div class="mt-1 fs-6">
                    <li><a href="services" style="color: #ffffff">Get started</a></li>
                </div>
                <div class="mt-1 fs-6">
                    <li><a href="#" style="color: #ffffff">Privacy Policy</a></li>
                </div>
            </ul>
            <ul class="col-sm-4">
                <div>
                    <li class="link_name mt-2 fs-6 fw-bold" style="color:#183ea4">Services</li>
                </div>
                <div class="mt-1 fs-6">
                    <li><a href="services" style="color: #ffffff">Office Automation</a></li>
                </div >
                <div class="mt-1 fs-6">
                    <li><a href="services" style="color: #ffffff">Network Support</a></li>
                </div>
                <div class="mt-1 fs-6">
                    <li><a href="services" style="color: #ffffff">Marketing</a></li>
                </div>
                <div class="mt-1 fs-6">
                    <li><a href="services" style="color: #ffffff">ICT Skills training</a></li>
                </div>
            </ul>
          <div class="col-sm-4">
          <form action="{{ route('footer.subscribe') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if (Auth::check())
          <p class="mt-1 fs-6 fw-bold" style = "color:#183ea4">Subscribe</p>
            <div class="input-group">
                <button class="btn shadow-lg text-white btn-block " type="button" id="button-addon2">Button</button>
            </div>
          </div>
          @else
          <p class="mt-1 fs-6 fw-bold" style = "color:#183ea4">Subscribe</p>
            <div class="input-group">
                
                <input type="text" class="form-control" placeholder="Your Email"
                    aria-label="Your Email" aria-describedby="button-addon2">
                <button class="btn shadow-lg text-white btn-block " type="button" id="button-addon2">Button</button>
            </div>
          </div>
          @endif
        </form>

          <!--<ul class="box input-box">
        <form action="{{ route('footer.subscribe') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if (Auth::check())
          <li class="link_name">Click To Subscribe To Newsletter</li>
          <li><button type="submit" style="background-color: #4070f4" class="btn shadow-lg text-white btn-block">Subscribe</button></li>
          @else
          <li class="link_name">Subscribe</li>
          <li><input type="text" name="email" class="form-control" placeholder="Enter your email"></li>
          <li><button type="submit" style="background-color: #4070f4" class="btn shadow-lg text-white btn-block">Subscribe</button></li>
          @endif
        </form>
        </ul>-->
            
      </div>
    </div>

    <div class="bottom-details">
    <div class="row align-items-center justify-content-center py-2">
        
        <div class="col-md-6 col-sm-12 d-flex align-items-center justify-content-center">
            <div class="d-flex justify-content-center align-items-center">
                <div class=" mr-4"><img src="./images/Payment Methods (Footer)/Visa.png" alt="Visa"
                        Width="45" height="45"></div>
                <div class=" mr-4"><img
                        src="./images/Payment Methods (Footer)/Verified-by-Visa.png" alt="Verified by Visa"
                        Width="45" height="45"></div>
                <div class=" mr-4"><img
                        src="./images/Payment Methods (Footer)/PayGate-Payment-Method-Logo-American-Express.png"
                        alt="American Express" Width="45" height="45"></div>
                <div class="mr-4"><img
                        src="./images/Payment Methods (Footer)/PayGate-Card-Brand-Logo-MasterCard.png"
                        alt="MasterCard" Width="45" height="45"></div>
                <div class=""><img
                        src="./images/Payment Methods (Footer)/MasterCard-SecureCode.png"
                        alt="MasterCard SecureCode" Width="45" height="45"></div>
            </div>
        </div>
        
    </div>

    <div class="row justify-content-center py-2">
    <div class="col-6 d-flex align-items-center justify-content-center">
            <span  class="copyright_text text-white">Copyright © <a href="#">KAYISE IT.</a>All rights
                reserved</span>
        </div>
    </div>
    </div>
  </footer>

<style>
            
/* ==================================== footer ==================================== */

footer{
  position: relative;
  background: #64bc5c;
  width: 100%;
  bottom: 0;
  left: 0;
}
footer::before{
  content: '';
  position: absolute;
  left: 0;
  top: 100px;
  height: 1px;
  width: 100%;
  background: #AFAFB6;
}
footer .footer-content{
  max-width: 1250px;
  margin: auto;
  padding: 30px 40px 40px 40px;
}
footer .footer-content .top{
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 50px;
}
.footer-content .top .logo-details{
  color: #fff;
  font-size: 30px;
}
.footer-content .top .media-icons{
  display: flex;
}
.footer-content .top .media-icons a{
  height: 40px;
  width: 40px;
  margin: 0 8px;
  border-radius: 50%;
  text-align: center;
  line-height: 40px;
  color: #fff;
  font-size: 17px;
  text-decoration: none;
  transition: all 0.4s ease;
}
.top .media-icons a:nth-child(1){
  background: #fff;
  color: #000000;
  
}
.top .media-icons a:nth-child(1):hover{
  color: #ffffff;
  background: #4267B2;
}
.top .media-icons a:nth-child(2){
  background: #fff;
  color: #000000;
}
.top .media-icons a:nth-child(2):hover{
  background: #E1306C;
  color: #fff;
}
.top .media-icons a:nth-child(3){
  background: #fff;
  color: #000000;
}
.top .media-icons a:nth-child(3):hover{
  background: #1DA1F2;
  color: #fff;
}
.top .media-icons a:nth-child(4){
  background: #fff;
}
.top .media-icons a:nth-child(4):hover{
  color: #0077B5;
  background: #fff;
}
.top .media-icons a:nth-child(5){
  background: #fff;
}
.top .media-icons a:nth-child(5):hover{
  color: #FF0000;
  background: #fff;
}
footer .footer-content .link-boxes{
  width: 100%;
  display: flex;
  justify-content: space-between;
}
footer .footer-content .link-boxes .box{
  width: calc(100% / 5 - 10px);
}
.footer-content .link-boxes .box .link_name{
  color: #183ea4;
  font-size: 18px;
  font-weight: 400;
  margin-bottom: 10px;
  position: relative;
}
.link-boxes .box .link_name::before{
  content: '';
  position: absolute;
  left: 0;
  bottom: -2px;
  height: 2px;
  width: 35px;
  background: #fff;
}
.footer-content .link-boxes .box li{
  margin: 6px 0;
  list-style: none;
}
.footer-content .link-boxes .box li a{
  color: #fff;
  font-size: 14px;
  font-weight: 400;
  text-decoration: none;
  opacity: 0.8;
  transition: all 0.4s ease
}
.footer-content .link-boxes .box li a:hover{
  opacity: 1;
  text-decoration: underline;
  color: #254522;/*current*/
}
.footer-content .link-boxes .input-box{
  margin-right: 55px;
}
.link-boxes .input-box input{
  height: 40px;
  width: calc(100% + 55px);
  outline: none;
  border: 2px solid #AFAFB6;
  background: #fff;
  border-radius: 4px;
  padding: 0 15px;
  font-size: 15px;
  color: #fff;
  margin-top: 5px;
}
.link-boxes .input-box input::placeholder{
  color: #AFAFB6;
  font-size: 16px;
}
.link-boxes .input-box input[type="button"]{
  font-size: 18px;
  background: #64bc5c;
  color: #fff;
  text-decoration: none;
  border: none;
  padding: 8px 25px;
  border-radius: 6px;
  transition: 0.5s;
}
.input-box input[type="button"]:hover{
	background: #000;
	border: 1px solid #4070f4;
}
footer .bottom-details{
  width: 100%;
  background: #457a40;/*changes*/
}
footer .bottom-details .bottom_text{
  max-width: 1250px;
  margin: auto;
  padding: 20px 40px;
  display: flex;
  justify-content: space-between;
}
.bottom-details .bottom_text span,
.bottom-details .bottom_text a{
  font-size: 14px;
  font-weight: 300;
  color: #fff;
  opacity: 0.8;
  text-decoration: none;
}
.bottom-details .bottom_text a:hover{
  opacity: 1;
  text-decoration: underline;
  color: #64bc5c;
}
.bottom-details .bottom_text a{
  margin-right: 10px;
}
@media (max-width: 900px) {
  footer .footer-content .link-boxes{
    flex-wrap: wrap;
  }
  footer .footer-content .link-boxes .input-box{
    width: 40%;
    margin-top: 10px;
  }
}
@media (max-width: 700px){
  footer{
    position: relative;
  }
  .footer-content .top .logo-details{
    font-size: 26px;
  }
  .footer-content .top .media-icons a{
    height: 35px;
    width: 35px;
    font-size: 14px;
    line-height: 35px;
  }
  footer .footer-content .link-boxes .box{
    width: calc(100% / 3 - 10px);
  }
  footer .footer-content .link-boxes .input-box{
    width: 60%;
  }
  .bottom-details .bottom_text span,
  .bottom-details .bottom_text a{
    font-size: 12px;
  }
}
@media (max-width: 520px){
  footer::before{
    top: 145px;
  }
  footer .footer-content .top{
    flex-direction: column;
  }
  .footer-content .top .media-icons{
    margin-top: 16px;
	
  }
  footer .footer-content .link-boxes .box{
    width: calc(100% / 2 - 10px);
  }
  footer .footer-content .link-boxes .input-box{
    width: 100%;
  }
}
.top .media-icons a:nth-child(4){
  background: #fff;
  color: #000000; 
}
.top .media-icons a:nth-child(4):hover{
  background: #FF0000;
  color: #fff;
}

</style>