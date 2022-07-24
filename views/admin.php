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
  <link rel="stylesheet" type="text/css" href="../public/css/sass/style.css" />
</head>
<?php $egyviragoskubli = json_decode(file_get_contents("./data/kublik.json"), true); ?>
<?php $haromviragoskubli = json_decode(file_get_contents("./data/kublik2.json"), true); ?>
<?php $rattan = json_decode(file_get_contents("./data/rattan.json"), true); ?>
<?php $rattan2 = json_decode(file_get_contents("./data/rattan2.json"), true); ?>
<?php $heartbox = json_decode(file_get_contents("./data/heartbox.json"), true); ?>
<?php $koszoru = json_decode(file_get_contents("./data/koszoru.json"), true); ?>
<?php $szalas = json_decode(file_get_contents("./data/szalas.json"), true); ?>
<?php $Nkaspo = json_decode(file_get_contents("./data/Nkaspo.json"), true); ?>
<?php $Kkaspo = json_decode(file_get_contents("./data/Kkaspo.json"), true); ?>
<?php $angel = json_decode(file_get_contents("./data/angel.json"), true); ?>
<?php $mikulas = json_decode(file_get_contents("./data/mikulas.json"), true); ?>
<body>
<div class="py-4 adminbackground">
    <div class="logout">
        <form action="/adminlogout" method="POST">
        <button type="submit" class="btn btn-primary" btn-lg btn-block><i class="fas fa-sign-out-alt pr-2"></i>Kijelentkezés</button>
        </form>
    </div>
    <div class="container">
        <div class="row p-4">
            <div class="col-4">
                <img class="img-fluid col-5 d-flex ml-auto" src="..public/img/adminlogo.png" alt="adminlogo">
            </div>
            <div class="col-8 d-flex align-items-center">
                <h1 class="blue">Virágtündér Műhelye</h1>
            </div>
        </div>
        <div class="accordion" id="accordionExample">
            <div class="card backcol3">
                <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left blue" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <img class="img-fluid col-1" src="..public/img/kubli/Malyva.JPG" alt="malyva">
                        Egyvirágos Küblik:
                    </button>
                     </h2>
                </div>
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body backcol4">
                        <div class="row">
                            <div class="col-3 text-center p-2" id="kublik">
                                <h4 class="blue">Id:</h4>
                            </div>
                            <div class="col-5 pl-3 p-2">
                                <h4 class="blue">Név:</h4>
                            </div>
                            <div class="col-4 p-2 text-left">
                                <h4 class="blue">Készleten:</h4>
                            </div>
                            <div class="col-12 py-1"><hr></div>
                            <?php $index = 0 ?>
                        <?php foreach($egyviragoskubli as $kubli): ?>
                            <?php $index = $index+1; ?>
                            <?php if($index == count($egyviragoskubli)) : ?>
                                <?php break; ?>
                            <?php endif; ?>
                            <div class="col-1 pl-3 p-2" id="kublik<?php echo $index?>">
                                <img class="img-fluid" src="<?php echo $kubli["img"]?>" >
                            </div>
                            <div class="col-2 pl-3 p-2">
                                <p class="blue"><?php echo $kubli["id"] ?></p>
                            </div>
                            <div class="col-5 pl-3 p-2">
                            <?php if($params["productName"] === $kubli["id"]): ?>
                                <form action="/adminproductname" method="POST">
                                <input type="hidden" name="location" value="kublik"/>
                                <input type="hidden" name="id" value="<?php echo $kubli["id"] ?>"/>
                                <input type="hidden" name="index" value="<?php echo $index ?>"/>
                                <input class="w-30" type="text" name="name" size="15"></input>
                                <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                                <a href="/admin#kublik"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                                </form>
                            <?php else : ?>
                                <a href="/admin?nameszerkesztes=<?php echo $kubli["id"] ?>#kublik" class="pointer"><p class="blue"><?php echo $kubli["name"] ?><i class="pl-5 mellow text-right fas fa-edit"></i></p></a>
                            <?php endif; ?>
                            </div>
                            <div class="col-4 p-2 text-left">
                            <?php if($params["editedProductId"] === $kubli["id"]): ?>
                                <form action="/adminedit" method="POST">
                                <input type="hidden" name="location" value="kublik"/>
                                <input type="hidden" name="id" value="<?php echo $kubli["id"] ?>"/>
                                <input type="hidden" name="index" value="<?php echo $index ?>"/>
                                <input class="w-30" type="number" name="piece" size="3"></input>
                                <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                                <a href="/admin#kublik"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                                </form>
                            <?php else : ?>
                                <a href="/admin?pieceszerkesztes=<?php echo $kubli["id"] ?>#kublik" class="pointer"><p class="blue"><?php echo $kubli["piece"] ?> db<i class="pl-5 mellow text-right fas fa-edit"></i></p></a>
                            <?php endif; ?>
                                
                            </div>
                            <div class="col-12 py-1"><hr></div> 
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card backcol3">
                <div class="card-header" id="headingTwo">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left blue collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <img class="img-fluid col-1" src="..public/img/kubli2/rozsaszin.JPG" alt="rozsaszin">
                        Háromvirágos Küblik:
                        </button>
                    </h2>
                </div>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body backcol5">
                <div class="row">
                            <div class="col-3 text-center p-2" id="haromviragoskublik">
                                <h4 class="blue">Id:</h4>
                            </div>
                            <div class="col-5 pl-3 p-2">
                                <h4 class="blue">Név:</h4>
                            </div>
                            <div class="col-4 p-2 text-left">
                                <h4 class="blue">Készleten:</h4>
                            </div>
                            <div class="col-12 py-1"><hr></div>
                            <?php $index = 0 ?>
                        <?php foreach($haromviragoskubli as $kubli2): ?>
                            <?php $index = $index+1; ?>
                            <?php if($index == count($haromviragoskubli)) : ?>
                                <?php break; ?>
                            <?php endif; ?>
                            <div class="col-1 pl-3 p-2" id="kublik2<?php echo $index?>">
                                <img class="img-fluid" src="<?php echo $kubli2["img"]?>" >
                            </div>
                            <div class="col-2 pl-3 p-2">
                                <p class="blue"><?php echo $kubli2["id"] ?></p>
                            </div>
                            <div class="col-5 pl-3 p-2">
                            <?php if($params["productName"] === $kubli2["id"]): ?>
                                <form action="/adminproductname" method="POST">
                                <input type="hidden" name="location" value="kublik2"/>
                                <input type="hidden" name="id" value="<?php echo $kubli2["id"] ?>"/>
                                <input type="hidden" name="index" value="<?php echo $index ?>"/>
                                <input class="w-30" type="text" name="name" size="15"></input>
                                <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                                <a href="/admin#haromviragoskublik"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                                </form>
                            <?php else : ?>
                                <a href="/admin?nameszerkesztes=<?php echo $kubli2["id"] ?>#haromviragoskublik" class="pointer"><p class="blue"><?php echo $kubli2["name"] ?><i class="pl-5 mellow text-right fas fa-edit"></i></p></a>
                            <?php endif; ?>
                            </div>
                            <div class="col-4 p-2 text-left">
                            <?php if($params["editedProductId"] === $kubli2["id"]): ?>
                                <form action="/adminedit" method="POST">
                                <input type="hidden" name="location" value="kublik2"/>
                                <input type="hidden" name="id" value="<?php echo $kubli2["id"] ?>"/>
                                <input type="hidden" name="index" value="<?php echo $index ?>"/>
                                <input class="w-30" type="number" name="piece" size="3"></input>
                                <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                                <a href="/admin#haromviragoskublik"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                                </form>
                            <?php else : ?>
                                <a href="/admin?pieceszerkesztes=<?php echo $kubli2["id"] ?>#haromviragoskublik" class="pointer"><p class="blue"><?php echo $kubli2["piece"] ?> db<i class="pl-5 mellow text-right fas fa-edit"></i></p></a>
                            <?php endif; ?>
                                
                            </div>
                            <div class="col-12 py-1"><hr></div> 
                        <?php endforeach; ?>
                        </div>
                </div>
                </div>
            </div>
            <div class="card backcol3">
                <div class="card-header" id="headingThree">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left blue collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <img class="img-fluid col-1" src="..public/img/rattan/5flower/kekfeher01.JPG" alt="kekfeher">
                        Ötvirágos Rattan:
                        </button>
                    </h2>
                    </div>
                <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionExample">
                <div class="card-body backcol4">
                        <div class="row">
                            <div class="col-3 text-center p-2" id="rattan">
                                <h4 class="blue">Id:</h4>
                            </div>
                            <div class="col-5 pl-3 p-2">
                                <h4 class="blue">Név:</h4>
                            </div>
                            <div class="col-4 p-2 text-left">
                                <h4 class="blue">Készleten:</h4>
                            </div>
                            <div class="col-12 py-1"><hr></div>
                            <?php $index = 0 ?>
                        <?php foreach($rattan as $rattan1): ?>
                            <?php $index = $index+1; ?>
                            <?php if($index == count($rattan)) : ?>
                                <?php break; ?>
                            <?php endif; ?>
                            <div class="col-1 pl-3 p-2" id="rattan<?php echo $index?>">
                                <img class="img-fluid" src="<?php echo $rattan1["img"]?>" >
                            </div>
                            <div class="col-2 pl-3 p-2">
                                <p class="blue"><?php echo $rattan1["id"] ?></p>
                            </div>
                            <div class="col-5 pl-3 p-2">
                            <?php if($params["productName"] === $rattan1["id"]): ?>
                                <form action="/adminproductname" method="POST">
                                <input type="hidden" name="location" value="rattan"/>
                                <input type="hidden" name="id" value="<?php echo $rattan1["id"] ?>"/>
                                <input type="hidden" name="index" value="<?php echo $index ?>"/>
                                <input class="w-30" type="text" name="name" size="15"></input>
                                <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                                <a href="/admin#rattan"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                                </form>
                            <?php else : ?>
                                <a href="/admin?nameszerkesztes=<?php echo $rattan1["id"] ?>#rattan" class="pointer"><p class="blue"><?php echo $rattan1["name"] ?><i class="pl-5 mellow text-right fas fa-edit"></i></p></a>
                            <?php endif; ?>
                            </div>
                            <div class="col-4 p-2 text-left">
                            <?php if($params["editedProductId"] === $rattan1["id"]): ?>
                                <form action="/adminedit" method="POST">
                                <input type="hidden" name="location" value="rattan"/>
                                <input type="hidden" name="id" value="<?php echo $rattan1["id"] ?>"/>
                                <input type="hidden" name="index" value="<?php echo $index ?>"/>
                                <input class="w-30" type="number" name="piece" size="3"></input>
                                <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                                <a href="/admin#rattan"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                                </form>
                            <?php else : ?>
                                <a href="/admin?pieceszerkesztes=<?php echo $rattan1["id"] ?>#rattan" class="pointer"><p class="blue"><?php echo $rattan1["piece"] ?> db<i class="pl-5 mellow text-right fas fa-edit"></i></p></a>
                            <?php endif; ?>
                                
                            </div>
                            <div class="col-12 py-1"><hr></div> 
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card backcol3">
                <div class="card-header" id="headingFour">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left blue collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        <img class="img-fluid col-1" src="..public/img/rattan/9flower/lilarozsaszin.JPG" alt="lilarozsaszin">
                        Kilencvirágos Rattan:
                        </button>
                    </h2>
                    </div>
                <div id="collapseFour" class="collapse show" aria-labelledby="headingFour" data-parent="#accordionExample">
                <div class="card-body backcol5">
                        <div class="row">
                            <div class="col-3 text-center p-2" id="nagyrattan">
                                <h4 class="blue">Id:</h4>
                            </div>
                            <div class="col-5 pl-3 p-2">
                                <h4 class="blue">Név:</h4>
                            </div>
                            <div class="col-4 p-2 text-left">
                                <h4 class="blue">Készleten:</h4>
                            </div>
                            <div class="col-12 py-1"><hr></div>
                            <?php $index = 0 ?>
                        <?php foreach($rattan2 as $rattan): ?>
                            <?php $index = $index+1; ?>
                            <?php if($index == count($rattan2)) : ?>
                                <?php break; ?>
                            <?php endif; ?>
                            <div class="col-1 pl-3 p-2" id="rattan2<?php echo $index?>">
                                <img class="img-fluid" src="<?php echo $rattan["img"]?>" >
                            </div>
                            <div class="col-2 pl-3 p-2">
                                <p class="blue"><?php echo $rattan["id"] ?></p>
                            </div>
                            <div class="col-5 pl-3 p-2">
                            <?php if($params["productName"] === $rattan["id"]): ?>
                                <form action="/adminproductname" method="POST">
                                <input type="hidden" name="location" value="rattan2"/>
                                <input type="hidden" name="id" value="<?php echo $rattan["id"] ?>"/>
                                <input type="hidden" name="index" value="<?php echo $index ?>"/>
                                <input class="w-30" type="text" name="name" size="15"></input>
                                <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                                <a href="/admin#nagyrattan"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                                </form>
                            <?php else : ?>
                                <a href="/admin?nameszerkesztes=<?php echo $rattan["id"] ?>#nagyrattan" class="pointer"><p class="blue"><?php echo $rattan["name"] ?><i class="pl-5 mellow text-right fas fa-edit"></i></p></a>
                            <?php endif; ?>
                            </div>
                            <div class="col-4 p-2 text-left">
                            <?php if($params["editedProductId"] === $rattan["id"]): ?>
                                <form action="/adminedit" method="POST">
                                <input type="hidden" name="location" value="rattan2"/>
                                <input type="hidden" name="id" value="<?php echo $rattan["id"] ?>"/>
                                <input type="hidden" name="index" value="<?php echo $index ?>"/>
                                <input class="w-30" type="number" name="piece" size="3"></input>
                                <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                                <a href="/admin#nagyrattan"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                                </form>
                            <?php else : ?>
                                <a href="/admin?pieceszerkesztes=<?php echo $rattan["id"] ?>#nagyrattan" class="pointer"><p class="blue"><?php echo $rattan["piece"] ?> db<i class="pl-5 mellow text-right fas fa-edit"></i></p></a>
                            <?php endif; ?>
                                
                            </div>
                            <div class="col-12 py-1"><hr></div> 
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="card backcol3">
                <div class="card-header" id="headingFive">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left blue collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        <img class="img-fluid col-1" src="..public/img/heartbox/malyvavintage01.jpg" alt="malyvavintage01">
                        Szívbox:
                        </button>
                    </h2>
                    </div>
                <div id="collapseFive" class="collapse show" aria-labelledby="headingFive" data-parent="#accordionExample">
                <div class="card-body backcol4">
                        <div class="row">
                            <div class="col-3 text-center p-2" id="heartbox">
                                <h4 class="blue">Id:</h4>
                            </div>
                            <div class="col-5 pl-3 p-2">
                                <h4 class="blue">Név:</h4>
                            </div>
                            <div class="col-4 p-2 text-left">
                                <h4 class="blue">Készleten:</h4>
                            </div>
                            <div class="col-12 py-1"><hr></div>
                            <?php $index = 0 ?>
                        <?php foreach($heartbox as $heart): ?>
                            <?php $index = $index+1; ?>
                            <?php if($index == count($heartbox)) : ?>
                                <?php break; ?>
                            <?php endif; ?>
                            <div class="col-1 pl-3 p-2" id="heartbox<?php echo $index?>">
                                <img class="img-fluid" src="<?php echo $heart["img"]?>" >
                            </div>
                            <div class="col-2 pl-3 p-2">
                                <p class="blue"><?php echo $heart["id"] ?></p>
                            </div>
                            <div class="col-5 pl-3 p-2">
                            <?php if($params["productName"] === $heart["id"]): ?>
                                <form action="/adminproductname" method="POST">
                                <input type="hidden" name="location" value="heartbox"/>
                                <input type="hidden" name="id" value="<?php echo $heart["id"] ?>"/>
                                <input type="hidden" name="index" value="<?php echo $index ?>"/>
                                <input class="w-30" type="text" name="name" size="15"></input>
                                <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                                <a href="/admin#heartbox"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                                </form>
                            <?php else : ?>
                                <a href="/admin?nameszerkesztes=<?php echo $heart["id"] ?>#heartbox" class="pointer"><p class="blue"><?php echo $heart["name"] ?><i class="pl-5 mellow text-right fas fa-edit"></i></p></a>
                            <?php endif; ?>
                            </div>
                            <div class="col-4 p-2 text-left">
                            <?php if($params["editedProductId"] === $heart["id"]): ?>
                                <form action="/adminedit" method="POST">
                                <input type="hidden" name="location" value="heartbox"/>
                                <input type="hidden" name="id" value="<?php echo $heart["id"] ?>"/>
                                <input type="hidden" name="index" value="<?php echo $index ?>"/>
                                <input class="w-30" type="number" name="piece" size="3"></input>
                                <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                                <a href="/admin#heartbox"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                                </form>
                            <?php else : ?>
                                <a href="/admin?pieceszerkesztes=<?php echo $heart["id"] ?>#heartbox" class="pointer"><p class="blue"><?php echo $heart["piece"] ?> db<i class="pl-5 mellow text-right fas fa-edit"></i></p></a>
                            <?php endif; ?>
                                
                            </div>
                            <div class="col-12 py-1"><hr></div> 
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card backcol3">
                <div class="card-header" id="headingSix">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left blue collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                        <img class="img-fluid col-1" src="..public/img/sirkoszoru/kek.jpg" alt="kek">
                        Koszorú:
                        </button>
                    </h2>
                    </div>
                <div id="collapseSix" class="collapse show" aria-labelledby="headingSix" data-parent="#accordionExample">
                <div class="card-body backcol5">
                        <div class="row">
                            <div class="col-3 text-center p-2" id="koszoru">
                                <h4 class="blue">Id:</h4>
                            </div>
                            <div class="col-5 pl-3 p-2">
                                <h4 class="blue">Név:</h4>
                            </div>
                            <div class="col-4 p-2 text-left">
                                <h4 class="blue">Készleten:</h4>
                            </div>
                            <div class="col-12 py-1"><hr></div>
                            <?php $index = 0 ?>
                        <?php foreach($koszoru as $koszoru1): ?>
                            <?php $index = $index+1; ?>
                            <?php if($index == count($koszoru)-1) : ?>
                                <?php break; ?>
                            <?php endif; ?>
                            <div class="col-1 pl-3 p-2" id="koszoru<?php echo $index?>">
                                <img class="img-fluid" src="<?php echo $koszoru1["img"]?>" >
                            </div>
                            <div class="col-2 pl-3 p-2">
                                <p class="blue"><?php echo $koszoru1["id"] ?></p>
                            </div>
                            <div class="col-5 pl-3 p-2">
                            <?php if($params["productName"] === $koszoru1["id"]): ?>
                                <form action="/adminproductname" method="POST">
                                <input type="hidden" name="location" value="koszoru"/>
                                <input type="hidden" name="id" value="<?php echo $koszoru1["id"] ?>"/>
                                <input type="hidden" name="index" value="<?php echo $index ?>"/>
                                <input class="w-30" type="text" name="name" size="15"></input>
                                <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                                <a href="/admin#koszoru"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                                </form>
                            <?php else : ?>
                                <a href="/admin?nameszerkesztes=<?php echo $koszoru1["id"] ?>#koszoru" class="pointer"><p class="blue"><?php echo $koszoru1["name"] ?><i class="pl-5 mellow text-right fas fa-edit"></i></p></a>
                            <?php endif; ?>
                            </div>
                            <div class="col-4 p-2 text-left">
                            <?php if($params["editedProductId"] === $koszoru1["id"]): ?>
                                <form action="/adminedit" method="POST">
                                <input type="hidden" name="location" value="koszoru"/>
                                <input type="hidden" name="id" value="<?php echo $koszoru1["id"] ?>"/>
                                <input type="hidden" name="index" value="<?php echo $index ?>"/>
                                <input class="w-30" type="number" name="piece" size="3"></input>
                                <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                                <a href="/admin#koszoru"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                                </form>
                            <?php else : ?>
                                <a href="/admin?pieceszerkesztes=<?php echo $koszoru1["id"] ?>#koszoru" class="pointer"><p class="blue"><?php echo $koszoru1["piece"] ?> db<i class="pl-5 mellow text-right fas fa-edit"></i></p></a>
                            <?php endif; ?>
                                
                            </div>
                            <div class="col-12 py-1"><hr></div> 
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card backcol3">
                <div class="card-header" id="headingSeven">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left blue collapsed" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                        <img class="img-fluid col-1" src="..public/img/szalas/szinatmenet/piros01.jpg" alt="piros01">
                        Szálas virág:
                        </button>
                    </h2>
                    </div>
                <div id="collapseSeven" class="collapse show" aria-labelledby="headingSeven" data-parent="#accordionExample">
                <div class="card-body backcol4">
                        <div class="row">
                            <div class="col-3 text-center p-2" id="szalas">
                                <h4 class="blue">Id:</h4>
                            </div>
                            <div class="col-5 pl-3 p-2">
                                <h4 class="blue">Név:</h4>
                            </div>
                            <div class="col-4 p-2 text-left">
                                <h4 class="blue">Készleten:</h4>
                            </div>
                            <div class="col-12 py-1"><hr></div>
                            <?php $index = 0 ?>
                        <?php foreach($szalas as $szalas1): ?>
                            <?php $index = $index+1; ?>
                            <?php if($index == count($szalas)) : ?>
                                <?php break; ?>
                            <?php endif; ?>
                            <div class="col-1 pl-3 p-2" id="szalas<?php echo $index?>">
                                <img class="img-fluid" src="<?php echo $szalas1["img"]?>" >
                            </div>
                            <div class="col-2 pl-3 p-2">
                                <p class="blue"><?php echo $szalas1["id"] ?></p>
                            </div>
                            <div class="col-5 pl-3 p-2">
                            <?php if($params["productName"] === $szalas1["id"]): ?>
                                <form action="/adminproductname" method="POST">
                                <input type="hidden" name="location" value="szalas"/>
                                <input type="hidden" name="id" value="<?php echo $szalas1["id"] ?>"/>
                                <input type="hidden" name="index" value="<?php echo $index ?>"/>
                                <input class="w-30" type="text" name="name" size="15"></input>
                                <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                                <a href="/admin#szalas"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                                </form>
                            <?php else : ?>
                                <a href="/admin?nameszerkesztes=<?php echo $szalas1["id"] ?>#szalas" class="pointer"><p class="blue"><?php echo $szalas1["name"] ?><i class="pl-5 mellow text-right fas fa-edit"></i></p></a>
                            <?php endif; ?>
                            </div>
                            <div class="col-4 p-2 text-left">
                            <?php if($params["editedProductId"] === $szalas1["id"]): ?>
                                <form action="/adminedit" method="POST">
                                <input type="hidden" name="location" value="szalas"/>
                                <input type="hidden" name="id" value="<?php echo $szalas1["id"] ?>"/>
                                <input type="hidden" name="index" value="<?php echo $index ?>"/>
                                <input class="w-30" type="number" name="piece" size="3"></input>
                                <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                                <a href="/admin#szalas"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                                </form>
                            <?php else : ?>
                                <a href="/admin?pieceszerkesztes=<?php echo $szalas1["id"] ?>#szalas" class="pointer"><p class="blue"><?php echo $szalas1["piece"] ?> db<i class="pl-5 mellow text-right fas fa-edit"></i></p></a>
                            <?php endif; ?>
                                
                            </div>
                            <div class="col-12 py-1"><hr></div> 
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card backcol3">
                <div class="card-header" id="headingEight">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left blue collapsed" type="button" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                        <img class="img-fluid col-1" src="..public/img/valentin/Nkaspo/rozsaszin01.jpg" alt="rozsaszin01">
                        Nagy kaspós virág:
                        </button>
                    </h2>
                    </div>
                <div id="collapseEight" class="collapse show" aria-labelledby="headingEight" data-parent="#accordionExample">
                <div class="card-body backcol5">
                        <div class="row">
                            <div class="col-3 text-center p-2" id="Nkaspo">
                                <h4 class="blue">Id:</h4>
                            </div>
                            <div class="col-5 pl-3 p-2">
                                <h4 class="blue">Név:</h4>
                            </div>
                            <div class="col-4 p-2 text-left">
                                <h4 class="blue">Készleten:</h4>
                            </div>
                            <div class="col-12 py-1"><hr></div>
                            <?php $index = 0 ?>
                        <?php foreach($Nkaspo as $kaspo): ?>
                            <?php $index = $index+1; ?>
                            <?php if($index == count($Nkaspo)) : ?>
                                <?php break; ?>
                            <?php endif; ?>
                            <div class="col-1 pl-3 p-2" id="Nkaspo<?php echo $index?>">
                                <img class="img-fluid" src="<?php echo $kaspo["img"]?>" >
                            </div>
                            <div class="col-2 pl-3 p-2">
                                <p class="blue"><?php echo $kaspo["id"] ?></p>
                            </div>
                            <div class="col-5 pl-3 p-2">
                            <?php if($params["productName"] === $kaspo["id"]): ?>
                                <form action="/adminproductname" method="POST">
                                <input type="hidden" name="location" value="Nkaspo"/>
                                <input type="hidden" name="id" value="<?php echo $kaspo["id"] ?>"/>
                                <input type="hidden" name="index" value="<?php echo $index ?>"/>
                                <input class="w-30" type="text" name="name" size="15"></input>
                                <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                                <a href="/admin#Nkaspo"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                                </form>
                            <?php else : ?>
                                <a href="/admin?nameszerkesztes=<?php echo $kaspo["id"] ?>#Nkaspo" class="pointer"><p class="blue"><?php echo $kaspo["name"] ?><i class="pl-5 mellow text-right fas fa-edit"></i></p></a>
                            <?php endif; ?>
                            </div>
                            <div class="col-4 p-2 text-left">
                            <?php if($params["editedProductId"] === $kaspo["id"]): ?>
                                <form action="/adminedit" method="POST">
                                <input type="hidden" name="location" value="Nkaspo"/>
                                <input type="hidden" name="id" value="<?php echo $kaspo["id"] ?>"/>
                                <input type="hidden" name="index" value="<?php echo $index ?>"/>
                                <input class="w-30" type="number" name="piece" size="3"></input>
                                <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                                <a href="/admin#Nkaspo"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                                </form>
                            <?php else : ?>
                                <a href="/admin?pieceszerkesztes=<?php echo $kaspo["id"] ?>#Nkaspo" class="pointer"><p class="blue"><?php echo $kaspo["piece"] ?> db<i class="pl-5 mellow text-right fas fa-edit"></i></p></a>
                            <?php endif; ?>
                                
                            </div>
                            <div class="col-12 py-1"><hr></div> 
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card backcol3">
                <div class="card-header" id="headingNine">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left blue collapsed" type="button" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                        <img class="img-fluid col-1" src="..public/img/valentin/Kkaspo/piros0101.jpg" alt="piros0101">
                        Kis kaspós virág:
                        </button>
                    </h2>
                    </div>
                <div id="collapseNine" class="collapse show" aria-labelledby="headingNine" data-parent="#accordionExample">
                <div class="card-body backcol4">
                        <div class="row">
                            <div class="col-3 text-center p-2" id="Kkaspo">
                                <h4 class="blue">Id:</h4>
                            </div>
                            <div class="col-5 pl-3 p-2">
                                <h4 class="blue">Név:</h4>
                            </div>
                            <div class="col-4 p-2 text-left">
                                <h4 class="blue">Készleten:</h4>
                            </div>
                            <div class="col-12 py-1"><hr></div>
                            <?php $index = 0 ?>
                        <?php foreach($Kkaspo as $kaspo): ?>
                            <?php $index = $index+1; ?>
                            <?php if($index == count($Kkaspo)) : ?>
                                <?php break; ?>
                            <?php endif; ?>
                            <div class="col-1 pl-3 p-2" id="Kkaspo<?php echo $index?>">
                                <img class="img-fluid" src="<?php echo $kaspo["img"]?>" >
                            </div>
                            <div class="col-2 pl-3 p-2">
                                <p class="blue"><?php echo $kaspo["id"] ?></p>
                            </div>
                            <div class="col-5 pl-3 p-2">
                            <?php if($params["productName"] === $kaspo["id"]): ?>
                                <form action="/adminproductname" method="POST">
                                <input type="hidden" name="location" value="Kkaspo"/>
                                <input type="hidden" name="id" value="<?php echo $kaspo["id"] ?>"/>
                                <input type="hidden" name="index" value="<?php echo $index ?>"/>
                                <input class="w-30" type="text" name="name" size="15"></input>
                                <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                                <a href="/admin#Kkaspo"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                                </form>
                            <?php else : ?>
                                <a href="/admin?nameszerkesztes=<?php echo $kaspo["id"] ?>#Kkaspo" class="pointer"><p class="blue"><?php echo $kaspo["name"] ?><i class="pl-5 mellow text-right fas fa-edit"></i></p></a>
                            <?php endif; ?>
                            </div>
                            <div class="col-4 p-2 text-left">
                            <?php if($params["editedProductId"] === $kaspo["id"]): ?>
                                <form action="/adminedit" method="POST">
                                <input type="hidden" name="location" value="Kkaspo"/>
                                <input type="hidden" name="id" value="<?php echo $kaspo["id"] ?>"/>
                                <input type="hidden" name="index" value="<?php echo $index ?>"/>
                                <input class="w-30" type="number" name="piece" size="3"></input>
                                <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                                <a href="/admin#Kkaspo"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                                </form>
                            <?php else : ?>
                                <a href="/admin?pieceszerkesztes=<?php echo $kaspo["id"] ?>#Kkaspo" class="pointer"><p class="blue"><?php echo $kaspo["piece"] ?> db<i class="pl-5 mellow text-right fas fa-edit"></i></p></a>
                            <?php endif; ?>
                                
                            </div>
                            <div class="col-12 py-1"><hr></div> 
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card backcol3">
                <div class="card-header" id="headingTen">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left blue collapsed" type="button" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                        <img class="img-fluid col-1" src="..public/img/angel/lila.jpg" alt="lila">
                        Angyalka:
                        </button>
                    </h2>
                    </div>
                <div id="collapseTen" class="collapse show" aria-labelledby="headingTen" data-parent="#accordionExample">
                <div class="card-body backcol5">
                        <div class="row">
                            <div class="col-3 text-center p-2" id="angel">
                                <h4 class="blue">Id:</h4>
                            </div>
                            <div class="col-5 pl-3 p-2">
                                <h4 class="blue">Név:</h4>
                            </div>
                            <div class="col-4 p-2 text-left">
                                <h4 class="blue">Készleten:</h4>
                            </div>
                            <div class="col-12 py-1"><hr></div>
                            <?php $index = 0 ?>
                        <?php foreach($angel as $angel1): ?>
                            <?php $index = $index+1; ?>
                            <?php if($index == count($angel)) : ?>
                                <?php break; ?>
                            <?php endif; ?>
                            <div class="col-1 pl-3 p-2" id="angel<?php echo $index?>">
                                <img class="img-fluid" src="<?php echo $angel1["img"]?>" >
                            </div>
                            <div class="col-2 pl-3 p-2">
                                <p class="blue"><?php echo $angel1["id"] ?></p>
                            </div>
                            <div class="col-5 pl-3 p-2">
                            <?php if($params["productName"] === $angel1["id"]): ?>
                                <form action="/adminproductname" method="POST">
                                <input type="hidden" name="location" value="angel"/>
                                <input type="hidden" name="id" value="<?php echo $angel1["id"] ?>"/>
                                <input type="hidden" name="index" value="<?php echo $index ?>"/>
                                <input class="w-30" type="text" name="name" size="15"></input>
                                <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                                <a href="/admin#angel"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                                </form>
                            <?php else : ?>
                                <a href="/admin?nameszerkesztes=<?php echo $angel1["id"] ?>#angel" class="pointer"><p class="blue"><?php echo $angel1["name"] ?><i class="pl-5 mellow text-right fas fa-edit"></i></p></a>
                            <?php endif; ?>
                            </div>
                            <div class="col-4 p-2 text-left">
                            <?php if($params["editedProductId"] === $angel1["id"]): ?>
                                <form action="/adminedit" method="POST">
                                <input type="hidden" name="location" value="angel"/>
                                <input type="hidden" name="id" value="<?php echo $angel1["id"] ?>"/>
                                <input type="hidden" name="index" value="<?php echo $index ?>"/>
                                <input class="w-30" type="number" name="piece" size="3"></input>
                                <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                                <a href="/admin#angel"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                                </form>
                            <?php else : ?>
                                <a href="/admin?pieceszerkesztes=<?php echo $angel1["id"] ?>#angel" class="pointer"><p class="blue"><?php echo $angel1["piece"] ?> db<i class="pl-5 mellow text-right fas fa-edit"></i></p></a>
                            <?php endif; ?>
                                
                            </div>
                            <div class="col-12 py-1"><hr></div> 
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card backcol3 mb-5">
                <div class="card-header" id="headingEleven">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left blue collapsed" type="button" data-toggle="collapse" data-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                        <img class="img-fluid col-1" src="..public/img/mikulas/bordo.jpg" alt="bordo">
                        Mikulásvirág:
                        </button>
                    </h2>
                    </div>
                <div id="collapseEleven" class="collapse show" aria-labelledby="headingEleven" data-parent="#accordionExample">
                <div class="card-body backcol4">
                        <div class="row">
                            <div class="col-3 text-center p-2" id="mikulas">
                                <h4 class="blue">Id:</h4>
                            </div>
                            <div class="col-5 pl-3 p-2">
                                <h4 class="blue">Név:</h4>
                            </div>
                            <div class="col-4 p-2 text-left">
                                <h4 class="blue">Készleten:</h4>
                            </div>
                            <div class="col-12 py-1"><hr></div>
                            <?php $index = 0 ?>
                        <?php foreach($mikulas as $mikulas1): ?>
                            <?php $index = $index+1; ?>
                            <?php if($index == count($mikulas)) : ?>
                                <?php break; ?>
                            <?php endif; ?>
                            <div class="col-1 pl-3 p-2" id="mikulas<?php echo $index?>">
                                <img class="img-fluid" src="<?php echo $mikulas1["img"]?>" >
                            </div>
                            <div class="col-2 pl-3 p-2">
                                <p class="blue"><?php echo $mikulas1["id"] ?></p>
                            </div>
                            <div class="col-5 pl-3 p-2">
                            <?php if($params["productName"] === $mikulas1["id"]): ?>
                                <form action="/adminproductname" method="POST">
                                <input type="hidden" name="location" value="mikulas"/>
                                <input type="hidden" name="id" value="<?php echo $mikulas1["id"] ?>"/>
                                <input type="hidden" name="index" value="<?php echo $index ?>"/>
                                <input class="w-30" type="text" name="name" size="15"></input>
                                <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                                <a href="/admin#mikulas"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                                </form>
                            <?php else : ?>
                                <a href="/admin?nameszerkesztes=<?php echo $mikulas1["id"] ?>#mikulas" class="pointer"><p class="blue"><?php echo $mikulas1["name"] ?><i class="pl-5 mellow text-right fas fa-edit"></i></p></a>
                            <?php endif; ?>
                            </div>
                            <div class="col-4 p-2 text-left">
                            <?php if($params["editedProductId"] === $mikulas1["id"]): ?>
                                <form action="/adminedit" method="POST">
                                <input type="hidden" name="location" value="mikulas"/>
                                <input type="hidden" name="id" value="<?php echo $mikulas1["id"] ?>"/>
                                <input type="hidden" name="index" value="<?php echo $index ?>"/>
                                <input class="w-30" type="number" name="piece" size="3"></input>
                                <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                                <a href="/admin#mikulas"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                                </form>
                            <?php else : ?>
                                <a href="/admin?pieceszerkesztes=<?php echo $mikulas1["id"] ?>#mikulas" class="pointer"><p class="blue"><?php echo $mikulas1["piece"] ?> db<i class="pl-5 mellow text-right fas fa-edit"></i></p></a>
                            <?php endif; ?>
                                
                            </div>
                            <div class="col-12 py-1"><hr></div> 
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>




  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="..public/js/script.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>