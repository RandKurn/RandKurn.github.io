<?php
include('connections/db-connect.php');


if(isset($_REQUEST['btn-login'])){

$username = $_REQUEST['username'];
$password = $_REQUEST['password'];

$user_retrieve = $conn -> prepare("SELECT * FROM users where username = '$username' and password = '$password'");
$user_retrieve->execute();
if($user_retrieve->rowCount() > 0){
while ($row = $user_retrieve->fetch()) {
  $_SESSION['usertype_id'] = $row['usertype_id'];
  $_SESSION['user_id'] =  $row['user_id'];
  $_SESSION['firstname'] = $row['fname'];
  $_SESSION['middlename'] = $row['mname'];
  $_SESSION['lastname'] = $row['lname'];
  $_SESSION['course'] = $row['course'];

  $usertype_id = $_SESSION['usertype_id'];
  
  if($usertype_id == 3){ 
        echo "<script type='text/javascript'>window.location.href = 'students/home/index/';</script>";
        
  }
  elseif ($usertype_id == 1 || $usertype_id == 2 ) {
        echo "<script type='text/javascript'>window.location.href = 'admins/home/index/';</script>";
         
  }

}
}else{
  ?> <script>
        alert('Try Again');
       </script>"; <?php
        echo "<script type='text/javascript'>window.location.href = 'index.php';</script>";
        exit();
}
}

?>
<!DOCTYPE html>
<html lang="id">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>OurThinks for your school</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/creative.min.css" rel="stylesheet">

    <style type="text/css">
      .wrap-input100 {
        margin-bottom: 5px;
      }
    </style>
<style type="text/css">
.stretch {
  height: 30px;
}
.stretch img{
  width: 50%;
  height: 150px;
  margin-bottom: 5px;
}
  
</style>
  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">OurThinks Website Sekolah</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#about">Berita</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#services">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#portfolio">Galeri</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#contact">Kontak</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <header class="masthead text-center text-white d-flex">
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <h1 class="text-uppercase">
              <strong>Selamat Datang OurThinks Website </strong>
            </h1>
            <hr>
          </div>
          <div class="col-lg-8 mx-auto">
            <p class="text-faded mb-5">Sistem Penilaian OurThinks</p>
            <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Cari tau lebih lanjut</a>
          </div>
        </div>
      </div>
    </header>

    <section class="bg-primary" id="about">
      <div class="container">
        <div class="row">
        <?php 
            $stmt = $conn->prepare("SELECT * FROM  tblactivities");
            $stmt->execute();  
            while($row = $stmt->fetch()){ 

          ?>
          <div class="col-lg-12 mx-auto text-center">
            <h2 class="section-heading text-white"><?php echo $row['Title'] ?></h2>
            <hr class="light my-4">
            <p class="text-faded mb-12"><?php echo $row['Description'] ?></p>
            <p class="text-faded mb-12"><?php echo $row['Course'] ?></p>
            <p class="text-faded mb-12"><?php echo $row['Subject'] ?></p> 
          </div>
        <?php } ?>
        </div>
      </div>
    </section>

    <section id="services">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading">Login</h2>
            <hr class="my-4">
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">

    
          <div class="col-lg-12 col-md-12 text-center">
            <div class="service-box mt-5 mx-auto">
              <div class="container-login100">
                  <div class="wrap-login100">
                    <div class="login100-form-title">
                      <span class="login100-form-title-1 stretch">
                        <!-- <img src="img/capislogo.png"> -->
                      </span>
                    </div> 
                    <form class="login100-form validate-form" action="" method="POST">
                      <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100">Username</span>
                        <input class="input100 form-control" type="text" name="username" placeholder="Enter username">
                        <span class="focus-input100"></span>
                      </div>

                      <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100 form-control" type="password" name="password" placeholder="Enter password">
                        <span class="focus-input100"></span>
                      </div>

                      <div class="container-login100-form-btn">
                        <input type="submit" name="btn-login" value = "Log In" class="btn btn-primary btn-login">
                      </div>
                    </form>
                  </div>
                </div>
               
            </div>
          </div>
          <div class="col-lg-3 col-md-6 text-center">
            <div class="service-box mt-5 mx-auto">
              <i class="fas fa-4x fa-gem text-primary mb-3 sr-icon-1"></i>
              <h3 class="mb-3">Sturdy System</h3>
              <p class="text-muted mb-0">Sistem yang kokoh, kita perbarui secara berkala agar tidak rusak.</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 text-center">
            <div class="service-box mt-5 mx-auto">
              <i class="fas fa-4x fa-paper-plane text-primary mb-3 sr-icon-2"></i>
              <h3 class="mb-3">Ready to Ship</h3>
              <p class="text-muted mb-0">Kalian bisa menggunakan website ini apa adanya, atau kalian bisa membuat perubahan!</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 text-center">
            <div class="service-box mt-5 mx-auto">
              <i class="fas fa-4x fa-code text-primary mb-3 sr-icon-3"></i>
              <h3 class="mb-3">Up to Date</h3>
              <p class="text-muted mb-0">Kita memperbarui sistem sesuai dengan perkembangan zaman.</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 text-center">
            <div class="service-box mt-5 mx-auto">
              <i class="fas fa-4x fa-heart text-primary mb-3 sr-icon-4"></i>
              <h3 class="mb-3">Made with Intention</h3>
              <p class="text-muted mb-0">Saat ini kita perlu membuat suatu projek dengan niat!</p>
            </div>
          </div> 
        </div>
      </div>
    </section>

    <section class="p-0" id="portfolio">
      <div class="container-fluid p-0">
        <div class="row no-gutters popup-gallery">
          <?php 
           $stmt = $conn->prepare("SELECT * FROM  tblactivities");
                      $stmt->execute();  
                      while($row = $stmt->fetch()){ 

          ?>
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="<?php echo 'admins/assessments/activities/'.$row['Image1'] ?>">
              <img class="img-fluid" src="<?php echo 'admins/assessments/activities/'.$row['Image1'] ?>" alt="">
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  <div class="project-category text-faded">
                    <?php echo $row['Title'] ?>
                  </div>
                  <div class="project-name">
                    <?php echo $row['Subject'] ?>
                  </div>
                </div>
              </div>
            </a>
          </div>

          <?php } ?>
           <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="img/portfolio/fullsize/2.jpg">
              <img class="img-fluid" src="img/portfolio/thumbnails/2.jpg" alt="">
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  <div class="project-category text-faded">
                    Category
                  </div>
                  <div class="project-name">
                    Project Name
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="img/portfolio/fullsize/3.jpg">
              <img class="img-fluid" src="img/portfolio/thumbnails/3.jpg" alt="">
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  <div class="project-category text-faded">
                    Category
                  </div>
                  <div class="project-name">
                    Project Name
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="img/portfolio/fullsize/4.jpg">
              <img class="img-fluid" src="img/portfolio/thumbnails/4.jpg" alt="">
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  <div class="project-category text-faded">
                    Category
                  </div>
                  <div class="project-name">
                    Project Name
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="img/portfolio/fullsize/5.jpg">
              <img class="img-fluid" src="img/portfolio/thumbnails/5.jpg" alt="">
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  <div class="project-category text-faded">
                    Category
                  </div>
                  <div class="project-name">
                    Project Name
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="img/portfolio/fullsize/6.jpg">
              <img class="img-fluid" src="img/portfolio/thumbnails/6.jpg" alt="">
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  <div class="project-category text-faded">
                    Category
                  </div>
                  <div class="project-name">
                    Project Name
                  </div>
                </div>
              </div>
            </a>
          </div> 
        </div>
      </div>
    </section>

 <!--    <section class="bg-dark text-white">
      <div class="container text-center">
        <h2 class="mb-4">Free Download at Start Bootstrap!</h2>
        <a class="btn btn-light btn-xl sr-button" href="http://startbootstrap.com/template-overviews/creative/">Download Now!</a>
      </div>
    </section> -->

    <section id="contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <h2 class="section-heading">Let's Get In Touch!</h2>
            <hr class="my-4">
            <p class="mb-5">Ready to start your next project with us? That's great! Give us a call or send us an email and we will get back to you as soon as possible!</p>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 ml-auto text-center">
            <i class="fas fa-phone fa-3x mb-3 sr-contact-1"></i>
            <p>0823-456-6789</p>
          </div>
          <div class="col-lg-4 mr-auto text-center">
            <i class="fas fa-envelope fa-3x mb-3 sr-contact-2"></i>
            <p>
              <a href="mailto:your-email@your-domain.com">feedback@startbootstrap.com</a>
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/creative.min.js"></script>

  </body>

</html>
