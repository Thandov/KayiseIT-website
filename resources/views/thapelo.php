<?php /*Template Name: Contact Tenhle Auto */ ?>
<?php get_header(); ?>
            <?php
            if (have_posts()) {
                while (have_posts()) {
                    the_post();
                    the_content();
                }
            } else {
                _e('Sorry, no posts matched your criteria.', 'textdomain');
            } ?>
        


<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="style.css" />

</head>

<body>
  <header>
    <!-- place navbar here -->

    <nav class="navbar navbar-light bg-light topnav">
        <div class="container-fluid">
          <div class="mx-auto"></div>
         <div class="continfo d-flex align-items-center justify-content-end">
          <ul class="navbar navbar sm-icons">
            <a class="navlink" href="#"><i class="bi bi-envelope"></i> autotenhle@gmail.com</a>
              
                <a class="navlink" href="#"><i class="bi bi-telephone"></i> 013273657</a>
          </ul>
            </div>
        </div>
      </nav>

      <nav class="navbar navbar-expand-lg navbar-light bottomNav">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Navbar w/ text</a>         
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarText">
            <div class="mx-auto"></div>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
  </header>
  <main>




  <?php require('carousel-temp1.php') ?>


      <div class="container ">
        <div class="row m-4">
          <div class="col">

            <div class="mb-3">
                <h1>Contact Us</h1>
            </div>
            
            <div class="mb-3 ">
                <input type="text" class="form-control" id="fullnames" placeholder="full name">
            </div>
            <div class="mb-3">
                <input type="email" class="form-control" id="emailAddress" placeholder="email">
            </div>
            <div class="mb-3">
                <textarea class="form-control" id="TextArea" placeholder="How Would You Like Us To Help You?" rows="3"></textarea>
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-primary">Send Message</button>
              </div>
            </div>
            

            
          <div class="col">
            <div class="row m-3">

              <div class="col">
                
                <div class="address mb-1">
                   <h3>Located In:</h2>
                </div>
                <div>
                  <p>Mpumalanga, Mbombela</p>
                </div>
              </div>

              <div class="col">

                <div class="email">
                  <h3>Email Address:</h2>
                </div>
                <div>
                  <p>info@autotenhle.co.za</p>
                </div>

              </div>
            <div class="map">
                
              <p><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d115255.
                11640170858!2d30.915947072952804!3d-25.480943773944084!2m3!1f0!2f0!3f0!3m2!1i1024
                !2i768!4f13.1!3m3!1m2!1s0x1ee84a158d3e2739%3A0x7aa50ca83429a0f8!2sMbombela!5e0!3m2!1sen
                !2sza!4v1668003382879!5m2!1sen!2sza" width="600" height="300" style="border:0;" allowfullscreen="" loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade"></iframe>            </div>
             
          </div>
        </div>
        </div>
      </div>


      <div class="container mt-3 bg-light">
<div class="mb-3 text-center bg-secondary">
                <h1>Latest Offers</h1>
            </div>
    <div class="row">
        
            <?php echo do_shortcode('[showAllCars]'); ?>
        
    </div>
</div>





  </main>
  <footer>
    <!-- place footer here -->

    <body>
        <div class="footer-basic fixed-bottom ">
           
            <footer>
            <div class="social"><a href="#"><i class="bi bi-facebook"></i></i></a><a href="#"><i class="bi bi-whatsapp"></i></a><a href="#"><i class="bi bi-instagram"></i></a><a href="#"><i class="bi bi-twitter"></i></a></div>

                <ul class="list-inline">
                    <li class="list-inline-item"><a href="#">Home</a></li>
                    <li class="list-inline-item"><a href="#">Services</a></li>
                    <li class="list-inline-item"><a href="#">About</a></li>
                    <li class="list-inline-item"><a href="#">Terms</a></li>
                    <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                </ul>
                <p class="copyright">Company Name © 2018</p>
            </footer>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    </body>


  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>

<?php get_footer(); ?>