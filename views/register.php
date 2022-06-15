<?php
$message = $params['message'] ?? "";
?>

<div class="container">
    <div class="row backcol p-2">
            <div class="col-12 py-5 text-center"><h1 class="blue">Regisztráció</h1></div>
            <div class="col-11 mx-auto mb-5 p-2 logincolor row">
                <div class="py-5 mellow col-12 col-lg-5 d-flex align-items-center">
                    <img class="col-8 mx-auto pr-3 img-fluid" src="..public/img/user.png" alt="">
                </div>
                <div class="py-lg-5 mellow col-12 col-lg-7 ">
                        <?php if ($params['message'] === "invalid") : ?>
                            <div class="alert alert-danger">
                            Helytelen regisztrációs adatok
                            </div>
                         <?php endif ?>
                        <form action="/register" method="POST">
                            <label class="w-100">
                                Email cím:
                                <input class="form-control" type="email" name="email">
                            </label>
                            <label class="w-100">
                                Jelszó:
                                <input class="form-control" type="password" name="password">
                            </label>
                            <div class="col-12 col-lg-12 p-t d-flex justify-content-center">
                            <div class="col-12"><p>A személyes adatokat a weboldalon történő vásárlási élmény fenntartásához, a fiókhoz való hozzáférés kezeléséhez és más célokra használjuk, 
                                 melyeket a Adatkezelési tájékoztató tartalmaz.</p></div>
                             </div>
                             <div class="col-12 col-lg-12 pb-2 d-flex justify-content-center">
                                <div class="col-12 m-2 form-check" >
                                    <input class="form-check-input" type="checkbox" value="" id="datadefend" onclick="enable()">
                                    <label class="form-check-label" for="datadefend">
                                    Az Adatkezelési tájékoztatóban foglaltakat elfogadom. *  
                                    </label>
                                </div>
                            </div>
                            <button type="submit" id="regbtn" class="col-12 col-lg-4 mt-2 float-right btn btn-primary form-control" disabled="true">Regisztráció</button>
                        </form>
                        <div class="p-2">
                            Van már felhasználói fiókod?
                            <a class="blue" href="/bejelentkezes">Bejelentkezés</a>
                        </div>
                </div>
            </div>
    </div>
</div>