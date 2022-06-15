<?php $total = 0; ?>
<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">
    <tr>
        <td align="center" valign="top">
            <table border="0" cellpadding="20" cellspacing="0" width="600" id="emailContainer">
                <tr>
                    <td align="center" valign="top">
                        <table border="0" cellpadding="20" cellspacing="0" width="100%" id="emailHeader">
                            <tr>
                                <td align="left" width="100%" valign="top">
                                    <h1>Új megrendelés érkezett</h1>
                                    <br>
                                    <h4>Feladó: <span style="color: blue"><?= $params['personalName'] ?></span></h4>
                                    <h4>Email: <span style="color: blue"><?= $params['email'] ?></span></h4>
                                    <h4>Megrendelésszám: <span style="color: blue">VTM-22-<?= $params['id'] ?></span></h4>
                                    <br>
                                    <table border="1" cellpadding="20" height="100%" width="100%">
                                    <?php foreach($params['orderedProducts'] as $products) : ?>
                                        <tr>
                                            <td> <?= $products["productId"] ?></td>
                                            <td> <p style="color: blue"><?= $products["name"] ?></p></td>
                                            <td> <?= $products["price"] ?> Ft</td>
                                            <td> <?= $products["piece"] ?></td>
                                            <td> <?= $products["total"] ?> Ft</td>
                                        </tr>
                                        <tr>
                                        <?php $total += $products["total"]; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                        <tr>
                                            <td colspan="4"><p style="color: blue"><?= $params['transportContent'] ?></p></td>
                                            <td><?= $params['transportPrice'] ?> Ft</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">Végösszeg:</td>
                                            <td style="color: blue"><?php echo $total + $params['transportPrice'] ?> Ft</td>
                                        </tr>
            
                                    </table>
                                    <br>
                                    <center><h4 style="color: blue"><?= $params['payment'] ?></h4></center>
                                    <br>
                                    <table border="1" cellpadding="20" height="100%" width="100%">
                                    <tr>
                                        <td>
                                            <h4>Számlázási adatok:</h4>
                                            <p>Név: <span style="color: blue"><?= $params['personalName'] ?></span></p>
                                            <p>Irányítószám: <span style="color: blue"><?= $params['personalZipcode'] ?></span></p>
                                            <p>Város: <span style="color: blue"><?= $params['personalCity'] ?></span></p>
                                            <p>Cím: <span style="color: blue"><?= $params['personalAddress'] ?></span></p>
                                            <p>Telefonszám: <span style="color: blue"><?= $params['personalPhoneNumber'] ?></span></p>
                                            <p>Adószám: <span style="color: blue"><?= $params['personalTaxNumber'] ?></span></p>
                                            <br>
                                        </td>
                                        <td>
                                            <h4>Szállítási adatok:</h4>
                                            <p>Név: <span style="color: blue"><?= $params['transportlName'] ?></span></p>
                                            <p>Irányítószám: <span style="color: blue"><?= $params['transportZipcode'] ?></span></p>
                                            <p>Város: <span style="color: blue"><?= $params['transportCity'] ?></span></p>
                                            <p>Cím: <span style="color: blue"><?= $params['transportAddress'] ?></span></p>
                                            <p>Telefonszám: <span style="color: blue"><?= $params['transportPhoneNumber'] ?></span></p>
                                            <p>Megjegyzés: <span style="color: blue"><?= $params['transportComment'] ?></span></p>
                                            <br>
                                        </td>
                                    </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>