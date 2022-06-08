<!doctype html>
<html lang="en">

<head>
  <title>Tools</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="..public/vendor/fontawesome/css/all.css" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../public/css/style.css" />
</head>
<body>
    <section class="tools">
        <div class="container">
            <div class="col-12">
                <img class="img-fluid" src="..public/img/tools/tools.gif" alt="">
            </div>

            <div class="btn-group d-flex justify-content-center" role="group" aria-label="Basic example">
                <a href="/tools/images" class="white btn-group"><button type="button" class="toolsnav btn btn-secondary btn-lg btn-block px-5"><i class="fas fa-image pr-2"></i>Images</button></a>
                <a href="/tools/backgrounds" class="white btn-group"><button type="button" class="toolsnav btn btn-secondary btn-lg btn-block px-4"><i class="fas fa-paint-roller pr-2"></i>Backgrounds</button></a>
                <a href="/tools/colors" class="white btn-group"><button type="button" class="toolsnav btn btn-secondary btn-lg btn-block px-4"><i class="fas fa-palette pr-2"></i>Colors</button></a>
                <a href="/tools/png" class="white btn-group"><button type="button" class="toolsnav btn btn-secondary btn-lg btn-block px-5"><i class="fas fa-file-image pr-2"></i>PNG</button></a>
                <a href="/tools/other" class="white btn-group"><button type="button" class="toolsnav btn btn-secondary btn-lg btn-block px-4"><i class="fas fa-toolbox pr-2"></i>Others</button></a>
            </div>
            <div class="row pt-4">
            <?php echo $params['toolsTemplate'] ?>
            </div>
            <div class="row p-5">
                <div class="col-9 px-5 toolsback d-flex align-items-center"><h2 class="blue">Lazulásképp egy kis "Halálos iramban" ?</h2></div>
                <div class="col-3">
                    <a href="https://tommyloop1983-gmail-com.trinket.io/sites/keruldkiazautokat" target="blank"><img class="img-fluid" src="..public/img/tools/game.jpg" alt=""></a>
                </div>

            </div>

        </div>
    </section>

</body>


