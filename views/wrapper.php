<!doctype html>
<html lang="en">

<head>
  <title>Virágtündér Műhelye</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="..public/vendor/fontawesome/css/all.css" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link rel="shortcut icon" href="..public/favicon.ico">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../public/css/style.css" />
</head>
<?php $order = json_decode(file_get_contents("./data/order.json"), true); ?>
<body>
  <div class="container text-primary">
    <nav id="mainNav" class="navbar fixed-top navbar-expand-lg navbar-light bg-light tatu-nav">
      <a class="navbar-brand none" href="#main"><img src="..public/img/logo.png" alt="logo" height="60"></a>
      <button class="navbar-toggler text-primary" type="button" data-toggle="collapse" data-target="#navbarNav1" aria-controls="navbarNav1" aria-expanded="false" aria-label="Toggle navigation">
        <span class="nav-item navbar-toggler-icon "></span>
      </button>
      <div class="collapse navbar-collapse pr-5" id="navbarNav1">
        <ul class="navbar-nav mx-auto">
        <li class="nav-item active mx-5">
            <a class="nav-link" href="/">
              <h4><i class="fas fa-home pr-2"></i>Főoldal <span class="sr-only">(current)</h4></span>
            </a>
          </li>
          <li class="nav-item active mx-5">
            <a class="nav-link" href="/#szalagviragok">
              <h4><i class="fas fa-spa pr-2"></i>Szalagvirágok </h4>
            </a>
          </li>
          <li class="nav-item mx-5">
            <a class="nav-link" href="#contact">
              <h4><i class="fas fa-envelope pr-2"></i>Kapcsolat</h4>
            </a>
          </li>
          <li class="nav-item mx-5">
            <a class="nav-link" href="/cart">
              <h4 class="mellow"><i class="fas fa-shopping-cart pr-2"></i>Kosár<span class=" ml-2 badge badge-pill badge-danger"><?php echo count($order) === 0 ? "" : count($order) ?></span></h4>
            </a>
          </li>
          <?php if(!$params['isAuthorized']): ?>
          <li class="nav-item mx-5">
          <a class="nav-link" href="/bejelentkezes">
            <h4 class="mellow"><i class="fas fa-user pr-2"></i>Bejelentkezés</h4>
          </a>
          </li>
          <?php endif; ?>
          <?php if($params['isAuthorized']): ?>
          <li class="nav-item mx-5">
          <a class="nav-link" href="/bejelentkezes">
            <h4 class="mellow">
            <form action="/logout" method="POST">
              <h4 class="pr-2"><i class="fas fa-user pr-2"></i>User<button type="submit" class="ml-3 btn btn-m btn-danger" title="Kijelentkezéss"><i class="fas fa-sign-out-alt"></i></button></h4>
            </form>
          </h4>
          </a>
          </li>
          <?php endif; ?>
        </ul>
      </div>
    </nav>
  </div>

  <section class="mt-5 fomenu">
      <div class="container">
      <?php echo $params['loginTemplate'] ?>
      </div>
      <div class="container">
      <?php echo $params['innerCartTemplate'] ?>
      </div>
      <div class="container">
      <?php echo $params['innerIntroductionTemplate'] ?>
      </div>
      <div class="container">
      <?php echo $params['innerTemplate'] ?>
      </div>
      <div class="container">
      <?php echo $params['rattanTemplate'] ?>
      </div>
      <div class="container">
      <?php echo $params['heartboxTemplate'] ?>
      </div>
      <div class="container">
      <?php echo $params['koszoruTemplate'] ?>
      </div>
      <div class="container">
      <?php echo $params['szalasTemplate'] ?>
      </div>
      <div class="container">
      <?php echo $params['valentinTemplate'] ?>
      </div>
      <div class="container">
      <?php echo $params['karacsonyTemplate'] ?>
      </div>
      <div class="container">
      <?php echo $params['bemutatoTemplate'] ?>
      </div>
      
      <div class="container">
        <div class="col12">
        <div class="col-12 px-5 text-center"><img class="img-fluid col-3 px-3" src="./public/img/logo5.png" alt=""></div>
        </div>
      </div>
      
      <div class="container">
        <div class="card card-body backcol2 pt-4" id="contact">
          <div class="row p-2">
            <div class="col-12 col-md-12">
              <img class="img-fluid m-2 p-2" src="../public/img/kapcsolat.jpg" alt="">
            </div>
            <div class="col-12 col-lg-6 card img-hover-zoom">
              <h1 class="py-3">Rehákné Török Andrea</h1>
              <h5 class="mellow"><i class="fas fa-phone-square-alt"></i> Telefonszám:</h5>
              <h5 class="blue">+30/951-4959</h5>
              <h5 class="mellow pt-2"><i class="fas fa-envelope"></i> E-mail:</h5>
              <h5 class="blue">reani0421@gmail.com</h5>
              <h5 class="mellow pt-2"><i class="fas fa-map-marker-alt"></i> Hely:</h5>
              <h5 class="blue">6723 Szeged, József Attila sgt. 77/E</h5>
              <h5 class="mellow py-2"><i class="fab fa-facebook-square"></i> Facebook:</h5>
              <a class="pb-4 mb-4 card img-hover-zoom border-shadow p-3" href="https://www.facebook.com/Vir%C3%A1gt%C3%BCnd%C3%A9r-M%C5%B1helye-101123411845057" target="_blank"><img class="card-img-top" src="..public/img/carousel.jpg" alt=""></a>
            </div>
            <form class="col-12 col-lg-6" action="/submit-message" method="POST">
            <?php if ($params['isSuccess']) : ?>
                <div class="alert alert-success" role="alert">
                    Küldés sikeres!
                </div>
            <?php endif; ?>
              <div class="form-group py-3">
                  <label>Név:</label>
                  <input type="text" name="name" class="form-control">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">E-mail cím:</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              </div>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Üzenet:</label>
                <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="7"></textarea>
              </div>
              <div class="col-12 py-2 justify-content-center">
                <div>
                  <button type="submit" class="col-6 btn-block send" style="vertical-align:middle"><span>Küldés</span></button>
              </div>
              </div>
            </form>
          </div>
        </div>

  </section>
  <footer class="border-shadow mt-2">
    <div class="border-shadow">
      <div class="container">
          <div class="row px-lg-3">
            <div class="col-12 col-lg-5 pl-5"><img class="img-fluid col-7" src="./public/img/logo2.png" alt=""></div>
            <div class="col-12 col-lg-7 row">
              <div class="col-12 row px-lg-5">
                  <div class="col-6">
                    <div class="col-12 pt-lg-3"><a href="https://www.facebook.com/Vir%C3%A1gt%C3%BCnd%C3%A9r-M%C5%B1helye-101123411845057" target="_blank" class="mellow my-2"><h5><i class="fab fa-facebook-square pr-2"></i>Facebook</h5></a></div>
                    <div class="col-12"><a href="#contact" class="mellow my-2"><h5><i class="fas fa-envelope pr-2"></i>Kapcsolat</h5></a></div>
                    <div class="col-12 pb-4"><a href="https://accounts.google.com/ServiceLogin/signinchooser?passive=1209600&continue=https%3A%2F%2Faccounts.google.com%2F&followup=https%3A%2F%2Faccounts.google.com%2F&flowName=GlifWebSignIn&flowEntry=ServiceLogin" target="_blank" class="mellow my-2"><h5><i class="fab fa-google-plus-square pr-2"></i>G-mail</h5></a></div>
                  </div>
                  <div class="col-6 pl-lg-5">
                    <div class="col-12 pt-lg-3"><a href="" class="mellow my-2"><h5><i class="fas fa-user-cog pr-2"></i>Admin</h5></a></div>
                    <div class="col-12"><a href="" class="mellow my-2"><h5><i class="fas fa-toolbox pr-2"></i>Tools</h5></a></div>
                  </div>
            </div>
              </div>
            </div>
            </div>
      </div>
    </div>
  </footer>



  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="..public/js/script.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
