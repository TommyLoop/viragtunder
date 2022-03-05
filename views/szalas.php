
<?php

function szalasPieceChecker($piece) {
  if ($piece <= 0) {
      $checker = "Rendelhető";
      echo $checker;

  } else if ($piece > 0 ) {
      $checker = $piece . " db készleten";
      echo $checker;

  }
}

$szalas = $params['szalas'];
$index = $params['foundProductIndex'] ?? 1;
?>
<div id="szalasvirag">
  <div class="card card-body backcol2">
    <div class="row p-2 m-2">
      <div class="col-12 col-md-12">
        <img class="img-fluid m-2 p-2" src="..public/img/szalasviragok.jpg" alt="">
      </div>
      <div class="row">
        <div class="col-12 col-md-6 pt-2">
          <div>
            <h3 class="m-2 blue px-2 text-center">Szálas virágok</h3>
            <h5 class="mellow m-3 px-2">
              A szálas virágok kis apró ajándékok, kedvességek. Kiváló dekorációs termékek, amelyek feldobják és öltöztetik a szobát.
            </h5>
            <h5 class="mellow m-3 px-2">Előszeretettel szokták adni: valentin napra, névnapokra, szülinapokra, anyák napjára és persze apró kedvesség miatt.
            </h5>
          </div>
          <div class="row">
            <div class=" col-12 col-md-6 text-center p-2 mt-2">
              <h3 class="mellow m-3 px-2 text-center">Ára: <span style="color:red; font-style:italic;"><?php echo $szalas[8]["price"] ?> Ft</span></h3>
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
              <div class="col-8">47 cm,</div>
            </div>
            <div class="row borbott text-left mx-2 p-2">
              <div class="col-4"><i class="fas fa-long-arrow-alt-right"></i> Hosszúság:</div>
              <div class="col-8">11 cm,</div>
            </div>
            <div class="row borbott text-left mx-2 p-2">
              <div class="col-4"><i class="fas fa-arrows-alt-h"></i> Szélesség:</div>
              <div class="col-8">8 cm,</div>
            </div>
            <div class="row borbott text-left mx-2 p-2">
              <div class="col-4"><i class="fas fa-weight-hanging"></i> Súly:</div>
              <div class="col-8">1 dkg,</div>
            </div>
            <div class="row borbott text-left mx-2 p-2" id="szalas">
              <div class="col-4"><i class="fab fa-buffer"></i> Anyaga:</div>
              <div class="col-8">vetex, szatén, gyöngy, fa, művirág,</div>
            </div>
          </div>
        </div>
        <div class="col-12 p-2 m-2" >
          <div class="row border-shadow py-3" >
            <div class="col-12 col-md-6" id="FirstSzalas">
                <img class="img-fluid" src="<?php echo $szalas[$index]["img"] ?>" alt="">
            </div>
            <div class="col-12 col-md-6" id="SecondSzalas">
                <img class="img-fluid" src="<?php echo $szalas[$index]["img2"] ?>" alt="">
            </div>
            <div class="col-12 py-2 text-center" >
            <form action="/cart" method="POST"> 
                <div class="row">
                    <div class="col-12 col-md-3 p-2">
                    <input type="hidden" name="id" value="<?php echo $szalas[$index]["id"] ?>"/>
                    <h5 class="mellow"><?php echo $szalas[$index]["name"] ?></h5>
                    </div>
                    <div class="col-12 col-md-3 p-2 my-2">
                    <input type="hidden" name="location" value="<?php echo $szalas[8]["location"] ?>"/>
                    <h5 style="color:red;"><?php echo szalasPieceChecker($szalas[$index]["piece"]) ?></h5>
                    </div>
                    <div class="col-12 col-md-3 p-2 my-2">
                    <input class="w-30" type="number" name="piece" size="5" min="1" max="<?php echo $szalas[$index]['piece'] ?>" <?php echo $szalas[$index]['piece'] === 0 ? "disabled" : "" ?>></input>
                    </div>
                    <div class="col-12 col-md-3 pt-3 px-5">
                    <button type="submit" class=" btn btn-block btn-success" <?php echo $szalas[$index]['piece'] === 0 ? "disabled" : "" ?>>Kosárba</button>
                    </div>
                </div>
            </form>    
            </div>
            <div class="col-12 col-md-6 py-2">
              <div class="row">
                <div class="col-3 bord">
                <a href="/szalas?id=<?php echo $szalas[0]["id"] ?>#szalas" method="GET" ><img class="img-fluid hov" src="../public/img/szalas/egyszinu/rozsaszin01.jpg" alt=""></a>
                </div>
                <div class="col-3 bord">
                <a href="/szalas?id=<?php echo $szalas[1]["id"] ?>#szalas" method="GET" ><img class="img-fluid hov" src="../public/img/szalas/egyszinu/vintage01.jpg" alt=""></a>
                </div>
                <div class="col-3 bord">
                <a href="/szalas?id=<?php echo $szalas[2]["id"] ?>#szalas" method="GET" ><img class="img-fluid hov" src="../public/img/szalas/egyszinu/bordo01.jpg" alt=""></a>
                </div>
                <div class="col-3 bord">
                <a href="/szalas?id=<?php echo $szalas[3]["id"] ?>#szalas" method="GET" ><img class="img-fluid hov" src="../public/img/szalas/egyszinu/sarga01.jpg" alt=""></a>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6 py-2">
              <div class="row">
                <div class="col-3 bord">
                <a href="/szalas?id=<?php echo $szalas[4]["id"] ?>#szalas" method="GET" ><img class="img-fluid hov" src="../public/img/szalas/szinatmenet/piros01.jpg" alt=""></a>
                </div>
                <div class="col-3 bord">
                <a href="/szalas?id=<?php echo $szalas[5]["id"] ?>#szalas" method="GET" ><img class="img-fluid hov" src="../public/img/szalas/szinatmenet/lila01.jpg" alt=""></a>
                </div>
                <div class="col-3 bord">
                <a href="/szalas?id=<?php echo $szalas[6]["id"] ?>#szalas" method="GET" ><img class="img-fluid hov" src="../public/img/szalas/szinatmenet/kek01.jpg" alt=""></a>
                </div>
                <div class="col-3 bord">
                <a href="/szalas?id=<?php echo $szalas[7]["id"] ?>#szalas" method="GET" ><img class="img-fluid hov" src="../public/img/szalas/szinatmenet/sarga01.jpg" alt=""></a>
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
