<div class="container none">
    <div class="backcol py-5">
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
            <div class="col-4 col-md-4 greeny p-2">2<span class="vertical"> lépés</span>
                <h5 class="col-12 d-none d-md-block">A bejelentkezés után, adja meg a számlázási és a postázási adtait:</h5><hr class="green d-none d-md-block">
            </div>
            <div class="col-8 greeny pt-5 d-block d-md-none"><h5>A bejelentkezés után, adja meg a számlázási és a postázási adtait:</h5></div>
            <hr class="col-10 green d-block d-md-none">
            <div class="col-4 col-md-4 redy p-2">3<span class="vertical"> lépés</span>
                <h5 class="col-12 d-none d-md-block">Ezt követően válassza ki szállítási és a fizetési módot:</h5><hr class="red d-none d-md-block">
            </div>
            <div class="col-8 redy pt-5 d-block d-md-none"><h5>Ezt követően válassza ki szállítási és a fizetési módot:</h5></div>
            <hr class="col-10 red d-block d-md-none">
        </div>
        <?php if(!isLoggedIn()) : ?>
            <div class="row backcol p-2">
            <div class="col-12 py-5 text-center"><h1 class="blue">Bejelentkezés</h1></div>
            <div class="col-11 mx-auto mb-5 p-2 logincolor row">
            <div class="py-5 mellow col-12 col-md-5 ">
                    <img class="col-6 mx-auto d-block pr-md-3 img-fluid" src="..public/img/user-login.png" alt="">
                </div>
                <div class="py-md-5 mellow col-12 col-md-6 ">
                        <?php if ($params['message'] === "invalid") : ?>
                            <div class="alert alert-danger">
                            Helytelen bejelentkezési adatok
                            </div>
                         <?php endif ?>
                         <?php if ($params['message'] === "successful") : ?>
                            <div class="alert alert-success">
                            Regisztráció sikeres
                            </div>
                        <?php endif ?>
                        <form action="/login" method="POST">
                        <label class="w-100">
                            Email cím:
                        <input class="form-control" type="email" name="email">
                        <input type="hidden" class="form-control" name="location" value="user">
                        </label>
                        <label class="w-100">
                        Jelszó:
                        <input class="form-control" type="password" name="password">
                        </label>
                        <button type="submit" class="col-12 col-lg-4 mt-2 float-right btn btn-primary form-control">Bejelentkezés</button>
                        </form>
                        <div class="p-2">
                        Nincs még felhasználói fiókod?
                        <a class="blue" href="/regisztracio">Regisztráció</a>
                        </div>
                </div>
                
            </div>
    </div>
        <?php else : ?>
        <div class="row p-2" >
        <div class="col-12 col-lg-6 border-right py-3">
            <?php if($params["personal"] === null) : ?>
                <form action="/orderinvoicing" method="POST">
                <input type="hidden" name="id" value=" <?php echo $params["id"]; ?>">
                <h3 class="col-12 blue py-3">Számlázási adatok:</h3>
                <p class="blue col-12 p-2 ">A számlázáshoz szükséges kötelező adatokat(*), kérem tölse ki! </p>
                <?php if ($params['message'] === "invalid") : ?>
                            <div class="alert alert-danger">
                            Kérem töltse ki a *-gal jelzet mezőket!
                            </div>
                         <?php endif ?>
                         <?php if ($params['message'] === "not4") : ?>
                            <div class="alert alert-danger">
                            Hibás Irányítószám!
                            </div>
                <?php endif ?>
                <div class="blue row m-2">
                <div class="col-4 col-lg-4 py-2">Email cím:</div>
                <div class="col-6 mellow col-lg-6 py-2">
                <p><?php echo $params["email"] ?></p>
                </div>
                </div>
                <div class="col-12"><hr></div>
                <label>Számlázási név: *</label>
                <input class="col-12 col-lg-10 form-control" type="text" name="username">
                <label>Irányítószám: *</label>
                <input class="col-12 col-lg-10 form-control" type="number" name="zipcode">
                <label>Város: *</label>
                <input class="col-12 col-lg-10 form-control" type="text" name="city">
                <label>Cím: *</label>
                <input class="col-12 col-lg-10 form-control" type="text" name="address">
                <label>Telefonszám:</label>
                <div class="col-12 col-lg-10 row">
                <button class="left-radius col-2 col-lg-2" type="button" disabled>+ 36 </button>
                <input class="col-10 col-lg-10 form-control" type="text" name="phonenumber">
                </div>
                <label>Adószám (vállalkozások esetén kötelező):</label>
                <input class="col-12 col-lg-10 form-control" type="text" name="taxnumber">
                <div class="text-center">
                <button type="submit" class="btn btn-outline-success btn-lg px-5 mr-5 my-4 text-success">Elküld</button>
                </div>
                </form>
            <?php else : ?>
                <h3 class="col-12 blue text-center py-3"><u>Számlázási adatok:</u></h3>
                <div class="blue row">
                <div class="col-4 col-md-4 py-2">Email cím:</div>
                <div class="col-8 mellow col-md-6 py-2">
                    <p><?php echo $params["email"] ?></p>
                </div>
                <div class="col-12"><hr></div>
                <div class="col-4 col-lg-4 py-2">Számlázási név:</div>
                <?php if($params["personalEdit"] === "name") : ?>
                    <div class="col-12 mellow col-lg-8 py-2">
                    <form action="/personaledited" method="POST">
                    <input type="hidden" name="personalID" value="<?php echo $params["personal"] ?>"/>
                    <input type="hidden" name="location" value="user#user"/>
                    <input type="hidden" name="column" value="<?php echo $params["personalEdit"] ?>"/>
                    <input class="w-30" type="text" name="name" size="24"></input>
                    <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                    <a href="/user"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                    </form>
                    </div>
                <?php else: ?>
                    <div class="col-6 mellow col-lg-6 py-2" id="name">
                    <p><?php echo $params["name"] ?></p>
                    </div>
                    <a href="/user?p-edit=name" cursor="pointer"><div class="col-12 col-lg-2 py-2"><i class="fas fa-edit"></i></div></a>
                <?php endif; ?>
                <div class="col-12"><hr></div>
                <div class="col-4 col-md-4 py-2">Irányítószám:</div>
                <?php if($params["personalEdit"] === "zipcode") : ?>
                    <div class="col-12 mellow col-md-8 py-2">
                    <form action="/personaledited" method="POST">
                    <input type="hidden" name="personalID" value="<?php echo $params["personal"] ?>"/>
                    <input type="hidden" name="location" value="user#user"/>
                    <input type="hidden" name="column" value="<?php echo $params["personalEdit"] ?>"/>
                    <input class="w-30" type="text" name="zipcode" size="24"></input>
                    <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                    <a href="/user"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                    </form>
                    </div>
                <?php else: ?>
                    <div class="col-6 mellow col-md-6 py-2">
                    <p><?php echo $params["zipcode"] ?></p>
                    </div>
                    <a href="/user?p-edit=zipcode" cursor="pointer"><div class="col-12 col-md-2 py-2"><i class="fas fa-edit"></i></div></a>
                <?php endif; ?>
                <div class="col-12"><hr></div>
                <div class="col-4 col-md-4 py-2">Város:</div>
                <?php if($params["personalEdit"] === "city") : ?>
                    <div class="col-12 mellow col-md-8 py-2">
                    <form action="/personaledited" method="POST">
                    <input type="hidden" name="personalID" value="<?php echo $params["personal"] ?>"/>
                    <input type="hidden" name="location" value="user#user"/>
                    <input type="hidden" name="column" value="<?php echo $params["personalEdit"] ?>"/>
                    <input class="w-30" type="text" name="city" size="24"></input>
                    <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                    <a href="/user"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                    </form>
                    </div>
                <?php else: ?>
                    <div class="col-6 mellow col-md-6 py-2">
                    <p><?php echo $params["city"] ?></p>
                    </div>
                    <a href="/user?p-edit=city" cursor="pointer"><div class="col-12 col-md-2 py-2"><i class="fas fa-edit"></i></div></a>
                <?php endif; ?>
                <div class="col-12"><hr></div>
                <div class="col-4 col-md-4 py-2">Cím:</div>
                <?php if($params["personalEdit"] === "address") : ?>
                    <div class="col-12 mellow col-md-8 py-2">
                    <form action="/personaledited" method="POST">
                    <input type="hidden" name="personalID" value="<?php echo $params["personal"] ?>"/>
                    <input type="hidden" name="location" value="user#user"/>
                    <input type="hidden" name="column" value="<?php echo $params["personalEdit"] ?>"/>
                    <input class="w-30" type="text" name="address" size="24"></input>
                    <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                    <a href="/user"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                    </form>
                    </div>
                <?php else: ?>
                    <div class="col-6 mellow col-md-6 py-2">
                    <p><?php echo $params["address"] ?></p>
                    </div>
                    <a href="/user?p-edit=address" cursor="pointer"><div class="col-12 col-md-2 py-2"><i class="fas fa-edit"></i></div></a>
                <?php endif; ?>
                <div class="col-12"><hr></div>
                <div class="col-4 col-md-4 py-2">Telefonszám:</div>
                <?php if($params["personalEdit"] === "phoneNumber") : ?>
                    <div class="col-12 mellow col-md-8 py-2">
                    <form action="/personaledited" method="POST">
                    <input type="hidden" name="personalID" value="<?php echo $params["personal"] ?>"/>
                    <input type="hidden" name="location" value="user#user"/>
                    <input type="hidden" name="column" value="<?php echo $params["personalEdit"] ?>"/>
                    <input class="w-30" type="text" name="phoneNumber" size="24"></input>
                    <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                    <a href="/user"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                    </form>
                    </div>
                <?php else: ?>
                    <div class="col-6 mellow col-md-6 py-2">
                    <p><?php echo $params["phone"] ?></p>
                    </div>
                    <a href="/user?p-edit=phoneNumber" cursor="pointer"><div class="col-12 col-md-2 py-2"><i class="fas fa-edit"></i></div></a>
                <?php endif; ?>
                <div class="col-12"><hr></div>
                <div class="col-4 col-md-4 py-2">Adószám:</div>
                <?php if($params["personalEdit"] === "taxNumber") : ?>
                    <div class="col-12 mellow col-md-8 py-2">
                    <form action="/personaledited" method="POST">
                    <input type="hidden" name="personalID" value="<?php echo $params["personal"] ?>"/>
                    <input type="hidden" name="location" value="user#user"/>
                    <input type="hidden" name="column" value="<?php echo $params["personalEdit"] ?>"/>
                    <input class="w-30" type="text" name="taxNumber" size="24"></input>
                    <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                    <a href="/user"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                    </form>
                    </div>
                <?php else: ?>
                    <div class="col-6 mellow col-md-6 py-2">
                    <p><?php echo $params["taxnumber"] ?></p>
                    </div>
                    <a href="/user?p-edit=taxNumber" cursor="pointer"><div class="col-12 col-md-2 py-2"><i class="fas fa-edit"></i></div></a>
                <?php endif; ?>
                <div class="col-12"><hr></div>
                </div>
            <?php endif; ?>
            
            
            </div>
            <div class="col-12 col-lg-6 text-left border-right py-3">
            <?php if($params["transport"] === null) : ?>
                <form action="/usertransport" method="POST">
                    <input type="hidden" name="id" value=" <?php echo $params["id"]; ?>">
                    <h3 class="col-12 blue py-3">Szállítási adatok:</h3>
                    <p class="blue col-12 p-2 ">A szállításhoz szükséges kötelező adatokat(*), kérem tölse ki! </p>
                    <?php if ($params['message'] === "invalid2") : ?>
                            <div class="alert alert-danger">
                            Kérem töltse ki a *-gal jelzet mezőket!
                            </div>
                         <?php endif ?>
                         <?php if ($params['message'] === "not42") : ?>
                            <div class="alert alert-danger">
                            Hibás Irányítószám!
                            </div>
                    <?php endif ?>
                    <label>Név: *</label>
                    <input class="col-12 col-lg-10 form-control" type="text" name="username" value="<?php echo $params["name"] ?>">
                    <label>Irányítószám: *</label>
                    <input class="col-12 col-lg-10 form-control" type="number" name="zipcode" value="<?php echo $params["zipcode"] ?>">
                    <label>Város: *</label>
                    <input class="col-12 col-lg-10 form-control" type="text" name="city" value="<?php echo $params["city"] ?>">
                    <label>Cím: *</label>
                    <input class="col-12 col-lg-10 form-control" type="text" name="address" value="<?php echo $params["address"] ?>">
                    <label>Telefonszám:</label>
                    <div class="col-12 col-lg-10 row">
                    <button class="left-radius col-2 col-mlg-2" type="button" disabled>+ 36 </button>
                    <input class="col-10 col-lg-10 form-control" type="text" name="phonenumber" value="<?php echo $params["phone"] ?>">
                    </div>
                    <div class="form-group">
                    <label for="exampleFormControlTextarea1">Egyéb megjegyzés, kérés:</label>
                    <textarea class="col-12 col-lg-10 form-control" name="content" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="text-center">
                    <button type="submit" class="btn btn-outline-success btn-lg px-5 mr-5 my-4">Elküld</button>
                    </div>
                </form>
            <?php else : ?>
                <h3 class="col-12 blue text-center py-3"><u>Szállítási adatok:</u></h3>
                <div class="blue row">
                <div class="col-4 col-md-4 py-2">Név:</div>
                <?php if($params["transportEdit"] === "name") : ?>
                    <div class="col-12 mellow col-md-8 py-2">
                    <form action="/transportedited" method="POST">
                    <input type="hidden" name="transportID" value="<?php echo $params["transport"] ?>"/>
                    <input type="hidden" name="location" value="user"/>
                    <input type="hidden" name="column" value="<?php echo $params["transportEdit"] ?>"/>
                    <input class="w-30" type="text" name="name" size="24"></input>
                    <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                    <a href="/user"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                    </form>
                    </div>
                <?php else: ?>
                    <div class="col-6 mellow col-md-6 py-2">
                    <p><?php echo $params["transportName"] ?></p>
                    </div>
                    <a href="/user?t-edit=name" cursor="pointer"><div class="col-12 col-md-2 py-2"><i class="fas fa-edit"></i></div></a>
                <?php endif; ?>
                <div class="col-12"><hr></div>
                <div class="col-4 col-md-4 py-2">Irányítószám:</div>
                <?php if($params["transportEdit"] === "zipcode") : ?>
                    <div class="col-12 mellow col-md-8 py-2">
                    <form action="/transportedited" method="POST">
                    <input type="hidden" name="transportID" value="<?php echo $params["transport"] ?>"/>
                    <input type="hidden" name="location" value="user#user"/>
                    <input type="hidden" name="column" value="<?php echo $params["transportEdit"] ?>"/>
                    <input class="w-30" type="text" name="zipcode" size="24"></input>
                    <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                    <a href="/user"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                    </form>
                    </div>
                <?php else: ?>
                    <div class="col-6 mellow col-md-6 py-2">
                    <p><?php echo $params["transportZipcode"] ?></p>
                    </div>
                    <a href="/user?t-edit=zipcode" cursor="pointer"><div class="col-12 col-md-2 py-2"><i class="fas fa-edit"></i></div></a>
                <?php endif; ?>
                <div class="col-12"><hr></div>
                <div class="col-4 col-md-4 py-2">Város:</div>
                <?php if($params["transportEdit"] === "city") : ?>
                    <div class="col-12 mellow col-md-8 py-2">
                    <form action="/transportedited" method="POST">
                    <input type="hidden" name="transportID" value="<?php echo $params["transport"] ?>"/>
                    <input type="hidden" name="location" value="user#user"/>
                    <input type="hidden" name="column" value="<?php echo $params["transportEdit"] ?>"/>
                    <input class="w-30" type="text" name="city" size="24"></input>
                    <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                    <a href="/user"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                    </form>
                    </div>
                <?php else: ?>
                    <div class="col-6 mellow col-md-6 py-2">
                    <p><?php echo $params["transportCity"] ?></p>
                    </div>
                    <a href="/user?t-edit=city" cursor="pointer"><div class="col-12 col-md-2 py-2"><i class="fas fa-edit"></i></div></a>
                <?php endif; ?>
                <div class="col-12"><hr></div>
                <div class="col-4 col-md-4 py-2">Cím:</div>
                <?php if($params["transportEdit"] === "address") : ?>
                    <div class="col-12 mellow col-md-8 py-2">
                    <form action="/transportedited" method="POST">
                    <input type="hidden" name="transportID" value="<?php echo $params["transport"] ?>"/>
                    <input type="hidden" name="location" value="user#user"/>
                    <input type="hidden" name="column" value="<?php echo $params["transportEdit"] ?>"/>
                    <input class="w-30" type="text" name="address" size="24"></input>
                    <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                    <a href="/user"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                    </form>
                    </div>
                <?php else: ?>
                    <div class="col-6 mellow col-md-6 py-2">
                    <p><?php echo $params["transportAddress"] ?></p>
                    </div>
                    <a href="/user?t-edit=address" cursor="pointer"><div class="col-12 col-md-2 py-2"><i class="fas fa-edit"></i></div></a>
                <?php endif; ?>
                <div class="col-12"><hr></div>
                <div class="col-4 col-md-4 py-2">Telefonszám:</div>
                <?php if($params["transportEdit"] === "phone") : ?>
                    <div class="col-12 mellow col-md-8 py-2">
                    <form action="/transportedited" method="POST">
                    <input type="hidden" name="transportID" value="<?php echo $params["transport"] ?>"/>
                    <input type="hidden" name="location" value="user#user"/>
                    <input type="hidden" name="column" value="<?php echo $params["transportEdit"] ?>"/>
                    <input class="w-30" type="text" name="phone" size="24"></input>
                    <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                    <a href="/user"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                    </form>
                    </div>
                <?php else: ?>
                    <div class="col-6 mellow col-md-6 py-2">
                    <p><?php echo $params["transportPhone"] ?></p>
                    </div>
                    <a href="/user?t-edit=phone" cursor="pointer"><div class="col-12 col-md-2 py-2"><i class="fas fa-edit"></i></div></a>
                <?php endif; ?>
                <div class="col-12"><hr></div>
                <div class="col-4 col-md-4 py-2">Egyéb megjegyzés, kérés:</div>
                <?php if($params["transportEdit"] === "comment") : ?>
                    <div class="col-12 mellow col-md-8 py-2">
                    <form action="/transportedited" method="POST">
                    <input type="hidden" name="transportID" value="<?php echo $params["transport"] ?>"/>
                    <input type="hidden" name="location" value="user#user"/>
                    <input type="hidden" name="column" value="<?php echo $params["transportEdit"] ?>"/>
                    <input class="w-30" type="text" name="comment" size="24"></input>
                    <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                    <a href="/user"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                    </form>
                    </div>
                <?php else: ?>
                    <div class="col-6 mellow col-md-6 py-2">
                    <p><?php echo $params["transportComment"] ?></p>
                    </div>
                    <a href="/user?t-edit=comment" cursor="pointer"><div class="col-12 col-md-2 py-2"><i class="fas fa-edit"></i></div></a>
                <?php endif; ?>
                <div class="col-12"><hr></div>
                </div>

            <?php endif; ?>
            
            </div>
            <div class="col-12 row d-flex justify-content-center mellow">
            <a href="/cart" class="px-3"><button type="button" class="col-12 btn-block back px-5"><span>Vissza</span></button></a>
            <a href="/transportandpayment" class="px-3"><button type="button" class="col-12 btn-block next px-5" <?php echo ($params["personal"] === null || $params["transport"] === null) ? "disabled" : "" ?>><span>Tovább</span></button></a>
            </div>
        <?php endif; ?>
        </div>
    </div>
</div>