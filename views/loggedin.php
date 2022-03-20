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
                <h3 class="col-12 blue py-3">Számlázási adatok:</h3>
                <div class="mellow row">
                <div class="col-12 col-md-5 py-2">Számlázási név:</div>
                <div class="col-12 col-md-5 py-2"><?php echo $params["name"] ?></div>
                <div class="col-12 col-md-2 py-2"><i class="fas fa-edit"></i></div>
                <div class="col-12"><hr></div>
                <div class="col-12 col-md-5 py-2">Telefonszám:</div>
                <div class="col-12 col-md-5 py-2"><?php echo $params["phone"] ?></div>
                <div class="col-12 col-md-2 py-2"><i class="fas fa-edit"></i></div>
                <div class="col-12"><hr></div>
                <div class="col-12 col-md-5 py-2">Adószám:</div>
                <div class="col-12 col-md-5 py-2"><?php echo $params["taxnumber"] ?></div>
                <div class="col-12 col-md-2 py-2"><i class="fas fa-edit"></i></div>
                <div class="col-12"><hr></div>
                <div class="col-12 col-md-5 py-2">Irányítószám:</div>
                <div class="col-12 col-md-5 py-2"><?php echo $params["zipcode"] ?></div>
                <div class="col-12 col-md-2 py-2"><i class="fas fa-edit"></i></div>
                <div class="col-12"><hr></div>
                <div class="col-12 col-md-5 py-2">Város:</div>
                <div class="col-12 col-md-5 py-2"><?php echo $params["city"] ?></div>
                <div class="col-12 col-md-2 py-2"><i class="fas fa-edit"></i></div>
                <div class="col-12"><hr></div>
                <div class="col-12 col-md-5 py-2">Cím:</div>
                <div class="col-12 col-md-5 py-2"><?php echo $params["address"] ?></div>
                <div class="col-12 col-md-2 py-2"><i class="fas fa-edit"></i></div>
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
                <h3 class="col-12 blue py-3">Szállítási adatok:</h3>
                <div class="mellow row">
                <div class="col-12 col-md-5 py-2">Név:</div>
                <div class="col-12 col-md-5 py-2"><?php echo $params["transportName"] ?></div>
                <div class="col-12 col-md-2 py-2"><i class="fas fa-edit"></i></div>
                <div class="col-12"><hr></div>
                <div class="col-12 col-md-5 py-2">Telefonszám:</div>
                <div class="col-12 col-md-5 py-2"><?php echo $params["transportPhone"] ?></div>
                <div class="col-12 col-md-2 py-2"><i class="fas fa-edit"></i></div>
                <div class="col-12"><hr></div>
                <div class="col-12 col-md-5 py-2">Irányítószám:</div>
                <div class="col-12 col-md-5 py-2"><?php echo $params["transportZipcode"] ?></div>
                <div class="col-12 col-md-2 py-2"><i class="fas fa-edit"></i></div>
                <div class="col-12"><hr></div>
                <div class="col-12 col-md-5 py-2">Város:</div>
                <div class="col-12 col-md-5 py-2"><?php echo $params["transportCity"] ?></div>
                <div class="col-12 col-md-2 py-2"><i class="fas fa-edit"></i></div>
                <div class="col-12"><hr></div>
                <div class="col-12 col-md-5 py-2">Cím:</div>
                <div class="col-12 col-md-5 py-2"><?php echo $params["transportAddress"] ?></div>
                <div class="col-12 col-md-2 py-2"><i class="fas fa-edit"></i></div>
                <div class="col-12"><hr></div>
                <div class="col-12 col-md-5 py-2">Egyéb megjegyzés, kérés:</div>
                <div class="col-12 col-md-5 py-2"><?php echo $params["transportComment"] ?></div>
                <div class="col-12 col-md-2 py-2"><i class="fas fa-edit"></i></div>
                <div class="col-12"><hr></div>
                </div>

            <?php endif; ?>
            
            </div>
    </div>
</div>