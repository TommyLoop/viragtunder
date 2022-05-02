<?php

function karacsonyPieceChecker($piece) { 
  if ($piece <= 0) {
      $checker = "Rendelhető";
      echo $checker;
      
  } else if ($piece > 0 ) {
      $checker = $piece . " db készleten";
      echo $checker;
      
  }
}

$angel = $params['angel'];
$mikulas = $params['mikulas'];
$index = $params['foundProductIndex'] ?? 5;
$index2 = $params['foundProductIndex2'] ?? 0;
?>


<div id="karacsony">
  <div class="backcol2">
    <div class="row p-2">
      <div class="col-12 col-md-12">
        <img class="img-fluid my-2 py-2" src="..public/img/karacsony2.jpg"  alt="">
      </div>

      <div class="col-12 col-lg-6 d-block d-lg-none">
        <div>
          <h3 class="m-2 blue px-2 text-center">Angyalkák</h3>
          <h5 class="mellow m-3 px-2">
            Az egyvirágos küblik kis apró ajándékok, kedvességek. Kiváló dekorációs termékek, amelyek feldobják és öltöztetik a szobát.
          </h5>
          <h5 class="mellow m-3 px-2">Előszeretettel szokták adni: névnapokra, szülinapokra, anyák napjára és persze apró kedvesség miatt.
          </h5>
        </div>
        <div class="row">
          <div class=" col-12 text-center p-2 mt-2">
            <h3 class="mellow m-3 px-2 text-center">Ára: <span style="color:red; font-style:italic;"><?php echo $angel[6]["price"] ?> Ft</span></h3>
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
            <div class="col-7">9 cm,</div>
          </div>
          <div class="row borbott text-left mx-2 p-2">
            <div class="col-5"><i class="fas fa-arrows-alt-h"></i> Szélesség:</div>
            <div class="col-7">6,5 cm,</div>
          </div>
          <div class="row borbott text-left mx-2 p-2">
            <div class="col-5"><i class="fas fa-weight-hanging"></i> Súly:</div>
            <div class="col-7">0,8 dkg,</div>
          </div>
          <div class="row borbott text-left mx-2 p-2">
            <div class="col-5"><i class="fab fa-buffer"></i> Anyaga:</div>
            <div class="col-7">szatén, strassz, gyöngy, zsinór</div>
          </div>
        </div>
        <div class="m-4 p-4" id="mikulas">
          <a href="#contact"><button type="button" class="btn btn-outline-success btn-lg btn-block"><i class="far fa-envelope"></i> Ha rendelni szeretnél vagy kérdésed van</button></a>
        </div>
      </div>

      <div class="col-12 col-md-12 col-lg-6 p-3" id="angel">
        <div class="col-12 p-3 pt-5">
          <img class="img-fluid border-shadow p-3" src=<?php echo $angel[$index]['img'] ?> alt="">
        </div>
        <div class="col-12 py-2 text-center" >
        <form class="p-2" action="/cart" method="POST">  
          <div class="row p-2" id="NamePiece" >
              <div class="col-6"><input type="hidden" name="id" value="<?php echo $angel[$index]["id"] ?>"/><h5 class="mellow" name="name"><?php echo $angel[$index]["name"] ?> </h5></div> 
              <div class="col-6"><input type="hidden" name="location" value="<?php echo $angel[6]["location"] ?>"/><h5 style="color:red;"><?php karacsonyPieceChecker($angel[$index]['piece']) ?></h5></div>
              <div class="col-6 py-2 d-flex justify-content-center">
              <div class="row">
              <button type="button" id="angelDecrement" class="input-number-decrement" <?php echo $angel[$index]['piece'] === 0 ? "disabled" : "" ?>>–</button>
              <div id="angel1"><input id="angelPiece" class="input-number" name="piece" value="1" type="text" min="1" max="<?php echo $angel[$index]['piece'] ?>" <?php echo $angel[$index]['piece'] === 0 ? "disabled" : "" ?>></div>
              <button type="button" id="angelIncrement" class="input-number-increment" <?php echo $angel[$index]['piece'] === 0 ? "disabled" : "" ?>>+</button>
              </div>
              </div>
              <div class="col-6">
                <button type="submit" class="btn-block button" style="vertical-align:middle" <?php echo $angel[$index]['piece'] === 0 ? "disabled" : "" ?>><span>Kosárba</span></button>
              </div>
          </div>
          </form>
        </div>
        <div class="row p-2 mx-4 ">
          <div class="col-6 col-md-3 bord">
          <a href="/angel?id=<?php echo $angel[0]["id"] ?>#angel" method="GET" ><img class="img-fluid hov" src="..public/img/angel/feher.jpg" alt=""></a>
          </div>
          <div class="col-6 col-md-3 bord">
          <a href="/angel?id=<?php echo $angel[1]["id"] ?>#angel" method="GET" ><img class="img-fluid hov" src="..public/img/angel/kek.jpg" alt=""></a>
          </div>
          <div class="col-6 col-md-3 bord">
          <a href="/angel?id=<?php echo $angel[2]["id"] ?>#angel" method="GET" ><img class="img-fluid hov" src="..public/img/angel/krem.jpg" alt=""></a>
          </div>
          <div class="col-6 col-md-3 bord">
          <a href="/angel?id=<?php echo $angel[3]["id"] ?>#angel" method="GET" ><img class="img-fluid hov"  src="..public/img/angel/lila.jpg" alt=""></a>
          </div>
        </div>
        <div class="row p-2 mx-4">
          <div class="col-6 col-md-3 bord">
          <a href="/angel?id=<?php echo $angel[4]["id"] ?>#angel" method="GET" ><img class="img-fluid hov"  src="..public/img/angel/puderrozsaszin.jpg" alt=""></a>
          </div>
          <div class="col-6 col-md-3 bord">
          <a href="/angel?id=<?php echo $angel[5]["id"] ?>#angel" method="GET" ><img class="img-fluid hov"  src="..public/img/angel/vintage.jpg" alt=""></a>
          </div>
        </div>
      </div>

      <div class="col-12 col-lg-6 d-none d-lg-block">
        <div>
          <h3 class="m-2 blue px-2 text-center">Angyalkák</h3>
          <h5 class="mellow m-3 px-2">
            Az egyvirágos küblik kis apró ajándékok, kedvességek. Kiváló dekorációs termékek, amelyek feldobják és öltöztetik a szobát.
          </h5>
          <h5 class="mellow m-3 px-2">Előszeretettel szokták adni: névnapokra, szülinapokra, anyák napjára és persze apró kedvesség miatt.
          </h5>
        </div>
        <div class="row">
          <div class=" col-12 text-center p-2 mt-2">
            <h3 class="mellow m-3 px-2 text-center">Ára: <span style="color:red; font-style:italic;"><?php echo $angel[6]["price"] ?> Ft</span></h3>
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
            <div class="col-7">9 cm,</div>
          </div>
          <div class="row borbott text-left mx-2 p-2">
            <div class="col-5"><i class="fas fa-arrows-alt-h"></i> Szélesség:</div>
            <div class="col-7">6,5 cm,</div>
          </div>
          <div class="row borbott text-left mx-2 p-2">
            <div class="col-5"><i class="fas fa-weight-hanging"></i> Súly:</div>
            <div class="col-7">0,8 dkg,</div>
          </div>
          <div class="row borbott text-left mx-2 p-2">
            <div class="col-5"><i class="fab fa-buffer"></i> Anyaga:</div>
            <div class="col-7">szatén, strassz, gyöngy, zsinór</div>
          </div>
        </div>
        <div class="m-4 p-4" id="mikulas">
          <a href="#contact"><button type="button" class="btn btn-outline-success btn-lg btn-block"><i class="far fa-envelope"></i> Ha rendelni szeretnél vagy kérdésed van</button></a>
        </div>
      </div>

      <div class="row pt-4">
            <div class="col-12 col-lg-6">
              <div class="col-12 pt-2">
                <div>
                  <h3 class="m-2 blue px-2 text-center">Mikulásvirág</h3>
                  <h5 class="mellow m-3 px-2">
                    A 9 virágos rattanboxok már nagyobb ajándékok, kedvességek. Kiváló dekorációs termékek, amelyek feldobják és öltöztetik a szobát.
                  </h5>
                  <h5 class="mellow m-3 px-2">Előszeretettel szokták adni: névnapokra, szülinapokra, anyák napjára és persze apró kedvesség miatt.
                  </h5>
                </div>
                <div class="row">
                  <div class=" col-12 col-md-6 text-center p-2 mt-2">
                    <h3 class="mellow m-3 px-2 text-center">Ára: <span style="color:red; font-style:italic;"><?php echo $mikulas[3]["price"] ?> Ft</span></h3>
                  </div>
                </div>
              </div>
              <div class="col-12 pt-4">
                <div class="termekleiras text-center py-3 m-2">
                  <div class="row borbott text-left mx-2 p-2">
                    <div class="col-12"><i class="fas fa-cut"></i> Kézműves termék</div>
                  </div>
                  <div class="row borbott text-left mx-2 p-2">
                    <div class="col-5"><i class="fas fa-long-arrow-alt-up"></i> Magasság:</div>
                    <div class="col-7">3 cm,</div>
                  </div>
                  <div class="row borbott text-left mx-2 p-2">
                    <div class="col-5"><i class="fas fa-long-arrow-alt-right"></i> Hosszúság:</div>
                    <div class="col-7">13 cm,</div>
                  </div>
                  <div class="row borbott text-left mx-2 p-2">
                    <div class="col-5"><i class="fas fa-arrows-alt-h"></i> Szélesség:</div>
                    <div class="col-7">13 cm,</div>
                  </div>
                  <div class="row borbott text-left mx-2 p-2">
                    <div class="col-5"><i class="fas fa-weight-hanging"></i> Súly:</div>
                    <div class="col-7">0,4 dkg,</div>
                  </div>
                  <div class="row borbott text-left mx-2 p-2">
                    <div class="col-5"><i class="fab fa-buffer"></i> Anyaga:</div>
                    <div class="col-7">dekorgumi, szatén, gyöngy</div>
                  </div>
                </div>
                <div class="m-4 p-3">
                <a href="#contact"><button type="button" class="btn btn-outline-success btn-lg btn-block"><i class="far fa-envelope"></i> Ha rendelni szeretnél vagy kérdésed van</button></a>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6">
              <div class="col-12 p-3">
                <img class="img-fluid border-shadow p-3" src="<?php echo $mikulas[$index2]["img"] ?>">
              </div>
              <div class="col-12 py-2 text-center">
              <form class="p-2" action="/cart" method="POST">  
                 <div class="row p-2" >
                    <div class="col-6"><input type="hidden" name="id" value="<?php echo $mikulas[$index2]["id"] ?>"/><h5 class="mellow" name="name"><?php echo $mikulas[$index2]["name"] ?> </h5></div> 
                     <div class="col-6"><input type="hidden" name="location" value="<?php echo $mikulas[3]["location"] ?>"/><h5 style="color:red;"><?php karacsonyPieceChecker($mikulas[$index2]['piece']) ?></h5></div>
                     <div class="col-6 py-2 d-flex justify-content-center">
                        <div class="row">
                        <button type="button" id="mikulasDecrement" class="input-number-decrement" <?php echo $mikulas[$index2]['piece'] === 0 ? "disabled" : "" ?>>–</button>
                        <div id="mikulas1"><input id="mikulasPiece" class="input-number" name="piece" value="1" type="text" min="1" max="<?php echo $mikulas[$index2]['piece'] ?>" <?php echo $mikulas[$index2]['piece'] === 0 ? "disabled" : "" ?>></div>
                        <button type="button" id="mikulasIncrement" class="input-number-increment" <?php echo $mikulas[$index2]['piece'] === 0 ? "disabled" : "" ?>>+</button>
                        </div>
                        </div>
                        <div class="col-6">
                          <button type="submit" class="btn-block button" style="vertical-align:middle" <?php echo $mikulas[$index2]['piece'] === 0 ? "disabled" : "" ?>><span>Kosárba</span></button>
                        </div>
                 </div>
             </form>
              </div>
              <div class="col-12 py-2">
                <div class="row">
                  <div class="col-4 bord">
                  <a href="/mikulas?id=<?php echo $mikulas[0]["id"] ?>#mikulas" method="GET" ><img class="img-fluid hov" src="../public/img/mikulas/bordo.jpg" alt=""></a>
                  </div>
                  <div class="col-4 bord">
                  <a href="/mikulas?id=<?php echo $mikulas[1]["id"] ?>#mikulas" method="GET" ><img class="img-fluid hov" src="../public/img/mikulas/ekru.jpg" alt=""></a>
                  </div>
                  <div class="col-4 bord">
                  <a href="/mikulas?id=<?php echo $mikulas[2]["id"] ?>#mikulas" method="GET" ><img class="img-fluid hov" src="../public/img/mikulas/malyva.jpg" alt=""></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
  </div>
</div>
<div class="col21">
<div class="col-12 mellow px-5 text-center"><img class="img-fluid col-3 px-3" src="./public/img/logo5.png" alt=""></div>
</div>
