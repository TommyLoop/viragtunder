<div class="container">
    <div class="row backcol p-2">
            <div class="col-12 py-5 text-center"><h1 class="blue">Bejelentkezés</h1></div>
            <div class="col-11 mx-auto mb-5 p-2 logincolor row">
                <div class="py-5 mellow col-5 ">
                    <img class="col-6 mx-auto d-block pr-3 img-fluid" src="..public/img/user-login.png" alt="">
                </div>
            
                <div class="py-5 mellow col-6 ">
                        <?php if ($params['message'] === "invalid") : ?>
                            <div class="alert alert-danger">
                            Helytelen bejelentkezési adatok
                            </div>
                         <?php endif ?>
                        <form action="/login" method="POST">
                        <label class="w-100">
                            Email cím:
                        <input class="form-control" type="email" name="email">
                        </label>
                        <label class="w-100">
                        Jelszó:
                        <input class="form-control" type="password" name="password">
                        </label>
                        <button type="submit" class="col-3 mt-2 float-right btn btn-primary form-control">Bejelentkezés</button>
                        </form>
                        <div class="pt-3">
                        Nincs még felhasználói fiókod?
                        <a class="blue" href="/regisztracio">Regisztráció</a>
                        </div>
                </div>
            </div>
    </div>
</div>