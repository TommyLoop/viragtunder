
<?php

function heartboxPieceChecker($piece) {
  if ($piece <= 0) {
      $checker = "Rendelhető";
      echo $checker;

  } else if ($piece > 0 ) {
      $checker = $piece . " db készleten";
      echo $checker;

  }
}

$heartbox = $params['heartbox'];
$index = $params['foundProductIndex'] ?? 7;
?>

<div id="heartbox">
  <div class="card card-body backcol2" >
    <div class="row p-2 m-2">
      <div class="col-12 col-md-12">
        <img class="img-fluid m-2 p-2" src="../public/img/szivboxok.jpg" alt="">
      </div>
      <div class="row">
        <div class="col-12 col-md-6 pt-2">
          <div>
            <h3 class="m-2 blue px-2 text-center">Szívbox</h3>
            <h5 class="mellow m-3 px-2">
              A szívboxok közepes ajándékok, kedvességek. Kiváló dekorációs termékek, amelyek feldobják és öltöztetik a szobát.
            </h5>
            <h5 class="mellow m-3 px-2">Előszeretettel szokták adni: valentin napra, névnapokra, szülinapokra, anyák napjára és persze apró kedvesség miatt.
            </h5>
          </div>
          <div class="row">
            <div class=" col-12 col-md-6 text-center p-2 mt-2">
              <h3 class="mellow m-3 px-2 text-center">Ára: <span style="color:red; font-style:italic;"><?php echo $heartbox[8]["price"] ?> Ft</span></h3>
            </div>
          </div>

        </div>
        <div class="col-12 col-md-6 pt-4">
          <div class="termekleiras text-center py-3 m-2">
            <div class="row borbott text-left mx-2 p-2">
              <div class="col-12"><i class="fas fa-cut"></i> Kézműves termék</div>
            </div>
            <div class="row borbott text-left mx-2 p-2">
              <div class="col-4"><i class="fas fa-long-arrow-alt-up"></i> Magasság:</div>
              <div class="col-8">13 cm,</div>
            </div>
            <div class="row borbott text-left mx-2 p-2">
              <div class="col-4"><i class="fas fa-long-arrow-alt-right"></i> Hosszúság:</div>
              <div class="col-8">17 cm,</div>
            </div>
            <div class="row borbott text-left mx-2 p-2">
              <div class="col-4"><i class="fas fa-arrows-alt-h"></i> Szélesség:</div>
              <div class="col-8">17 cm,</div>
            </div>
            <div class="row borbott text-left mx-2 p-2">
              <div class="col-4"><i class="fas fa-weight-hanging"></i> Súly:</div>
              <div class="col-8">10 dkg,</div>
            </div>
            <div class="row borbott text-left mx-2 p-2">
              <div class="col-4"><i class="fab fa-buffer"></i> Anyaga:</div>
              <div class="col-8">papír, vetex, szatén, strassz, gyöngy, fa, csipke, művirág, hungarocell</div>
            </div>
          </div>
          <div class="m-4 p-4" id="szivbox">
            <a href="#contact"><button type="button" class="btn btn-outline-success btn-lg btn-block"><i class="far fa-envelope"></i> Ha kérdésed van, írj nekem!</button></a>
          </div>
        </div>
        <div class="col-12 p-2 m-2" >
          <div class="row border-shadow py-3">
            <div class="col-12 col-md-6" id="FirstHeart">
              <img class="img-fluid" src="<?php echo $heartbox[$index]["img"] ?>" alt="">
            </div>
            <div class="col-12 col-md-6" id="SecondHeart">
              <img class="img-fluid" src="<?php echo $heartbox[$index]["img2"] ?>" alt="">
            </div>
            <div class="col-12 py-2 text-center">
            <form action="/cart" method="POST"> 
                <div class="row">
                    <div class="col-12 col-md-3 p-2">
                    <input type="hidden" name="id" value="<?php echo $heartbox[$index]["id"] ?>"/>
                    <h5 class="mellow"><?php echo $heartbox[$index]["name"] ?></h5>
                    </div>
                    <div class="col-12 col-md-3 p-2 my-2">
                    <input type="hidden" name="location" value="<?php echo $heartbox[8]["location"] ?>"/>
                    <h5 style="color:red;"><?php echo heartboxPieceChecker($heartbox[$index]["piece"]) ?></h5>
                    </div>
                    <div class="col-12 col-md-3 p-2 my-2">
                    <input class="w-30" type="number" name="piece" size="5" min="1" max="<?php echo $heartbox[$index]['piece'] ?>" <?php echo $heartbox[$index]['piece'] === 0 ? "disabled" : "" ?>></input>
                    </div>
                    <div class="col-12 col-md-3 pt-3 px-5">
                    <button type="submit" class=" btn btn-block btn-success" <?php echo $heartbox[$index]['piece'] === 0 ? "disabled" : "" ?>>Kosárba</button>
                    </div>
                </div>
            </form>    
            </div>
            <div class="col-12 col-md-6 py-2">
              <div class="row">
                <div class="col-3 bord">
                <a href="/heartbox?id=<?php echo $heartbox[0]["id"] ?>#szivbox" method="GET" ><img class="img-fluid hov" src="../public/img/heartbox/arany01.jpg" alt=""></a>
                </div>
                <div class="col-3 bord">
                <a href="/heartbox?id=<?php echo $heartbox[1]["id"] ?>#szivbox" method="GET" ><img class="img-fluid hov" src="../public/img/heartbox/lilabarack01.jpg" alt=""></a>
                </div>
                <div class="col-3 bord">
                <a href="/heartbox?id=<?php echo $heartbox[2]["id"] ?>#szivbox" method="GET" ><img class="img-fluid hov" src="../public/img/heartbox/lilakek01.jpg" alt=""></a>
                </div>
                <div class="col-3 bord">
                <a href="/heartbox?id=<?php echo $heartbox[3]["id"] ?>#szivbox" method="GET" ><img class="img-fluid hov" src="../public/img/heartbox/lilarozsaszin01.jpg" alt=""></a>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6 py-2">
              <div class="row">
                <div class="col-3 bord">
                <a href="/heartbox?id=<?php echo $heartbox[4]["id"] ?>#szivbox" method="GET" ><img class="img-fluid hov" src="../public/img/heartbox/malyvavintage01.jpg" alt=""></a>
                </div>
                <div class="col-3 bord">
                <a href="/heartbox?id=<?php echo $heartbox[5]["id"] ?>#szivbox" method="GET" ><img class="img-fluid hov" src="../public/img/heartbox/melylilarozsaszin01.jpg" alt=""></a>
                </div>
                <div class="col-3 bord">
                <a href="/heartbox?id=<?php echo $heartbox[6]["id"] ?>#szivbox" method="GET" ><img class="img-fluid hov" src="../public/img/heartbox/piros01.jpg" alt=""></a>
                </div>
                <div class="col-3 bord">
                <a href="/heartbox?id=<?php echo $heartbox[7]["id"] ?>#szivbox" method="GET" ><img class="img-fluid hov" src="../public/img/heartbox/vintageekru01.jpg" alt=""></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col21">
      <div class="col-12 px-5 text-center"><img class="img-fluid col-3 px-3" src="./public/img/logo5.png" alt=""></div>
      </div>