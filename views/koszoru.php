<?php

function koszoruPieceChecker($piece) {
  if ($piece <= 0) {
      $checker = "Rendelhető";
      echo $checker;

  } else if ($piece > 0 ) {
      $checker = $piece . " db készleten";
      echo $checker;

  }
}

$koszoru = $params['koszoru'];
$index = $params['foundProductIndex'] ?? 2;
?>

<div id="koszoru">
  <div class="card card-body backcol">
    <div class="row p-2 m-2">
      <div class="col-12 col-md-12">
        <img class="img-fluid my-2 py-2" src="..public/img/koszoruk.jpg" alt="">
      </div>
      <div class="col-12 col-md-12 col-lg-6 p-3">
        <div class="col-12 p-3" id="ImgKoszoru">
        <img class="img-fluid" src="<?php echo $koszoru[$index]["img"] ?>" alt="">
        </div>
        <div class="col-12 py-2 text-center" >
        <form class="p-2" action="/cart" method="POST">  
          <div class="row p-2">
              <div class="col-6"><input type="hidden" name="id" value="<?php echo $koszoru[$index]["id"] ?>"/><h5 class="mellow" name="name"><?php echo $koszoru[$index]["name"] ?> </h5></div> 
              <div class="col-6"><input type="hidden" name="location" value="<?php echo $koszoru[8]["location"] ?>"/><h5 style="color:red;"><?php koszoruPieceChecker($koszoru[$index]['piece']) ?></h5></div>
              <div class="col-6"><input class="w-30" id="kubliOrder" type="number" name="piece" size="5" min="1" max="<?php echo $koszoru[$index]['piece'] ?>" <?php echo $koszoru[$index]['piece'] === 0 ? "disabled" : "" ?>></input></div>
              <div class="col-6"><button type="submit" id="kubliOrderSender" class="btn btn-block btn-success" <?php echo $koszoru[$index]['piece'] === 0 ? "disabled" : "" ?>>Kosárba</button></div>
          </div>
          </form>
        </div>
        <div class="row p-2 mx-4 ">
          <div class="col-6 col-md-3 bord">
          <a href="/koszoru?id=<?php echo $koszoru[0]["id"] ?>#koszoru" method="GET" ><img class="img-fluid hov" src="..public/img/sirkoszoru/feher.jpg" alt=""></a>
          </div>
          <div class="col-6 col-md-3 bord">
          <a href="/koszoru?id=<?php echo $koszoru[1]["id"] ?>#koszoru" method="GET" ><img class="img-fluid hov" src="..public/img/sirkoszoru/fekete.jpg" alt=""></a>
          </div>
          <div class="col-6 col-md-3 bord">
          <a href="/koszoru?id=<?php echo $koszoru[2]["id"] ?>#koszoru" method="GET" ><img class="img-fluid hov" src="..public/img/sirkoszoru/ekru.jpg" alt=""></a>
          </div>
          <div class="col-6 col-md-3 bord">
          <a href="/koszoru?id=<?php echo $koszoru[3]["id"] ?>#koszoru" method="GET" ><img class="img-fluid hov" src="..public/img/sirkoszoru/barack.jpg" alt=""></a>
          </div>
        </div>
        <div class="row p-2 mx-4 ">
          <div class="col-6 col-md-3 bord">
          <a href="/koszoru?id=<?php echo $koszoru[4]["id"] ?>#koszoru" method="GET" ><img class="img-fluid hov" src="..public/img/sirkoszoru/malyva.jpg" alt=""></a>
          </div>
          <div class="col-6 col-md-3 bord">
          <a href="/koszoru?id=<?php echo $koszoru[5]["id"] ?>#koszoru" method="GET" ><img class="img-fluid hov" src="..public/img/sirkoszoru/bordo.jpg" alt=""></a>
          </div>
          <div class="col-6 col-md-3 bord">
          <a href="/koszoru?id=<?php echo $koszoru[6]["id"] ?>#koszoru" method="GET" ><img class="img-fluid hov" src="..public/img/sirkoszoru/kek.jpg" alt=""></a>
          </div>
        </div>
        <div class="m-4 p-4">
          <a href="#contact"><button type="button" class="btn btn-outline-success btn-lg btn-block"><i class="far fa-envelope"></i> Ha kérdésed van, írj nekem!</button></a>
        </div>
      </div>

      <div class="col-md-12 col-lg-6">
        <div>
          <h3 class="m-2 blue px-2 text-center">Koszorúk</h3>
          <h5 class="mellow m-3 px-2">
            Az egyvirágos küblik kis apró ajándékok, kedvességek. Kiváló dekorációs termékek, amelyek feldobják és öltöztetik a szobát.
          </h5>
          <h5 class="mellow m-3 px-2">Előszeretettel szokták adni: névnapokra, szülinapokra, anyák napjára és persze apró kedvesség miatt.
          </h5>
        </div>
        <div class="row">
          <div class=" col-12 col-md-6 text-center p-2 mt-2">
            <h3 class="mellow m-3 px-2 text-center">Ára: <span style="color:red; font-style:italic;"><?php echo $koszoru[8]["price"] ?> Ft</span></h3>
          </div>
          <div class=" col-12 col-md-6 text-center p-2 mt-2">
            <h5 class="blue m-3 px-2 text-center">Választható szalagok:</h5>
            <div class="row">
              <div class="col-6">
                <ul class="mellow">
                  <li>Fehér</li>
                  <li>Ekrü</li>
                  <li>Fekete</li>
                </ul>
              </div>
              <div class="col-6 pr-3 pb-3" id="szalagok">
              <a href="/koszoru?id=<?php echo $koszoru[7]["id"] ?>#koszoru" method="GET" ><img class="img-fluid hov" src="..public/img/sirkoszoru/szalagok.jpg" alt=""></a>
              </div>
            </div>
          </div>

        </div>
        <div class="termekleiras text-center py-3 m-2">
          <div class="row borbott text-left mx-2 p-2">
            <div class="col-12"><i class="fas fa-cut"></i> Kézműves termék</div>
          </div>
          <div class="row borbott text-left mx-2 p-2">
            <div class="col-4"><i class="fas fa-long-arrow-alt-up"></i> Magasság:</div>
            <div class="col-8">8,5 cm,</div>
          </div>
          <div class="row borbott text-left mx-2 p-2">
            <div class="col-4"><i class="fas fa-long-arrow-alt-right"></i> Hosszúság:</div>
            <div class="col-8">16 cm,</div>
          </div>
          <div class="row borbott text-left mx-2 p-2">
            <div class="col-4"><i class="fas fa-arrows-alt-h"></i> Szélesség:</div>
            <div class="col-8">20 cm,</div>
          </div>
          <div class="row borbott text-left mx-2 p-2">
            <div class="col-4"><i class="fas fa-weight-hanging"></i> Súly:</div>
            <div class="col-8">11 dkg,</div>
          </div>
          <div class="row borbott text-left mx-2 p-2">
            <div class="col-4"><i class="fab fa-buffer"></i> Anyaga:</div>
            <div class="col-8">műanyag, szalma, szatén, fa</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col12">
<div class="col-12 px-5 text-center"><img class="img-fluid col-3 px-3" src="./public/img/logo5.png" alt=""></div>
</div>
