<div class="container none">
    <div class="backcol py-5">
        <div class="row p-2 text-center">
        <div class="col-12 pt-2 row ">
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
            <div class="col-4 col-md-4 greeny p-2">3<span class="vertical"> lépés</span>
                <h5 class="col-12 d-none d-md-block">Ezt követően válassza ki szállítási és a fizetési módot:</h5><hr class="green d-none d-md-block">
            </div>
            <div class="col-8 greeny pt-5 d-block d-md-none"><h5>Ezt követően válassza ki szállítási és a fizetési módot:</h5></div>
            <hr class="col-10 green d-block d-md-none">
        </div>
        
            <div class="col12 col-12">
                <div class="col-12 px-5 text-center"><img class="img-fluid col-md-3 px-3" src="./public/img/logo5.png" alt=""></div>
            </div>
            <div class="col-12 backcol2 p-3 text-left">
        <form action="/ordersummary" method="POST">   
                <div class="row m-3">
                <div class="col-12 col-lg-5 d-flex justify-content-center p-3">
                    <img class="img-fluid col-8 d-none d-lg-block" src="..public/img/transport.png" alt="transport.png">
                </div>
                <div class="col-12 col-lg-7 p-2">
                    <div class="col-12 border-shadow termekleiras mellow text-left p-5"><h1 class="blue">Személyes átvétel vagy szállítás:</h1></div>
                </div>
                </div>
                <div class="form-check p-2 mb-4">
                <input class="form-check-input checkboxSize" type="radio" name="transport" id="exampleRadios1" value="personal" checked>
                <label class="form-check-label" for="exampleRadios1">
                    <h4 class="blue"><i class="fas fa-walking px-2"></i>Személyes átvétel:</h4>
                    <p class="blue pl-md-4">( 0 Ft )</p>
                </label>
                <div class="row mellow pl-4">
                    <div class="col-12 col-lg-5 border-shadow termekleiras m-lg-3 my-3 p-4">
                    <p>A termék átvehető a </p>
                    <h5 class="blue">Szeged, József Attila sgt. 77/E </h5>
                    <p>lépcsőház alatt a következő napokon:</p>
                    <ul class="blue ">
                        <li class="p-2">Hétköznapokon: 14-18 óráig. </li>
                        <li class="p-2">Szombaton: 10-14 óráig. </li>
                    </ul>
                    </div>
                    <div class="col-12 col-lg-6 text-center border-shadow embed-responsive embed-responsive-16by9 m-lg-3 my-3">
                    <iframe class="border-shadow embed-responsive-item" src="https://www.google.com/maps/embed?pb=!4v1653324818974!6m8!1m7!1s3tONEte9WtYTUnXiaF4QaQ!2m2!1d46.26768235678932!2d20.15755731681578!3f94.99389177089401!4f-5.292274287484489!5f0.7820865974627469"  style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
                    </div>

                </div>
                
                </div>
                <div class="form-check p-2">
                <input class="form-check-input checkboxSize" type="radio" name="transport" id="exampleRadios2" value="mpl">
                <label class="form-check-label" for="exampleRadios2">
                <h4 class="blue"><i class="fas fa-shipping-fast px-2"></i>MPL-es házhozszállítás:</h4>
                <p class="blue pl-md-4">( 1000 Ft )</p>
                </label>
                <h3 class="col-12 blue py-2" id="transport"><u>Szállítási adatok:</u></h3>
                <div class="mellow row p-2">
                    <div class="col-12 termekleiras border-shadow col-lg-7 p-2">
                        <div class="row p-2">
                        <div class="col-5 blue"><h5>Név:</h5></div>
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
                    <div class="col-12 col-lg-5 mt-3 d-flex justify-content-center p-2">
                        <img class="img-fluid col-5 border-shadow" src="..public/img/mpl_hazhoz.jpg" alt="">
                    </div>
                </div>
                </div>
            </div>
            <div class="col21 col-12">
                <div class="col-12 px-5 text-center"><img class="img-fluid col-md-3 px-3" src="./public/img/logo5.png" alt=""></div>
            </div>
            <div class="col-12 p-2 ml-lg-4 text-left">
            <div class="row m-3">
                <div class="col-12 col-lg-7 p-2 ">
                    <div class="col-12 border-shadow termekleiras mellow text-center p-5"><h1 class="blue">Fizetési módok:</h1></div>
                </div>
                <div class="col-12 col-lg-5 d-flex justify-content-center p-3">
                    <img class="img-fluid col-8 d-none d-lg-block" src="..public/img/payment.png" alt="payment.png">
                </div>
                </div>
                <div class="form-check p-2 m-4">
                <input class="form-check-input checkboxSize" type="radio" name="payment" id="exampleRadios3" value="cash" >
                <label class="form-check-label" for="exampleRadios2">
                    <h4 class="blue"><i class="fas fa-money-bill-alt px-2"></i>Kézpénzes fizetés, csak személyes átvétel esetén</h4>
                    <div class="termekleiras border-shadow p-3 m-2">
                    <p class="mellow pl-md-4">Telefonos egyeztetés mellett igyekszünk minél rugalmasabban megoldani az átadást.</p>
                    <p class="mellow pl-md-4"><i class="fas fa-phone-square-alt px-2"></i>Telefonszám:</p>
                    <h3 class="blue text-center p-2">+30/951-4959</h3>
                    </div>
                </label>
                </div>
                <div class="form-check p-2 m-4">
                <input class="form-check-input checkboxSize" type="radio" name="payment" id="exampleRadios4" value="card" checked>
                <label class="form-check-label" for="exampleRadios2">
                    <h4 class="blue"><i class="fas fa-credit-card px-2"></i>Átutalás</h4>
                    <div class="termekleiras border-shadow p-3 m-2">
                    <p class="mellow pl-md-4">A megrendelést követően kollegáink elkészítik, majd küldenek a megadott e-mail címre egy díjbekérőt a rendelésről.</p>
                    <p class="mellow pl-md-4">Ehhez a levélhez csatolni fogunk egy számlaszámot is, ahová megrendelés összegét át lehet utalni.</p>
                    <p class="mellow pl-md-4">A rendezést követően:.</p>
                    <ul class="blue ">
                        <li class="p-2">Személyes átvétel esetén előzetes telefonos egyeztetés mellett át lehet venni a termékeket. </li>
                        <li class="p-2">MPL házhozszállítás esetén, csomagolást követően a megadott címre küldjük a termékeket.
                            (1-3 munkanap)
                        </li>
                    </ul>
                    </div>
                </label>
                </div>
            </div>
            <div class="col-12 row d-flex justify-content-center mellow">
                <div class="col-12 col-lg-12 p-2 d-flex justify-content-center">
                    <a href="/user" class="px-3"><button type="button" class="col-12 col-lg-12 btn-block back px-5"><span>Vissza</span></button></a>
                </div>
                <div class="col-12 col-lg-12 p-2 d-flex justify-content-center">
                    <button type="submit" class="col-6 col-lg-3 btn-block next px-5"><span>Tovább</span></button>
                </div>
            </div>
            </div>
            
        </form> 
        </div>
        </div>
    </div>
</div>