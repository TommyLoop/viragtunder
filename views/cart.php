<?php $order = json_decode(file_get_contents("./data/order.json"), true); 
    $total = 0;
?>

<div class="container none">
    <div class="card card-body backcol py-5">
        <div class="row p-2 text-center">
            <div class="col-12 pt-2 row">
                <div class="d-none d-lg-block col-md-3"><img class="img-fluid col-12" src="..public/img/transport.png" alt="transport.png"></div>
                <div class="col-12 col-lg-6 mt-lg-4 py-4"><h1 class="p-4 blue termekleiras border-shadow text-center" id="cart">A vásárlás menete:</h1></div>
                <div class="d-none d-lg-block col-md-3"><img class="img-fluid col-12" src="..public/img/payment.png" alt="payment.png"></div>
            </div>
            <div class="col-4 col-md-4 greeny p-md-2">1<span class="vertical"> lépés</span>
                <h5 class="col-12 d-none d-md-block">Helyezze a kosárba a megvásárolandó termékeit:</h5><hr class="green d-none d-md-block">
            </div>
            <div class="col-8 greeny pt-5 d-block d-md-none"><h5>Helyezze a kosárba a megvásárolandó termékeit:</h5></div>
            <hr class="col-10 green d-block d-md-none">
            <div class="col-4 col-md-4 redy p-2">2<span class="vertical"> lépés</span>
                <h5 class="col-12 d-none d-md-block">A bejelentkezés után, adja meg a számlázási és a postázási adtait:</h5><hr class="red d-none d-md-block">
            </div>
            <div class="col-8 redy pt-5 d-block d-md-none"><h5>A bejelentkezés után, adja meg a számlázási és a postázási adtait:</h5></div>
            <hr class="col-10 red d-block d-md-none">
            <div class="col-4 col-md-4 redy p-2">3<span class="vertical"> lépés</span>
                <h5 class="col-12 d-none d-md-block">Ezt követően válassza ki szállítási és a fizetési módot:</h5><hr class="red d-none d-md-block">
            </div>
            <div class="col-8 redy pt-5 d-block d-md-none"><h5>Ezt követően válassza ki szállítási és a fizetési módot:</h5></div>
            <hr class="col-10 red d-block d-md-none">
            <div class="col-6 col-md-4 mellow">Termék:</div>
            <div class="col-6 col-md-2 mellow">Mennyiség:</div>
            <div class="col-2 d-none d-md-block mellow">Egységár:</div>
            <div class="col-2 d-none d-md-block mellow">Ára:</div>
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
                <div class="col-4 col-md-2 mellow pt-2">x <?php echo $order["price"]?> Ft</div>
                <div class="col-4 col-md-2 mellow pt-2"><?php echo $productPrice = $order["piece"]*($order["price"])?> Ft</div>
                <div class="col-4 col-md-2">
                <div class="mellow text-left  py-2" id="">
                    <a href="/cart?szerkesztes=<?php echo $order["id"] ?>" class="pointer" id="orderEditButton"><h3><i class="fas fa-edit"></i></a>
                    <a href="/delete-product?id=<?php echo $order["id"] ?>"  class="pointer" id="orderDeleteButton"><i class="fas fa-times-circle"></i></h3></a>
                </div>  
                </div>
                <div class="col-12 py-3"><hr></div>
                <?php $total += $productPrice; ?>
                <?php endforeach; ?>
            <?php endif; ?>
            
            <div class="col-12 py-3"><hr></div>
            <div class="col-6 col-md-8 mellow text-right pr-5">Összesen: 
            </div>
            <div class="col-6 col-md-2 text-center mellow"><?php echo $total ?> Ft</div>
            <div class="col-6 col-md-2 d-block mx-auto pt-4 mellow">
            <a href="/user"><button type="button" class="btn-block next" <?php echo $order === [] ? "disabled" : "" ?>><span>Tovább</span></button></a>
            </div>
        </div>
    </div>
</div>
