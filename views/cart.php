<?php $order = json_decode(file_get_contents("./data/order.json"), true); 
    $total = 0;
?>

<div class="container none">
    <div class="card card-body backcol py-5">
        <div class="row p-2 text-center">
            <img class="img-fluid" src="../public/img/cart.jpg" alt="">
            <div class="col-12"><h1 class="py-3 text-center" id="cart">A vásárlás menete:<hr></h1></div>
            <div class="col-4 greeny p-4">1<span class="vertical"> lépés</span>
                <h5>Helyezze a kosárba a megvásárolandó termékeit:</h5><hr class="green">
            </div>
            <div class="col-4 redy p-4">2<span class="vertical"> lépés</span>
                <h5>Adja meg a számlázási és a postázási adtait:</h5><hr class="red">
            </div>
            <div class="col-4 redy p-4">3<span class="vertical"> lépés</span>
                <h5>Válassza ki szállítási és a fizetési módot:</h5><hr class="red">
            </div>
            <div class="col-4 mellow">Termék:</div>
            <div class="col-2 mellow">Mennyiség:</div>
            <div class="col-2 mellow">Egységár:</div>
            <div class="col-2 mellow">Ára:</div>
            <div class="col-12 py-3"><hr></div>
            <?php if($order === []) : ?>
                <div class="col-12 p-4 text-center">
                <h1 class="p-4 text-center">A kosara jelenleg üres!</h1>
                </div>
            <?php else : ?>
                <?php foreach($order as $order) : ?>
                <div class="col-1 mellow none "><img class="img-fluid" src="<?php echo $order["img"]?>" alt=""></div>
                <div class="col-3 mellow text-left pt-2"><?php echo $order["name"]?> <?php echo $order["type"]?></div>
                <div class="col-2 mellow pt-2">
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
                <div class="col-2 mellow pt-2">x <?php echo $order["price"]?> Ft</div>
                <div class="col-2 mellow pt-2"><?php echo $productPrice = $order["piece"]*($order["price"])?> Ft</div>
                <div class="col-2">
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
            <div class="col-8 mellow text-right pr-5">Összesen: 
            </div>
            <div class="col-2 text-center mellow"><?php echo $total ?> Ft</div>
            <div class="col-2 mellow">
            <button type="button" class="btn btn-block btn-success" <?php echo $order === [] ? "disabled" : "" ?>>Tovább</button>
            </div>
        </div>
    </div>
</div>
