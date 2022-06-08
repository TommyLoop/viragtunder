<?php

function pieceChecker($piece) { 
  if ($piece <= 0) {
      $checker = "Rendelhető";
      echo $checker;
      
  } else if ($piece > 0 ) {
      $checker = $piece . " db készleten";
      echo $checker;
      
  }
}

$kublik = $params['kubli'];
$kublik2 = $params['kubli2'];
$index = $params['foundProductIndex'] ?? 8;
$index2 = $params['foundProductIndex2'] ?? 7;
?>

  


<div class="mt-4" id="kubli">
  <div class=" backcol2">
    <div class="row p-2">
      <div class="col-12 col-md-12">
        <img class="img-fluid my-2 py-2" src="..public/img/kublik.jpg"  alt="">
      </div>
      <div class="col-12 col-lg-6 d-block d-lg-none">
        <div>
          <h3 class="m-2 blue px-2 text-center">Egy virágos küblik</h3>
          <h5 class="mellow m-3 px-2">
            Az egyvirágos küblik kis apró ajándékok, kedvességek. Kiváló dekorációs termékek, amelyek feldobják és öltöztetik a szobát.
          </h5>
          <h5 class="mellow m-3 px-2">Előszeretettel szokták adni: névnapokra, szülinapokra, anyák napjára és persze apró kedvesség miatt.
          </h5>
        </div>
        <div class="row">
          <div class=" col-12 text-center p-2 mt-2">
            <h3 class="mellow m-3 px-2 text-center">Ára: <span style="color:red; font-style:italic;"><?php echo $kublik[10]["price"] ?> Ft</span></h3>
          </div>
        </div>
        <div class="termekleiras text-center py-3 m-2">
          <div class="row borbott text-left mx-2 p-2">
            <div class="col-12"><i class="fas fa-cut"></i> Kézműves termék</div>
          </div>
          <div class="row borbott text-left mx-2 p-2">
            <div class="col-5"><i class="fas fa-long-arrow-alt-up"></i> Magasság:</div>
            <div class="col-7">10 cm,</div>
          </div>
          <div class="row borbott text-left mx-2 p-2">
            <div class="col-5"><i class="fas fa-long-arrow-alt-right"></i> Hosszúság:</div>
            <div class="col-7">8 cm,</div>
          </div>
          <div class="row borbott text-left mx-2 p-2">
            <div class="col-5"><i class="fas fa-arrows-alt-h"></i> Szélesség:</div>
            <div class="col-7">8 cm,</div>
          </div>
          <div class="row borbott text-left mx-2 p-2">
            <div class="col-5"><i class="fas fa-weight-hanging"></i> Súly:</div>
            <div class="col-7">3 dkg,</div>
          </div>
          <div class="row borbott text-left mx-2 p-2">
            <div class="col-5"><i class="fab fa-buffer"></i> Anyaga:</div>
            <div class="col-7">műanyag, vetex, szatén, strassz, gyöngy, fa, hungarocell</div>
          </div>
        </div>
        <div class="m-4 p-3">
          <a href="#contact"><button type="button" class="btn btn-outline-success btn-lg btn-block"><i class="far fa-envelope"></i> Ha rendelni szeretnél vagy kérdésed van</button></a>
        </div>
      </div>

      <div class="col-12 col-lg-6 p-3" id="egyviragoskubli">
        <div class="col-12 p-3 mt-lg-5 pt-5">
          <img class="img-fluid border-shadow p-3" src=<?php echo $kublik[$index]['img'] ?> alt="">
        </div>
        <div class="col-12 py-2 text-center" >
        <form class="p-2" action="/cart" method="POST">  
          <div class="row p-2" id="NamePiece" >
              <div class="col-6"><input type="hidden" name="id" value="<?php echo $kublik[$index]["id"] ?>"/><h5 class="mellow" name="name"><?php echo $kublik[$index]["name"] ?> </h5></div> 
              <div class="col-6"><input type="hidden" name="location" value="<?php echo $kublik[10]["location"] ?>"/><h5 style="color:red;"><?php pieceChecker($kublik[$index]['piece']) ?></h5></div>
              <div class="col-6 py-2 d-flex justify-content-center">
              <div class="row">
              <button type="button" id="kublikDecrement" class="input-number-decrement" <?php echo $kublik[$index]['piece'] === 0 ? "disabled" : "" ?>>–</button>
              <div id="egyviragosKubli"><input id="kublikPiece" class="input-number" name="piece" value="1" type="text" min="1" max="<?php echo $kublik[$index]['piece'] ?>" <?php echo $kublik[$index]['piece'] === 0 ? "disabled" : "" ?>></div>
              <button type="button" id="kublikIncrement" class="input-number-increment" <?php echo $kublik[$index]['piece'] === 0 ? "disabled" : "" ?>>+</button>
              </div>
              </div>
              <div class="col-6"><button type="submit" class="btn-block button" style="vertical-align:middle" <?php echo $kublik[$index]['piece'] === 0 ? "disabled" : "" ?>><span>Kosárba</span></button></div>
          </div>
          </form>
        </div>
        <div class="row p-2 mx-4 ">
          <div class="col-6 col-md-3 bord">
          <a href="/kublik?id=<?php echo $kublik[0]["id"] ?>#egyviragoskubli" method="GET" ><img class="img-fluid hov" id="barack" src="..public/img/kubli/Barackvirag.JPG" alt=""></a>
          </div>
          <div class="col-6 col-md-3 bord">
          <a href="/kublik?id=<?php echo $kublik[1]["id"] ?>#egyviragoskubli" method="GET" ><img class="img-fluid hov" id="kek" src="..public/img/kubli/Kek.JPG" alt=""></a>
          </div>
          <div class="col-6 col-md-3 bord">
          <a href="/kublik?id=<?php echo $kublik[2]["id"] ?>#egyviragoskubli" method="GET" ><img class="img-fluid hov" id="gold" src="..public/img/kubli/LightGold.JPG" alt=""></a>
          </div>
          <div class="col-6 col-md-3 bord">
          <a href="/kublik?id=<?php echo $kublik[3]["id"] ?>#egyviragoskubli" method="GET" ><img class="img-fluid hov" id="llila" src="..public/img/kubli/LightLila.JPG" alt=""></a>
          </div>
        </div>
        <div class="row p-2 mx-4 ">
          <div class="col-6 col-md-3 bord">
          <a href="/kublik?id=<?php echo $kublik[4]["id"] ?>#egyviragoskubli" method="GET" ><img class="img-fluid hov" id="malyva" src="..public/img/kubli/Malyva.JPG" alt=""></a>
          </div>
          <div class="col-6 col-md-3 bord">
          <a href="/kublik?id=<?php echo $kublik[5]["id"] ?>#egyviragoskubli" method="GET" ><img class="img-fluid hov" id="mlila" src="..public/img/kubli/MelyLila.JPG" alt=""></a>
          </div>
          <div class="col-6 col-md-3 bord">
          <a href="/kublik?id=<?php echo $kublik[6]["id"] ?>#egyviragoskubli" method="GET" ><img class="img-fluid hov" id="pink" src="..public/img/kubli/Pink.JPG" alt=""></a>
          </div>
          <div class="col-6 col-md-3 bord">
          <a href="/kublik?id=<?php echo $kublik[7]["id"] ?>#egyviragoskubli" method="GET" ><img class="img-fluid hov" id="piros" src="..public/img/kubli/Piros.JPG" alt=""></a>
          </div>
        </div>
        <div class="row p-2 mx-4">
          <div class="col-6 col-md-3 bord">
          <a href="/kublik?id=<?php echo $kublik[8]["id"] ?>#egyviragoskubli" method="GET" ><img class="img-fluid hov" id="rozsaszin" src="..public/img/kubli/Rozsaszin.JPG" alt=""></a>
          </div>
          <div class="col-6 col-md-3 bord">
          <a href="/kublik?id=<?php echo $kublik[9]["id"] ?>#egyviragoskubli" method="GET" ><img class="img-fluid hov"  id="vintager" src="..public/img/kubli/VintageRozsaszin.JPG" alt=""></a>
          </div>
        </div>
      </div>

      <div class="col-12 col-lg-6 d-none d-lg-block" >
        <div>
          <h3 class="m-2 blue px-2 text-center">Egy virágos küblik</h3>
          <h5 class="mellow m-3 px-2">
            Az egyvirágos küblik kis apró ajándékok, kedvességek. Kiváló dekorációs termékek, amelyek feldobják és öltöztetik a szobát.
          </h5>
          <h5 class="mellow m-3 px-2">Előszeretettel szokták adni: névnapokra, szülinapokra, anyák napjára és persze apró kedvesség miatt.
          </h5>
        </div>
        <div class="row">
          <div class=" col-12 text-center p-2 mt-2">
            <h3 class="mellow m-3 px-2 text-center">Ára: <span style="color:red; font-style:italic;"><?php echo $kublik[10]["price"] ?> Ft</span></h3>
          </div>
        </div>
        <div class="termekleiras text-center py-3 m-2">
          <div class="row borbott text-left mx-2 p-2">
            <div class="col-12"><i class="fas fa-cut"></i> Kézműves termék</div>
          </div>
          <div class="row borbott text-left mx-2 p-2">
            <div class="col-5"><i class="fas fa-long-arrow-alt-up"></i> Magasság:</div>
            <div class="col-7">10 cm,</div>
          </div>
          <div class="row borbott text-left mx-2 p-2">
            <div class="col-5"><i class="fas fa-long-arrow-alt-right"></i> Hosszúság:</div>
            <div class="col-7">8 cm,</div>
          </div>
          <div class="row borbott text-left mx-2 p-2">
            <div class="col-5"><i class="fas fa-arrows-alt-h"></i> Szélesség:</div>
            <div class="col-7">8 cm,</div>
          </div>
          <div class="row borbott text-left mx-2 p-2">
            <div class="col-5"><i class="fas fa-weight-hanging"></i> Súly:</div>
            <div class="col-7">3 dkg,</div>
          </div>
          <div class="row borbott text-left mx-2 p-2">
            <div class="col-5"><i class="fab fa-buffer"></i> Anyaga:</div>
            <div class="col-7">műanyag, vetex, szatén, strassz, gyöngy, fa, hungarocell</div>
          </div>
        </div>
        <div class="m-4 p-3">
          <a href="#contact"><button type="button" class="btn btn-outline-success btn-lg btn-block"><i class="far fa-envelope"></i> Ha rendelni szeretnél vagy kérdésed van</button></a>
        </div>
      </div>

      <div class="col-12 col-lg-6">
        <div>
          <h3 class="m-2 blue px-2 text-center">Három virágos küblik</h3>
          <h5 class="mellow m-3 px-2">
            Az három virágos küblik is kis apró ajándékok, kedvességek. Kiváló dekorációs termékek, amelyek feldobják és öltöztetik a szobát.
          </h5>
          <h5 class="mellow m-3 px-2">Előszeretettel szokták adni: névnapokra, szülinapokra, anyák napjára és persze apró kedvesség miatt.
          </h5>
        </div>
        <div class="row">
          <div class=" col-12 text-center p-2 mt-2">
            <h3 class="mellow m-3 px-2 text-center">Ára: <span style="color:red; font-style:italic;"><?php echo $kublik2[10]["price"] ?> Ft</span></h3>
          </div>
        </div>
        <div class="termekleiras text-center py-3 m-2">
          <div class="row borbott text-left mx-2 p-2">
            <div class="col-12"><i class="fas fa-cut"></i> Kézműves termék</div>
          </div>
          <div class="row borbott text-left mx-2 p-2">
            <div class="col-5"><i class="fas fa-long-arrow-alt-up"></i> Magasság:</div>
            <div class="col-7">9 cm,</div>
          </div>
          <div class="row borbott text-left mx-2 p-2">
            <div class="col-5"><i class="fas fa-long-arrow-alt-right"></i> Hosszúság:</div>
            <div class="col-7">8 cm,</div>
          </div>
          <div class="row borbott text-left mx-2 p-2">
            <div class="col-5"><i class="fas fa-arrows-alt-h"></i> Szélesség:</div>
            <div class="col-7">8 cm,</div>
          </div>
          <div class="row borbott text-left mx-2 p-2">
            <div class="col-5"><i class="fas fa-weight-hanging"></i> Súly:</div>
            <div class="col-7">3 dkg,</div>
          </div>
          <div class="row borbott text-left mx-2 p-2">
            <div class="col-5"><i class="fab fa-buffer"></i> Anyaga:</div>
            <div class="col-7">műanyag, vetex, szatén, strassz, gyöngy, fa, hungarocell</div>
          </div>
        </div>
        <div class="m-4 p-3">
          <a href="#contact"><button type="button" class="btn btn-outline-success btn-lg btn-block"><i class="far fa-envelope"></i> Ha rendelni szeretnél vagy kérdésed van</button></a>
        </div>
      </div>
      <div class="col-12 col-lg-6 p-3" id="haromviragoskubli">
        <div class="col-12 p-3 pt-5">
          <img class="img-fluid border-shadow p-3" src=<?php echo $kublik2[$index2]['img'] ?> alt="">
        </div>
        <div class="col-12 py-2 text-center">
        <form class="p-2" action="/cart" method="POST" id="kubliOrderSubmit">  
          <div class="row p-2" id="NamePiece" >
              <div class="col-6"><input type="hidden" name="id" value="<?php echo $kublik2[$index2]["id"] ?>"/><h5 class="mellow" name="name"><?php echo $kublik2[$index2]["name"] ?> </h5></div> 
              <div class="col-6"><input type="hidden" name="location" value="<?php echo $kublik2[10]["location"] ?>"/><h5 style="color:red;"><?php pieceChecker($kublik2[$index2]['piece']) ?></h5></div>
              <div class="col-6 py-2 d-flex justify-content-center">
              <div class="row">
              <button type="button" id="kublik2Decrement" class="input-number-decrement" <?php echo $kublik2[$index2]['piece'] === 0 ? "disabled" : "" ?>>–</button>
              <div id="haromviragosKubli"><input id="kublik2Piece" class="input-number" name="piece" value="1" type="text" min="1" max="<?php echo $kublik2[$index2]['piece'] ?>" <?php echo $kublik2[$index2]['piece'] === 0 ? "disabled" : "" ?>></div>
              <button type="button" id="kublik2Increment" class="input-number-increment" <?php echo $kublik2[$index2]['piece'] === 0 ? "disabled" : "" ?>>+</button>
              </div>
              </div>
              <div class="col-6">
                <button type="submit" id="kubliOrderSender" class="btn-block button" style="vertical-align:middle" <?php echo $kublik2[$index2]['piece'] === 0 ? "disabled" : "" ?>><span>Kosárba</span></button>
              </div>
          </div>
          </form>
        </div>
        <div class="row p-2 mx-4 ">
          <div class="col-6 col-md-3 bord">
          <a href="/kublik2?id=<?php echo $kublik2[0]["id"] ?>#haromviragoskubli" method="GET" ><img class="img-fluid hov" src="..public/img/kubli2/barackvirag.JPG" alt=""></a>
          </div>
          <div class="col-6 col-md-3 bord">
          <a href="/kublik2?id=<?php echo $kublik2[1]["id"] ?>#haromviragoskubli" method="GET" ><img class="img-fluid hov" src="..public/img/kubli2/bordo.JPG" alt=""></a>
          </div>
          <div class="col-6 col-md-3 bord">
          <a href="/kublik2?id=<?php echo $kublik2[2]["id"] ?>#haromviragoskubli" method="GET" ><img class="img-fluid hov" src="..public/img/kubli2/feher.JPG" alt=""></a>
          </div>
          <div class="col-6 col-md-3 bord">
          <a href="/kublik2?id=<?php echo $kublik2[3]["id"] ?>#haromviragoskubli" method="GET" ><img class="img-fluid hov" src="..public/img/kubli2/indigokek.JPG" alt=""></a>
          </div>
        </div>
        <div class="row p-2 mx-4 ">
          <div class="col-6 col-md-3 bord">
          <a href="/kublik2?id=<?php echo $kublik2[4]["id"] ?>#haromviragoskubli" method="GET" ><img class="img-fluid hov" src="..public/img/kubli2/malyva.JPG" alt=""></a>
          </div>
          <div class="col-6 col-md-3 bord">
          <a href="/kublik2?id=<?php echo $kublik2[5]["id"] ?>#haromviragoskubli" method="GET" ><img class="img-fluid hov" src="..public/img/kubli2/lila.JPG" alt=""></a>
          </div>
          <div class="col-6 col-md-3 bord">
          <a href="/kublik2?id=<?php echo $kublik2[6]["id"] ?>#haromviragoskubli" method="GET" ><img class="img-fluid hov" src="..public/img/kubli2/piros.JPG" alt=""></a>
          </div>
          <div class="col-6 col-md-3 bord">
          <a href="/kublik2?id=<?php echo $kublik2[7]["id"] ?>#haromviragoskubli" method="GET" ><img class="img-fluid hov" src="..public/img/kubli2/rozsaszin.JPG" alt=""></a>
          </div>
        </div>
        <div class="row p-2 mx-4">
          <div class="col-6 col-md-3 bord">
          <a href="/kublik2?id=<?php echo $kublik2[8]["id"] ?>#haromviragoskubli" method="GET" ><img class="img-fluid hov" src="..public/img/kubli2/turkiz.JPG" alt=""></a>
          </div>
          <div class="col-6 col-md-3 bord">
          <a href="/kublik2?id=<?php echo $kublik2[9]["id"] ?>#haromviragoskubli" method="GET" ><img class="img-fluid hov" src="..public/img/kubli2/pink.JPG" alt=""></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col21">
      <div class="col-12 px-5 text-center"><img class="img-fluid col-md-3 px-3" src="./public/img/logo5.png" alt=""></div>
      </div>
