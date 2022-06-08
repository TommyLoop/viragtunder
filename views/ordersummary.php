<?php $order = json_decode(file_get_contents("./data/order.json"), true); 
    $total = 0;
    $transportpayment = json_decode(file_get_contents("./data/transportpayment.json"), true);
?>
<div class="container none">
    <div class="backcol py-5 px-3">
        <div class="row p-2 text-center">
            <div class="col-12 py-2 row">
                    <div class="d-none d-lg-block col-md-3"><img class="img-fluid col-12" src="..public/img/transport.png" alt="transport.png"></div>
                    <div class="col-12 col-lg-6 mt-lg-4 py-4"><h1 class="p-4 blue termekleiras border-shadow text-center" id="cart">Rendelés összegző:</h1></div>
                    <div class="d-none d-lg-block col-md-3"><img class="img-fluid col-12" src="..public/img/payment.png" alt="payment.png"></div>
            </div>
            <div class="col-12 col-md-6 p-4 mt-4">
                <h3 class="col-12 blue p-2" id="transport"><u>Számlázási adatok:</u></h3>
                <div class="mellow row p-2">
                    <div class="col-12 termekleiras border-shadow col-lg-12 p-2">
                        <div class="row p-2">
                        <div class="col-5 blue"><h5>Számlázási név:</h5></div>
                        <div class="col-7"><h5><?php echo $params["name"] ?></h5></div>
                        <div class="col-5 blue"><h5>Irányítószám:</h5></div>
                        <div class="col-7"><h5><?php echo $params["zipcode"] ?></h5></div>
                        <div class="col-5 blue"><h5>Város:</h5></div>
                        <div class="col-7"><h5><?php echo $params["city"] ?></h5></div>
                        <div class="col-5 blue"><h5>Cím:</h5></div>
                        <div class="col-7"><h5><?php echo $params["address"] ?></h5></div>
                        <div class="col-5 blue"><h5>Telefonszám:</h5></div>
                        <div class="col-7"><h5><?php echo $params["phone"] ?></h5></div>
                        <div class="col-5 blue"><h5>Adószám:</h5></div>
                        <div class="col-7"><h5><?php echo $params["taxnumber"] ?></h5></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 p-4 mt-4">
                <h3 class="col-12 blue p-2" id="transport"><u>Szállítási adatok:</u></h3>
                <div class="mellow row p-2">
                    <div class="col-12 termekleiras border-shadow col-lg-12 p-2">
                        <div class="row p-2">
                        <div class="col-5 blue"><h5>Szállítási név:</h5></div>
                        <div class="col-7"><h5><?php echo $params["transportName"] ?></h5></div>
                        <div class="col-5 blue"><h5>Irányítószám:</h5></div>
                        <div class="col-7"><h5><?php echo $params["transportZipcode"] ?></h5></div>
                        <div class="col-5 blue"><h5>Város:</h5></div>
                        <div class="col-7"><h5><?php echo $params["transportCity"] ?></h5></div>
                        <div class="col-5 blue"><h5>Cím:</h5></div>
                        <div class="col-7"><h5><?php echo $params["transportAddress"] ?></h5></div>
                        <div class="col-5 blue"><h5>Telefonszám:</h5></div>
                        <div class="col-7"><h5><?php echo $params["transportPhone"] ?></h5></div>
                        <div class="col-5 blue"><h5>Megjegyzés:</h5></div>
                        <div class="col-7"><h5><?php echo $params["transportComment"] ?></h5></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 pt-4 p-5 row">
            <div class="col-6 col-md-4 mellow">Termék:</div>
            <div class="col-6 col-md-2 mellow">Mennyiség:</div>
            <div class="col-3 d-none d-md-block mellow">Egységár:</div>
            <div class="col-3 d-none d-md-block mellow">Ára:</div>
            <div class="col-12 py-3"><hr></div>
            <?php if($order === []) : ?>
                <div class="col-12 p-4 text-center">
                <h1 class="p-4 text-center">A kosara jelenleg üres!</h1>
                </div>
            <?php else : ?>
                <?php foreach($order as $order) : ?>
                <div class="col-2 col-md-1 mellow none "><img class="img-fluid" src="<?php echo $order["img"]?>" alt=""></div>
                <div class="col-6 col-md-3 mellow text-left pt-2"><?php echo $order["name"]?> <?php echo $order["type"]?></div>
                <div class="col-4 col-md-2 mellow pt-2">
                <?php if($params["editedProductId"] === $order["id"]): ?>
                <form action="/edited" method="POST">
                <input type="hidden" name="location" value="<?php echo $order["location"] ?>"/>
                <input type="hidden" name="id" value="<?php echo $order["id"] ?>"/>
                <input type="hidden" name="previous" value="<?php echo $order["previous"] ?>"/>
                <input type="hidden" name="orderPiece" value="<?php echo $order["piece"] ?>"/>
                <input class="w-30" type="number" name="piece" size="3" min="1" max="<?php echo $order['stock'] + $order['piece'] ?>" placeholder="<?php echo $order['piece'] ?>"></input>
                <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                <a href="/cart"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                </form>
                <?php else : ?>
                <?php echo $order["piece"]?> db
                <?php endif; ?>
                </div>
                <div class="col-6 col-md-3 mellow pt-2">x <?php echo $order["price"]?> Ft</div>
                <div class="col-6 col-md-3 mellow pt-2"><?php echo $productPrice = $order["piece"]*($order["price"])?> Ft</div>
                <div class="col-12 py-3"><hr></div>
                <?php $total += $productPrice; ?>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="col-12 mellow text-left px-md-4 row">
                <div class="col-6 col-md-4"><i class="fas fa-check-square px-2"></i><?php echo $transportpayment[0]["content"] ?></div>
                <div class="col-6 col-md-8 pr-md-5 text-right"><?php echo $transportpayment[0]["price"] ?> Ft</div>
            </div>
            <div class="col-12 mellow py-3"><hr></div>
            <div class="col-12 mellow text-left pb-3 px-md-4 row">
                <div class="col-12 col-md-7"><i class="fas fa-check-square px-2"></i><?php echo $transportpayment[1]["content"] ?></div>
                <div class="col-6 col-md-3 text-right">Összesen: 
                </div>
                <div class="col-6 col-md-2 text-center"><?php echo ($transportpayment[0]["price"] + $total) ?> Ft</div>
            </div>
            <div class="col-12 row d-flex justify-content-center mellow">
                <div class="col-12 col-lg-12 p-2 d-flex justify-content-center">
                    <a href="/transportandpayment" class="px-3"><button type="button" class="col-12 col-lg-12 btn-block back px-5"><span>Vissza</span></button></a>
                </div>
                <div class="col-12 col-lg-12 p-2 d-flex justify-content-center">
                    <button type="button" class="col-6 col-lg-3 btn-block next px-5 <?php echo $order === [] ? "disabled" : "" ?>"><span>Megrendel</span></button>
                </div>
            </div>
            </div>
        </div>
            
    </div>
</div>