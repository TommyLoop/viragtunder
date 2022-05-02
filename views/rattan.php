
<?php

function rattanPieceChecker($piece) {
  if ($piece <= 0) {
      $checker = "Rendelhető";
      echo $checker;

  } else if ($piece > 0 ) {
      $checker = $piece . " db készleten";
      echo $checker;

  }
}

$rattan = $params['rattan'];
$rattan2 = $params['rattan2'];
$index = $params['foundProductIndex'] ?? 2;
$index2 = $params['foundProductIndex2'] ?? 1;
?>


<div id="rattan">
  <div class="backcol">
    <div class="row p-2">
      <div class="col-12 col-md-12">
        <img class="img-fluid my-2 py-2" src="../public/img/rattanok.jpg" alt="">
      </div>
      <div class="row">
        <div class="col-12 col-lg-6 pt-2">
          <div>
            <h3 class="m-2 blue px-2 text-center">5 virágos rattanbox</h3>
            <h5 class="mellow m-3 px-2">
              Az 5 virágos rattanboxok közepes ajándékok, kedvességek. Kiváló dekorációs termékek, amelyek feldobják és öltöztetik a szobát.
            </h5>
            <h5 class="mellow m-3 px-2">Előszeretettel szokták adni: névnapokra, szülinapokra, anyák napjára és persze apró kedvesség miatt.
            </h5>
          </div>
          <div class="row">
            <div class=" col-12 text-center p-2 mt-2">
              <h3 class="mellow m-3 px-2 text-center">Ára: <span style="color:red; font-style:italic;"><?php echo $rattan[9]["price"] ?> Ft</span></h3>
            </div>
          </div>

        </div>
        <div class="col-12 col-lg-6 pt-4">
          <div class="termekleiras text-center py-3 m-2">
            <div class="row borbott text-left mx-2 p-2">
              <div class="col-12"><i class="fas fa-cut"></i> Kézműves termék</div>
            </div>
            <div class="row borbott text-left mx-2 p-2">
              <div class="col-5"><i class="fas fa-long-arrow-alt-up"></i> Magasság:</div>
              <div class="col-7">12 cm,</div>
            </div>
            <div class="row borbott text-left mx-2 p-2">
              <div class="col-5"><i class="fas fa-long-arrow-alt-right"></i> Hosszúság:</div>
              <div class="col-7">11 cm,</div>
            </div>
            <div class="row borbott text-left mx-2 p-2">
              <div class="col-5"><i class="fas fa-arrows-alt-h"></i> Szélesség:</div>
              <div class="col-7">11 cm,</div>
            </div>
            <div class="row borbott text-left mx-2 p-2">
              <div class="col-5"><i class="fas fa-weight-hanging"></i> Súly:</div>
              <div class="col-7">14 dkg,</div>
            </div>
            <div class="row borbott text-left mx-2 p-2">
              <div class="col-5"><i class="fab fa-buffer"></i> Anyaga:</div>
              <div class="col-7">textil, vetex, fém, szatén, strassz, gyöngy, művirág, fa, csipke, hungarocell</div>
            </div>
          </div>
          <div class="m-3 p-3" id="otviragosrattan">
          <a href="#contact"><button type="button" class="btn btn-outline-success btn-lg btn-block"><i class="far fa-envelope"></i> Ha rendelni szeretnél vagy kérdésed van</button></a>
        </div>
        </div>
        <div class="col-12 p-md-2" >
          <div class="row none py-3">
            <div class="col-12 col-md-6" id="FirstRattan">
              <img class="img-fluid" src="<?php echo $rattan[$index]["img"] ?>" alt="">
            </div>
            <div class="col-12 col-md-6" id="SecondRattan">
              <img class="img-fluid" src="<?php echo $rattan[$index]["img2"] ?>" alt="">
            </div>
            <div class="col-12 pt-2 text-center">
            <form action="/cart" method="POST"> 
                <div class="row">
                    <div class="col-12 col-lg-3 p-2">
                    <input type="hidden" name="id" value="<?php echo $rattan[$index]["id"] ?>"/>
                    <h3 class="mellow"><?php echo $rattan[$index]["name"] ?></h3>
                    </div>
                    <div class="col-12 col-lg-3 p-2 my-2">
                    <input type="hidden" name="location" value="<?php echo $rattan[9]["location"] ?>"/>
                    <h5 style="color:red;"><?php echo rattanPieceChecker($rattan[$index]["piece"]) ?></h5>
                    </div>
                    <div class="col-12 col-lg-3 mt-2 py-2 d-flex justify-content-center">
                    <div class="row">
                        <button type="button" id="rattanDecrement" class="input-number-decrement" <?php echo $rattan[$index]['piece'] === 0 ? "disabled" : "" ?>>–</button>
                        <div id="rattan1"><input id="rattanPiece" class="input-number" name="piece" value="1" type="text" min="1" max="<?php echo $rattan[$index]['piece'] ?>" <?php echo $rattan[$index]['piece'] === 0 ? "disabled" : "" ?>></div>
                        <button type="button" id="rattanIncrement" class="input-number-increment" <?php echo $rattan[$index]['piece'] === 0 ? "disabled" : "" ?>>+</button>
                      </div>
                    </div>
                    <div class="col-12 col-lg-3 py-3 px-5">
                    <button type="submit" class="btn-block button" style="vertical-align:middle" <?php echo $rattan[$index]['piece'] === 0 ? "disabled" : "" ?>><span>Kosárba</span></button>
                    </div>
                </div>
            </form>    
            </div>
            <div class="col-12 col-lg-4 py-sm-3 py-lg-2">
              <div class="row">
                <div class="col-4 bord">
                <a href="/rattan?id=<?php echo $rattan[0]["id"] ?>#otviragosrattan" method="GET" ><img class="img-fluid hov" src="../public/img/rattan/5flower/lila01.JPG" alt=""></a>
                </div>
                <div class="col-4 bord">
                <a href="/rattan?id=<?php echo $rattan[1]["id"] ?>#otviragosrattan" method="GET" ><img class="img-fluid hov" src="../public/img/rattan/5flower/lilarozsaszin01.JPG" alt=""></a>
                </div>
                <div class="col-4 bord">
                <a href="/rattan?id=<?php echo $rattan[2]["id"] ?>#otviragosrattan" method="GET" ><img class="img-fluid hov" src="../public/img/rattan/5flower/rozsaszinekru01.JPG" alt=""></a> 
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-4 py-sm-3 py-lg-2">
              <div class="row">
                <div class="col-4 bord">
                <a href="/rattan?id=<?php echo $rattan[3]["id"] ?>#otviragosrattan" method="GET" ><img class="img-fluid hov" src="../public/img/rattan/5flower/vintage01.JPG" alt=""></a>
                </div>
                <div class="col-4 bord">
                <a href="/rattan?id=<?php echo $rattan[4]["id"] ?>#otviragosrattan" method="GET" ><img class="img-fluid hov" src="../public/img/rattan/5flower/vintageekru01.JPG" alt=""></a>
                </div>
                <div class="col-4 bord">
                <a href="/rattan?id=<?php echo $rattan[5]["id"] ?>#otviragosrattan" method="GET" ><img class="img-fluid hov" src="../public/img/rattan/5flower/feherrozsaszin01.JPG" alt=""></a>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-4 py-sm-3 py-lg-2">
              <div class="row">
                <div class="col-4 bord">
                <a href="/rattan?id=<?php echo $rattan[6]["id"] ?>#otviragosrattan" method="GET" ><img class="img-fluid hov" src="../public/img/rattan/5flower/malyvafeher01.JPG" alt=""></a>
                </div>
                <div class="col-4 bord">
                <a href="/rattan?id=<?php echo $rattan[7]["id"] ?>#otviragosrattan" method="GET" ><img class="img-fluid hov" src="../public/img/rattan/5flower/kekfeher01.JPG" alt=""></a>
                </div>
                <div class="col-4 bord">
                <a href="/rattan?id=<?php echo $rattan[8]["id"] ?>#otviragosrattan" method="GET" ><img class="img-fluid hov" src="../public/img/rattan/5flower/lilakek01.JPG" alt=""></a>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-lg-6 pt-4">
              <div class="col-12 pt-2">
                <div>
                  <h3 class="m-2 blue px-2 text-center">9 virágos rattanbox</h3>
                  <h5 class="mellow m-3 px-2">
                    A 9 virágos rattanboxok már nagyobb ajándékok, kedvességek. Kiváló dekorációs termékek, amelyek feldobják és öltöztetik a szobát.
                  </h5>
                  <h5 class="mellow m-3 px-2">Előszeretettel szokták adni: névnapokra, szülinapokra, anyák napjára és persze apró kedvesség miatt.
                  </h5>
                </div>
                <div class="row">
                  <div class=" col-12 text-center p-2 mt-2">
                    <h3 class="mellow m-3 px-2 text-center">Ára: <span style="color:red; font-style:italic;"><?php echo $rattan2[3]["price"] ?> Ft</span></h3>
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
                    <div class="col-7">11 cm,</div>
                  </div>
                  <div class="row borbott text-left mx-2 p-2">
                    <div class="col-5"><i class="fas fa-long-arrow-alt-right"></i> Hosszúság:</div>
                    <div class="col-7">16 cm,</div>
                  </div>
                  <div class="row borbott text-left mx-2 p-2">
                    <div class="col-5"><i class="fas fa-arrows-alt-h"></i> Szélesség:</div>
                    <div class="col-7">16 cm,</div>
                  </div>
                  <div class="row borbott text-left mx-2 p-2">
                    <div class="col-5"><i class="fas fa-weight-hanging"></i> Súly:</div>
                    <div class="col-7">16 dkg,</div>
                  </div>
                  <div class="row borbott text-left mx-2 p-2">
                    <div class="col-5"><i class="fab fa-buffer"></i> Anyaga:</div>
                    <div class="col-7">textil, fém, szatén, gyöngy, fa, csipke, hungarocell, vetex</div>
                  </div>
                </div>
                <div class="m-4 p-3">
                <a href="#contact"><button type="button" class="btn btn-outline-success btn-lg btn-block"><i class="far fa-envelope"></i> Ha rendelni szeretnél vagy kérdésed van</button></a>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6 pt-4" id="kilencviragosrattan">
              <div class="col-12 p-3" id="ThirdRattan">
                <img class="img-fluid border-shadow p-3" src="<?php echo $rattan2[$index2]["img"] ?>">
              </div>
              <div class="col-12 py-2 text-center" id="rattanNamePiece2">
              <form class="p-2" action="/cart" method="POST">  
                 <div class="row p-2" >
                    <div class="col-6"><input type="hidden" name="id" value="<?php echo $rattan2[$index2]["id"] ?>"/><h5 class="mellow" name="name"><?php echo $rattan2[$index2]["name"] ?> </h5></div> 
                     <div class="col-6"><input type="hidden" name="location" value="<?php echo $rattan2[3]["location"] ?>"/><h5 style="color:red;"><?php rattanPieceChecker($rattan2[$index2]['piece']) ?></h5></div>
                     <div class="col-6 py-2 d-flex justify-content-center">
                     <div class="row">
                        <button type="button" id="rattan2Decrement" class="input-number-decrement" <?php echo $rattan2[$index2]['piece'] === 0 ? "disabled" : "" ?>>–</button>
                        <div id="rattan2"><input id="rattan2Piece" class="input-number" name="piece" value="1" type="text" min="1" max="<?php echo $rattan2[$index2]['piece'] ?>" <?php echo $rattan2[$index2]['piece'] === 0 ? "disabled" : "" ?>></div>
                        <button type="button" id="rattan2Increment" class="input-number-increment" <?php echo $rattan2[$index2]['piece'] === 0 ? "disabled" : "" ?>>+</button>
                      </div>
                      </div>
                     <div class="col-6"><button type="submit" class="btn-block button" style="vertical-align:middle" <?php echo $rattan2[$index2]['piece'] === 0 ? "disabled" : "" ?>><span>Kosárba</span></button></div>
                 </div>
             </form>
              </div>
              <div class="col-12 py-2">
                <div class="row">
                  <div class="col-4 bord">
                  <a href="/rattan2?id=<?php echo $rattan2[0]["id"] ?>#kilencviragosrattan" method="GET" ><img class="img-fluid hov" src="../public/img/rattan/9flower/lilafeher.JPG" alt=""></a>
                  </div>
                  <div class="col-4 bord">
                  <a href="/rattan2?id=<?php echo $rattan2[1]["id"] ?>#kilencviragosrattan" method="GET" ><img class="img-fluid hov" src="../public/img/rattan/9flower/lilarozsaszin.JPG" alt=""></a>
                  </div>
                  <div class="col-4 bord">
                  <a href="/rattan2?id=<?php echo $rattan2[2]["id"] ?>#kilencviragosrattan" method="GET" ><img class="img-fluid hov" src="../public/img/rattan/9flower/rozsaszinekru.JPG" alt=""></a>
                  </div>
                </div>
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