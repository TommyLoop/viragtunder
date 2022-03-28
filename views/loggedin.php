<div class="container">
    <div class="row backcol p-2 pt-5">
        <div class="col-12 text-center alert alert-success">
                <h1 class="display-4">Személyes adatok </h1>
                <p class="lead blue">Itt lehet megadni vagy módosítani a számlázási és a szállítási adatokat</p>
        </div>
        
        <div class="col-12 col-md-6 border-right py-3">
            <?php if($params["personal"] === null) : ?>
                <form action="/userinvoicing" method="POST">
                <input type="hidden" name="id" value=" <?php echo $params["id"]; ?>">
                <h3 class="col-12 blue py-3">Számlázási adatok:</h3>
                <label>Számlázási név: *</label>
                <input class="col-12 col-md-10 form-control" type="text" name="username">
                <label>Telefonszám:</label>
                <input class="col-12 col-md-10 form-control" type="text" name="phonenumber">
                <label>Adószám (vállalkozások esetén kötelező):</label>
                <input class="col-12 col-md-10 form-control" type="text" name="taxnumber">
                <label>Irányítószám: *</label>
                <input class="col-12 col-md-10 form-control" type="number" name="zipcode">
                <label>Város: *</label>
                <input class="col-12 col-md-10 form-control" type="text" name="city">
                <label>Cím: *</label>
                <input class="col-12 col-md-10 form-control" type="text" name="address">
                <div class="text-center">
                <button type="submit" class="btn btn-outline-success btn-lg px-5 mr-5 my-4">Elküld</button>
                </div>
                </form>
            <?php else : ?>
                <h3 class="col-12 blue py-3"><u>Számlázási adatok:</u></h3>
                <div class="blue row">
                <div class="col-12 col-md-4 py-2">Számlázási név:</div>
                <?php if($params["personalEdit"] === "name") : ?>
                    <div class="col-12 mellow col-md-8 py-2">
                    <form action="/personaledited" method="POST">
                    <input type="hidden" name="personalID" value="<?php echo $params["personal"] ?>"/>
                    <input type="hidden" name="column" value="<?php echo $params["personalEdit"] ?>"/>
                    <input class="w-30" type="text" name="name" size="24"></input>
                    <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                    <a href="/bejelentkezes"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                    </form>
                    </div>
                <?php else: ?>
                    <div class="col-12 mellow col-md-6 py-2">
                    <p><?php echo $params["name"] ?></p>
                    </div>
                    <a href="/bejelentkezes?p-edit=name" cursor="pointer"><div class="col-12 col-md-2 py-2"><i class="fas fa-edit"></i></div></a>
                <?php endif; ?>
                <div class="col-12"><hr></div>
                <div class="col-12 col-md-4 py-2">Telefonszám:</div>
                <?php if($params["personalEdit"] === "phoneNumber") : ?>
                    <div class="col-12 mellow col-md-8 py-2">
                    <form action="/personaledited" method="POST">
                    <input type="hidden" name="personalID" value="<?php echo $params["personal"] ?>"/>
                    <input type="hidden" name="column" value="<?php echo $params["personalEdit"] ?>"/>
                    <input class="w-30" type="text" name="phoneNumber" size="24"></input>
                    <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                    <a href="/bejelentkezes"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                    </form>
                    </div>
                <?php else: ?>
                    <div class="col-12 mellow col-md-6 py-2">
                    <p><?php echo $params["phone"] ?></p>
                    </div>
                    <a href="/bejelentkezes?p-edit=phoneNumber" cursor="pointer"><div class="col-12 col-md-2 py-2"><i class="fas fa-edit"></i></div></a>
                <?php endif; ?>
                <div class="col-12"><hr></div>
                <div class="col-12 col-md-4 py-2">Adószám:</div>
                <?php if($params["personalEdit"] === "taxNumber") : ?>
                    <div class="col-12 mellow col-md-8 py-2">
                    <form action="/personaledited" method="POST">
                    <input type="hidden" name="personalID" value="<?php echo $params["personal"] ?>"/>
                    <input type="hidden" name="column" value="<?php echo $params["personalEdit"] ?>"/>
                    <input class="w-30" type="text" name="taxNumber" size="24"></input>
                    <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                    <a href="/bejelentkezes"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                    </form>
                    </div>
                <?php else: ?>
                    <div class="col-12 mellow col-md-6 py-2">
                    <p><?php echo $params["taxnumber"] ?></p>
                    </div>
                    <a href="/bejelentkezes?p-edit=taxNumber" cursor="pointer"><div class="col-12 col-md-2 py-2"><i class="fas fa-edit"></i></div></a>
                <?php endif; ?>
                <div class="col-12"><hr></div>
                <div class="col-12 col-md-4 py-2">Irányítószám:</div>
                <?php if($params["personalEdit"] === "zipcode") : ?>
                    <div class="col-12 mellow col-md-8 py-2">
                    <form action="/personaledited" method="POST">
                    <input type="hidden" name="personalID" value="<?php echo $params["personal"] ?>"/>
                    <input type="hidden" name="column" value="<?php echo $params["personalEdit"] ?>"/>
                    <input class="w-30" type="text" name="zipcode" size="24"></input>
                    <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                    <a href="/bejelentkezes"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                    </form>
                    </div>
                <?php else: ?>
                    <div class="col-12 mellow col-md-6 py-2">
                    <p><?php echo $params["zipcode"] ?></p>
                    </div>
                    <a href="/bejelentkezes?p-edit=zipcode" cursor="pointer"><div class="col-12 col-md-2 py-2"><i class="fas fa-edit"></i></div></a>
                <?php endif; ?>
                <div class="col-12"><hr></div>
                <div class="col-12 col-md-4 py-2">Város:</div>
                <?php if($params["personalEdit"] === "city") : ?>
                    <div class="col-12 mellow col-md-8 py-2">
                    <form action="/personaledited" method="POST">
                    <input type="hidden" name="personalID" value="<?php echo $params["personal"] ?>"/>
                    <input type="hidden" name="column" value="<?php echo $params["personalEdit"] ?>"/>
                    <input class="w-30" type="text" name="city" size="24"></input>
                    <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                    <a href="/bejelentkezes"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                    </form>
                    </div>
                <?php else: ?>
                    <div class="col-12 mellow col-md-6 py-2">
                    <p><?php echo $params["city"] ?></p>
                    </div>
                    <a href="/bejelentkezes?p-edit=city" cursor="pointer"><div class="col-12 col-md-2 py-2"><i class="fas fa-edit"></i></div></a>
                <?php endif; ?>
                <div class="col-12"><hr></div>
                <div class="col-12 col-md-4 py-2">Cím:</div>
                <?php if($params["personalEdit"] === "address") : ?>
                    <div class="col-12 mellow col-md-8 py-2">
                    <form action="/personaledited" method="POST">
                    <input type="hidden" name="personalID" value="<?php echo $params["personal"] ?>"/>
                    <input type="hidden" name="column" value="<?php echo $params["personalEdit"] ?>"/>
                    <input class="w-30" type="text" name="address" size="24"></input>
                    <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                    <a href="/bejelentkezes"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                    </form>
                    </div>
                <?php else: ?>
                    <div class="col-12 mellow col-md-6 py-2">
                    <p><?php echo $params["address"] ?></p>
                    </div>
                    <a href="/bejelentkezes?p-edit=address" cursor="pointer"><div class="col-12 col-md-2 py-2"><i class="fas fa-edit"></i></div></a>
                <?php endif; ?>
                <div class="col-12"><hr></div>
                </div>
            <?php endif; ?>
            
            
            </div>
            <div class="col-12 col-md-6 text-left border-right py-3">
            <?php if($params["transport"] === null) : ?>
                <form action="/usertransport" method="POST">
                    <input type="hidden" name="id" value=" <?php echo $params["id"]; ?>">
                    <h3 class="col-12 blue py-3">Szállítási adatok:</h3>
                    <label>Név: *</label>
                    <input class="col-12 col-md-10 form-control" type="text" name="username" value="<?php echo $params["name"] ?>">
                    <label>Telefonszám:</label>
                    <input class="col-12 col-md-10 form-control" type="text" name="phonenumber" value="<?php echo $params["phone"] ?>">
                    <label>Irányítószám: *</label>
                    <input class="col-12 col-md-10 form-control" type="number" name="zipcode" value="<?php echo $params["zipcode"] ?>">
                    <label>Város: *</label>
                    <input class="col-12 col-md-10 form-control" type="text" name="city" value="<?php echo $params["city"] ?>">
                    <label>Cím: *</label>
                    <input class="col-12 col-md-10 form-control" type="text" name="address" value="<?php echo $params["address"] ?>">
                    <div class="form-group">
                    <label for="exampleFormControlTextarea1">Egyéb megjegyzés, kérés:</label>
                    <textarea class="col-12 col-md-10 form-control" name="content" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="text-center">
                    <button type="submit" class="btn btn-outline-success btn-lg px-5 mr-5 my-4">Elküld</button>
                    </div>
                </form>
            <?php else : ?>
                <h3 class="col-12 blue py-3"><u>Szállítási adatok:</u></h3>
                <div class="blue row">
                <div class="col-12 col-md-4 py-2">Név:</div>
                <?php if($params["transportEdit"] === "name") : ?>
                    <div class="col-12 mellow col-md-8 py-2">
                    <form action="/transportedited" method="POST">
                    <input type="hidden" name="transportID" value="<?php echo $params["transport"] ?>"/>
                    <input type="hidden" name="column" value="<?php echo $params["transportEdit"] ?>"/>
                    <input class="w-30" type="text" name="name" size="24"></input>
                    <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                    <a href="/bejelentkezes"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                    </form>
                    </div>
                <?php else: ?>
                    <div class="col-12 mellow col-md-6 py-2">
                    <p><?php echo $params["transportName"] ?></p>
                    </div>
                    <a href="/bejelentkezes?t-edit=name" cursor="pointer"><div class="col-12 col-md-2 py-2"><i class="fas fa-edit"></i></div></a>
                <?php endif; ?>
                <div class="col-12"><hr></div>
                <div class="col-12 col-md-4 py-2">Telefonszám:</div>
                <?php if($params["transportEdit"] === "phone") : ?>
                    <div class="col-12 mellow col-md-8 py-2">
                    <form action="/transportedited" method="POST">
                    <input type="hidden" name="transportID" value="<?php echo $params["transport"] ?>"/>
                    <input type="hidden" name="column" value="<?php echo $params["transportEdit"] ?>"/>
                    <input class="w-30" type="text" name="phone" size="24"></input>
                    <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                    <a href="/bejelentkezes"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                    </form>
                    </div>
                <?php else: ?>
                    <div class="col-12 mellow col-md-6 py-2">
                    <p><?php echo $params["transportPhone"] ?></p>
                    </div>
                    <a href="/bejelentkezes?t-edit=phone" cursor="pointer"><div class="col-12 col-md-2 py-2"><i class="fas fa-edit"></i></div></a>
                <?php endif; ?>
                <div class="col-12"><hr></div>
                <div class="col-12 col-md-4 py-2">Irányítószám:</div>
                <?php if($params["transportEdit"] === "zipcode") : ?>
                    <div class="col-12 mellow col-md-8 py-2">
                    <form action="/transportedited" method="POST">
                    <input type="hidden" name="transportID" value="<?php echo $params["transport"] ?>"/>
                    <input type="hidden" name="column" value="<?php echo $params["transportEdit"] ?>"/>
                    <input class="w-30" type="text" name="zipcode" size="24"></input>
                    <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                    <a href="/bejelentkezes"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                    </form>
                    </div>
                <?php else: ?>
                    <div class="col-12 mellow col-md-6 py-2">
                    <p><?php echo $params["transportZipcode"] ?></p>
                    </div>
                    <a href="/bejelentkezes?t-edit=zipcode" cursor="pointer"><div class="col-12 col-md-2 py-2"><i class="fas fa-edit"></i></div></a>
                <?php endif; ?>
                <div class="col-12"><hr></div>
                <div class="col-12 col-md-4 py-2">Város:</div>
                <?php if($params["transportEdit"] === "city") : ?>
                    <div class="col-12 mellow col-md-8 py-2">
                    <form action="/transportedited" method="POST">
                    <input type="hidden" name="transportID" value="<?php echo $params["transport"] ?>"/>
                    <input type="hidden" name="column" value="<?php echo $params["transportEdit"] ?>"/>
                    <input class="w-30" type="text" name="city" size="24"></input>
                    <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                    <a href="/bejelentkezes"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                    </form>
                    </div>
                <?php else: ?>
                    <div class="col-12 mellow col-md-6 py-2">
                    <p><?php echo $params["transportCity"] ?></p>
                    </div>
                    <a href="/bejelentkezes?t-edit=city" cursor="pointer"><div class="col-12 col-md-2 py-2"><i class="fas fa-edit"></i></div></a>
                <?php endif; ?>
                <div class="col-12"><hr></div>
                <div class="col-12 col-md-4 py-2">Cím:</div>
                <?php if($params["transportEdit"] === "address") : ?>
                    <div class="col-12 mellow col-md-8 py-2">
                    <form action="/transportedited" method="POST">
                    <input type="hidden" name="transportID" value="<?php echo $params["transport"] ?>"/>
                    <input type="hidden" name="column" value="<?php echo $params["transportEdit"] ?>"/>
                    <input class="w-30" type="text" name="address" size="24"></input>
                    <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                    <a href="/bejelentkezes"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                    </form>
                    </div>
                <?php else: ?>
                    <div class="col-12 mellow col-md-6 py-2">
                    <p><?php echo $params["transportAddress"] ?></p>
                    </div>
                    <a href="/bejelentkezes?t-edit=address" cursor="pointer"><div class="col-12 col-md-2 py-2"><i class="fas fa-edit"></i></div></a>
                <?php endif; ?>
                <div class="col-12"><hr></div>
                <div class="col-12 col-md-4 py-2">Egyéb megjegyzés, kérés:</div>
                <?php if($params["transportEdit"] === "comment") : ?>
                    <div class="col-12 mellow col-md-8 py-2">
                    <form action="/transportedited" method="POST">
                    <input type="hidden" name="transportID" value="<?php echo $params["transport"] ?>"/>
                    <input type="hidden" name="column" value="<?php echo $params["transportEdit"] ?>"/>
                    <input class="w-30" type="text" name="comment" size="24"></input>
                    <button type="submit" class="btn btn-outline-success pointer"><i class="fas fa-check-circle"></i></button>
                    <a href="/bejelentkezes"  class="pointer"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></a>
                    </form>
                    </div>
                <?php else: ?>
                    <div class="col-12 mellow col-md-6 py-2">
                    <p><?php echo $params["transportComment"] ?></p>
                    </div>
                    <a href="/bejelentkezes?t-edit=comment" cursor="pointer"><div class="col-12 col-md-2 py-2"><i class="fas fa-edit"></i></div></a>
                <?php endif; ?>
                <div class="col-12"><hr></div>
                </div>

            <?php endif; ?>
            
            </div>
    </div>
</div>