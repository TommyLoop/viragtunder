<?php

function valentinPieceChecker($piece) { 
  if ($piece <= 0) {
      $checker = "Rendelhető";
      echo $checker;
      
  } else if ($piece > 0 ) {
      $checker = $piece . " db készleten";
      echo $checker;
      
  }
}

$kaspo1 = $params['kaspo1'];
$kaspo2 = $params['kaspo2'];
$index = $params['foundProductIndex'] ?? 5;
$index2 = $params['foundProductIndex2'] ?? 0;
?>

  


<div id="valentin">
  <div class="backcol">
    <div class="row p-2">
      <div class="col-12 col-md-12" id="">
        <img class="img-fluid my-2 py-2" src="..public/img/valentin2.jpg"  alt="">
      </div>

      <div class="col-12 col-lg-6 d-block d-lg-none">
        <div>
          <h3 class="m-2 blue px-2 text-center">Nagy kaspós virág</h3>
          <h5 class="mellow m-3 px-2">
            Az egyvirágos küblik kis apró ajándékok, kedvességek. Kiváló dekorációs termékek, amelyek feldobják és öltöztetik a szobát.
          </h5>
          <h5 class="mellow m-3 px-2">Előszeretettel szokták adni: névnapokra, szülinapokra, anyák napjára és persze apró kedvesség miatt.
          </h5>
        </div>
        <div class="row">
          <div class=" col-12 text-center p-2 mt-2">
            <h3 class="mellow m-3 px-2 text-center">Ára: <span style="color:red; font-style:italic;"><?php echo $kaspo1[6]["price"] ?> Ft</span></h3>
          </div>

        </div>
        <div class="termekleiras text-center py-3 m-2">
          <div class="row borbott text-left mx-2 p-2">
            <div class="col-12"><i class="fas fa-cut"></i> Kézműves termék</div>
          </div>
          <div class="row borbott text-left mx-2 p-2">
            <div class="col-5"><i class="fas fa-long-arrow-alt-up"></i> Magasság:</div>
            <div class="col-7">35 cm,</div>
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
            <div class="col-7">35-77 dkg,</div>
          </div>
          <div class="row borbott text-left mx-2 p-2">
            <div class="col-5"><i class="fab fa-buffer"></i> Anyaga:</div>
            <div class="col-7">kaspó, hungarocell, fa, vetex, szatén, gyöngy, csipke, kő</div>
          </div>
        </div>
        <div class="m-4 p-4" id="kaspo2">
          <a href="#contact"><button type="button" class="btn btn-outline-success btn-lg btn-block"><i class="far fa-envelope"></i> Ha rendelni szeretnél vagy kérdésed van</button></a>
        </div>
      </div>
      
      <div class="col-12 col-lg-6 p-3" id="kaspo1">
        <div class="col-12 p-3 pt-5">
          <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner border-shadow p-3">
              <div class="carousel-item active ">
              <img class="img-fluid" src=<?php echo $kaspo1[$index]['img'] ?> alt="">
              </div>
              <div class="carousel-item">
              <img class="img-fluid" src=<?php echo $kaspo1[$index]['img2'] ?> alt="">
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 py-2 text-center" >
        <form class="p-2" action="/cart" method="POST">  
          <div class="row p-2" >
              <div class="col-6"><input type="hidden" name="id" value="<?php echo $kaspo1[$index]["id"] ?>"/><h5 class="mellow" name="name"><?php echo $kaspo1[$index]["name"] ?> </h5></div> 
              <div class="col-6"><input type="hidden" name="location" value="<?php echo $kaspo1[6]["location"] ?>"/><h5 style="color:red;"><?php valentinPieceChecker($kaspo1[$index]['piece']) ?></h5></div>
              <div class="col-6 py-2 d-flex justify-content-center">
              <div class="row">
              <button type="button" id="kaspo1Decrement" class="input-number-decrement" <?php echo $kaspo1[$index]['piece'] === 0 ? "disabled" : "" ?>>–</button>
              <div id="kaspo-1"><input id="kaspo1Piece" class="input-number" name="piece" value="1" type="text" min="1" max="<?php echo $kaspo1[$index]['piece'] ?>" <?php echo $kaspo1[$index]['piece'] === 0 ? "disabled" : "" ?>></div>
              <button type="button" id="kaspo1Increment" class="input-number-increment" <?php echo $kaspo1[$index]['piece'] === 0 ? "disabled" : "" ?>>+</button>
              </div>
              </div>
              <div class="col-6">
                <button type="submit" class="btn-block button" style="vertical-align:middle" <?php echo $kaspo1[$index]['piece'] === 0 ? "disabled" : "" ?>><span>Kosárba</span></button>
              </div>
          </div>
          </form>
        </div>
        <div class="row p-2 mx-4 ">
          <div class="col-6 col-md-3 bord">
          <a href="/kaspo1?id=<?php echo $kaspo1[0]["id"] ?>#kaspo1" method="GET" ><img class="img-fluid hov" src="../public/img/valentin/Nkaspo/piros01.jpg" alt=""></a>
          </div>
          <div class="col-6 col-md-3 bord">
          <a href="/kaspo1?id=<?php echo $kaspo1[1]["id"] ?>#kaspo1" method="GET" ><img class="img-fluid hov" src="../public/img/valentin/Nkaspo/rozsaszin01.jpg" alt=""></a>
          </div>
          <div class="col-6 col-md-3 bord">
          <a href="/kaspo1?id=<?php echo $kaspo1[2]["id"] ?>#kaspo1" method="GET" ><img class="img-fluid hov" src="../public/img/valentin/Nkaspo/szinatmenet0101.jpg" alt=""></a>
          </div>
          <div class="col-6 col-md-3 bord">
          <a href="/kaspo1?id=<?php echo $kaspo1[3]["id"] ?>#kaspo1" method="GET" ><img class="img-fluid hov"  src="../public/img/valentin/Nkaspo/szinatmenet0201.jpg" alt=""></a>
          </div>
        </div>
        <div class="row p-2 mx-4">
          <div class="col-6 col-md-3 bord">
          <a href="/kaspo1?id=<?php echo $kaspo1[4]["id"] ?>#kaspo1" method="GET" ><img class="img-fluid hov"  src="../public/img/valentin/Nkaspo/vintage0101.jpg" alt=""></a>
          </div>
          <div class="col-6 col-md-3 bord">
          <a href="/kaspo1?id=<?php echo $kaspo1[5]["id"] ?>#kaspo1" method="GET" ><img class="img-fluid hov"  src="../public/img/valentin/Nkaspo/vintage0201.jpg" alt=""></a>
          </div>
        </div>
      </div>

      <div class="col-12 col-lg-6 d-none d-lg-block">
        <div>
          <h3 class="m-2 blue px-2 text-center">Nagy kaspós virág</h3>
          <h5 class="mellow m-3 px-2">
            Az egyvirágos küblik kis apró ajándékok, kedvességek. Kiváló dekorációs termékek, amelyek feldobják és öltöztetik a szobát.
          </h5>
          <h5 class="mellow m-3 px-2">Előszeretettel szokták adni: névnapokra, szülinapokra, anyák napjára és persze apró kedvesség miatt.
          </h5>
        </div>
        <div class="row">
          <div class=" col-12 text-center p-2 mt-2">
            <h3 class="mellow m-3 px-2 text-center">Ára: <span style="color:red; font-style:italic;"><?php echo $kaspo1[6]["price"] ?> Ft</span></h3>
          </div>

        </div>
        <div class="termekleiras text-center py-3 m-2">
          <div class="row borbott text-left mx-2 p-2">
            <div class="col-12"><i class="fas fa-cut"></i> Kézműves termék</div>
          </div>
          <div class="row borbott text-left mx-2 p-2">
            <div class="col-5"><i class="fas fa-long-arrow-alt-up"></i> Magasság:</div>
            <div class="col-7">35 cm,</div>
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
            <div class="col-7">35-77 dkg,</div>
          </div>
          <div class="row borbott text-left mx-2 p-2">
            <div class="col-5"><i class="fab fa-buffer"></i> Anyaga:</div>
            <div class="col-7">kaspó, hungarocell, fa, vetex, szatén, gyöngy, csipke, kő</div>
          </div>
        </div>
        <div class="m-4 p-4" id="kaspo2">
          <a href="#contact"><button type="button" class="btn btn-outline-success btn-lg btn-block"><i class="far fa-envelope"></i> Ha rendelni szeretnél vagy kérdésed van</button></a>
        </div>
      </div>
      <div class="row pt-4">
            <div class="col-12 col-lg-6">
              <div class="col-12 pt-2">
                <div>
                  <h3 class="m-2 blue px-2 text-center">Kis kaspós virág</h3>
                  <h5 class="mellow m-3 px-2">
                    A 9 virágos rattanboxok már nagyobb ajándékok, kedvességek. Kiváló dekorációs termékek, amelyek feldobják és öltöztetik a szobát.
                  </h5>
                  <h5 class="mellow m-3 px-2">Előszeretettel szokták adni: névnapokra, szülinapokra, anyák napjára és persze apró kedvesség miatt.
                  </h5>
                </div>
                <div class="row">
                  <div class=" col-12 col-md-6 text-center p-2 mt-2">
                    <h3 class="mellow m-3 px-2 text-center">Ára: <span style="color:red; font-style:italic;"><?php echo $kaspo2[4]["price"] ?> Ft</span></h3>
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
                    <div class="col-7">22-24 cm,</div>
                  </div>
                  <div class="row borbott text-left mx-2 p-2">
                    <div class="col-5"><i class="fas fa-long-arrow-alt-right"></i> Hosszúság:</div>
                    <div class="col-7">10-12 cm,</div>
                  </div>
                  <div class="row borbott text-left mx-2 p-2">
                    <div class="col-5"><i class="fas fa-arrows-alt-h"></i> Szélesség:</div>
                    <div class="col-7">10-12 cm,</div>
                  </div>
                  <div class="row borbott text-left mx-2 p-2">
                    <div class="col-5"><i class="fas fa-weight-hanging"></i> Súly:</div>
                    <div class="col-7">42-44 dkg,</div>
                  </div>
                  <div class="row borbott text-left mx-2 p-2">
                    <div class="col-5"><i class="fab fa-buffer"></i> Anyaga:</div>
                    <div class="col-7">kerámia, hungarocell, vetex, fa, szatén, gyöngy, csipke, strassz, kő</div>
                  </div>
                </div>
                <div class="m-4 p-3">
                <a href="#contact"><button type="button" class="btn btn-outline-success btn-lg btn-block"><i class="far fa-envelope"></i> Ha rendelni szeretnél vagy kérdésed van</button></a>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6">
              <div class="col-12 p-3 pt-5">
                  <div id="carouselExampleSlidesOnly2" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner border-shadow p-3">
                    <div class="carousel-item active">
                    <img class="img-fluid" src="<?php echo $kaspo2[$index2]["img"] ?>">
                    </div>
                    <div class="carousel-item">
                    <img class="img-fluid" src="<?php echo $kaspo2[$index2]["img2"] ?>">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 py-2 text-center">
              <form class="p-2" action="/cart" method="POST">  
                 <div class="row p-2" >
                    <div class="col-6"><input type="hidden" name="id" value="<?php echo $kaspo2[$index2]["id"] ?>"/><h5 class="mellow" name="name"><?php echo $kaspo2[$index2]["name"] ?> </h5></div> 
                     <div class="col-6"><input type="hidden" name="location" value="<?php echo $kaspo2[4]["location"] ?>"/><h5 style="color:red;"><?php valentinPieceChecker($kaspo2[$index2]['piece']) ?></h5></div>
                     <div class="col-6 py-2 d-flex justify-content-center">
                      <div class="row">
                      <button type="button" id="kaspo2Decrement" class="input-number-decrement" <?php echo $kaspo2[$index2]['piece'] === 0 ? "disabled" : "" ?>>–</button>
                      <div id="kaspo-2"><input id="kaspo2Piece" class="input-number" name="piece" value="1" type="text" min="1" max="<?php echo $kaspo2[$index2]['piece'] ?>" <?php echo $kaspo2[$index2]['piece'] === 0 ? "disabled" : "" ?>></div>
                      <button type="button" id="kaspo2Increment" class="input-number-increment" <?php echo $kaspo2[$index2]['piece'] === 0 ? "disabled" : "" ?>>+</button>
                      </div>
                       </div>
                      <div class="col-6">
                      <button type="submit" class="btn-block button" style="vertical-align:middle" <?php echo $kaspo2[$index2]['piece'] === 0 ? "disabled" : "" ?>><span>Kosárba</span></button>
                      </div>
                 </div>
             </form>
              </div>
              <div class="col-12 py-2">
                <div class="row">
                  <div class="col-6 col-md-3 bord">
                  <a href="/kaspo2?id=<?php echo $kaspo2[0]["id"] ?>#kaspo2" method="GET" ><img class="img-fluid hov" src="../public/img/valentin/Kkaspo/bordo0101.jpg" alt=""></a>
                  </div>
                  <div class="col-6 col-md-3 bord">
                  <a href="/kaspo2?id=<?php echo $kaspo2[1]["id"] ?>#kaspo2" method="GET" ><img class="img-fluid hov" src="../public/img/valentin/Kkaspo/bordo0201.jpg" alt=""></a>
                  </div>
                  <div class="col-6 col-md-3 bord">
                  <a href="/kaspo2?id=<?php echo $kaspo2[2]["id"] ?>#kaspo2" method="GET" ><img class="img-fluid hov" src="../public/img/valentin/Kkaspo/piros0101.jpg" alt=""></a>
                  </div>
                  <div class="col-6 col-md-3 bord">
                  <a href="/kaspo2?id=<?php echo $kaspo2[3]["id"] ?>#kaspo2" method="GET" ><img class="img-fluid hov" src="../public/img/valentin/Kkaspo/piros0201.jpg" alt=""></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
  </div>
</div>
<div class="col12">
<div class="col-12 px-5 text-center"><img class="img-fluid col-md-3 px-3" src="./public/img/logo5.png" alt=""></div>
</div>
