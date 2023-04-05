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
      <div class="link-boxes">
        <ul class="box">
          <div><li class="link_name">Company</li></div>
          <div><li><a href="/">Home</a></li></div>
          <div><li><a href="contact">Contact us</a></li></div>
          <div><li><a href="about">About us</a></li></div>
          <div><li><a href="services">Get started</a></li></div>
        </ul>
        <ul class="box">
        <div><li class="link_name">Services</li></div>
        <div><li><a href="#">Office Automation</a></li></div>
        <div><li><a href="#">Network Support</a></li></div>
        <div><li><a href="#">Marketing</a></li></div>
        <div><li><a href="#">ICT Skills training</a></li></div>
        </ul>
        
        <ul class="box input-box">
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
        </ul>
      </div>
    </div>
    <div class="bottom-details">
      <div class="bottom_text">
        <span class="copyright_text">Copyright © <a href="#">KAYISE IT.</a>All rights reserved</span>
        <span class="policy_terms">
          <a href="#">Privacy policy</a>
          <a href="#">Terms & condition</a>
        </span>
      </div>
    </div>
  </footer>

<style>
            
/* ==================================== footer ==================================== */
/*body {
  padding: 0;
  margin: 0;
  min-height: 100vh;
  display: flex;
  align-items: flex-end;
}*/



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