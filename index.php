<?php

require __DIR__ . '/vendor/autoload.php';
require './Mailer.php';



/* -------------------------------------------------------------------------- */
/*                               Útvonalválasztó                              */
/* -------------------------------------------------------------------------- */


$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', 'homeHandler');
    $r->addRoute('GET', '/kublik', 'kubliHandler');
    $r->addRoute('GET', '/kublik2', 'kubli2Handler');
    $r->addRoute('GET', '/rattan', 'rattanHandler');
    $r->addRoute('GET', '/rattan2', 'rattan2Handler');
    $r->addRoute('GET', '/heartbox', 'heartboxHandler');
    $r->addRoute('GET', '/szalas', 'szalasHandler');
    $r->addRoute('GET', '/koszoru', 'koszoruHandler');
    $r->addRoute('GET', '/angel', 'angelHandler');
    $r->addRoute('GET', '/mikulas', 'mikulasHandler');
    $r->addRoute('GET', '/kaspo1', 'kaspo1Handler');
    $r->addRoute('GET', '/kaspo2', 'kaspo2Handler');
    $r->addRoute('GET', '/cart', 'cartHandler');
    $r->addRoute('GET', '/regisztracio', 'regisztracioHandler');
    $r->addRoute('GET', '/bejelentkezes', 'bejelentkezesHandler');
    $r->addRoute('GET', '/delete-product', 'orderDeleteHandler');
    $r->addRoute('GET', '/user', 'userHandler');
    $r->addRoute('GET', '/transportandpayment', 'paymentHandler');
    $r->addRoute('GET', '/tools/images', 'imagesHandler');
    $r->addRoute('GET', '/tools/backgrounds', 'backgroundsHandler');
    $r->addRoute('GET', '/tools/colors', 'colorsHandler');
    $r->addRoute('GET', '/tools/png', 'pngHandler');
    $r->addRoute('GET', '/tools/other', 'otherHandler');
    $r->addRoute('GET', '/ordersummary', 'ordersummaryHandler');
    $r->addRoute('POST', '/edited', 'editedHandler');
    $r->addRoute('POST', '/cart', 'cartSendHandler');
    $r->addRoute('POST', '/register', 'registrationHandler');
    $r->addRoute('POST', '/login', 'loginHandler');
    $r->addRoute('POST', '/logout', 'logoutHandler');
    $r->addRoute('POST', '/submit-message', 'submitMessageHandler');
    $r->addRoute('POST', '/send-mails', 'sendMailsHandler');
    $r->addRoute('POST', '/userinvoicing', 'userInvoicingHandler');
    $r->addRoute('POST', '/usertransport', 'userTransportHandler');
    $r->addRoute('POST', '/personaledited', 'personaleditedHandler');
    $r->addRoute('POST', '/transportedited', 'transporteditedHandler');
    $r->addRoute('POST', '/orderinvoicing', 'orderInvoicingHandler');
    $r->addRoute('POST', '/ordersummary', 'formCheckHandler');


});


// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
       notFoundHandler();
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        notFoundHandler();
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        // ... call $handler with $vars
        $handler($vars);
        break;
}

/* -------------------------------------------------------------------------- */
/*                              Segéd-függvények                              */
/* -------------------------------------------------------------------------- */


function notFoundHandler() {
    echo "Oldal nem található";
 }
function compileTemplate($filePath, $params = []): string
{
    ob_start();
    require($filePath);
    return ob_get_clean();
}
function getConnection()
{
    return new PDO(
        'mysql:host=' . $_SERVER['DB_HOST'] . ';dbname=' . $_SERVER['DB_NAME'],
        $_SERVER['DB_USER'],
        $_SERVER['DB_PASSWORD']
    );
}
function isLoggedIn(): bool
{
    if (!isset($_COOKIE[session_name()])) { 
        return false; 
    }
    session_start();
    if (!isset($_SESSION['userId'])) { 
        return false; 
    }
    return true;
}

function transportPaymentChecker($selected) {
    $transportpayment = json_decode(file_get_contents('./data/transportpayment.json'), true);
        array_push($transportpayment, $selected);
        $json = json_encode($transportpayment, JSON_UNESCAPED_UNICODE);
        file_put_contents('./data/transportpayment.json', $json);
        header("Location: /ordersummary");
    
}


/* -------------------------------------------------------------------------- */
/*                      Rendszerfüggvények GET method                         */
/* -------------------------------------------------------------------------- */


/* ------------------------------- "/" ------------------------------- */

function homeHandler() {

    $kubli = json_decode(file_get_contents('./data/kublik.json'), true);
    $kubli2 = json_decode(file_get_contents('./data/kublik2.json'), true);
    $rattan = json_decode(file_get_contents('./data/rattan.json'), true);
    $rattan2 = json_decode(file_get_contents('./data/rattan2.json'), true);
    $heartbox = json_decode(file_get_contents('./data/heartbox.json'), true);
    $szalas = json_decode(file_get_contents('./data/szalas.json'), true);
    $koszoru = json_decode(file_get_contents('./data/koszoru.json'), true);
    $angel = json_decode(file_get_contents('./data/angel.json'), true);
    $mikulas = json_decode(file_get_contents('./data/mikulas.json'), true);
    $kaspo1 = json_decode(file_get_contents('./data/Nkaspo.json'), true);
    $kaspo2 = json_decode(file_get_contents('./data/Kkaspo.json'), true);

    $valentinTemplate = compileTemplate('./views/valentin.php', [
        "kaspo1" => $kaspo1,
        "kaspo2" => $kaspo2
    ]);

    $karacsonyTemplate = compileTemplate('./views/karacsony.php', [
        "angel" => $angel,
        "mikulas" => $mikulas
    ]);

    $koszoruTemplate = compileTemplate('./views/koszoru.php', [
        'koszoru' => $koszoru
    ]);

    $szalasTemplate = compileTemplate('./views/szalas.php', [
        'szalas' => $szalas
    ]);

    $heartboxTemplate = compileTemplate('./views/heartbox.php', [
        'heartbox' => $heartbox
    ]);

    $rattanTemplate = compileTemplate('./views/rattan.php', [
        'rattan' => $rattan,
        "rattan2" => $rattan2
    ]);

    $kubliTemplate = compileTemplate('./views/kublik.php', [
        'kubli' => $kubli,
        'kubli2' => $kubli2
    ]);
    $bemutatoTemplate = compileTemplate('./views/bemutato.php');
    $introductionTemplate = compileTemplate('./views/introduction.php');
    echo compileTemplate('./views/wrapper.php', [
        'innerTemplate' => $kubliTemplate,
        'rattanTemplate' => $rattanTemplate,
        'heartboxTemplate' => $heartboxTemplate,
        'szalasTemplate' => $szalasTemplate,
        'koszoruTemplate' => $koszoruTemplate,
        "karacsonyTemplate" => $karacsonyTemplate,
        'bemutatoTemplate' => $bemutatoTemplate,
        'valentinTemplate' => $valentinTemplate,
        'innerIntroductionTemplate' => $introductionTemplate,
        'loginTemplate' => null,
        'innerCartTemplate' => null,
        'isAuthorized' => isLoggedIn(),
        'isSuccess' => isset($_GET['kuldesSikeres'])

    ]);


}

/* -------------------------------- "/kublik" ------------------------------- */

function kubliHandler() 
{
    $kubliID = $_GET["id"] ?? "";
    $kubli = json_decode(file_get_contents("./data/kublik.json"), true);
    $kubli2 = json_decode(file_get_contents('./data/kublik2.json'), true);
    $foundProductIndex = -1;
    foreach($kubli as $index => $product) {
        if($product["id"] === $kubliID) {
            $foundProductIndex = $index;
            break;
        }
    }
    if($foundProductIndex === -1) {
        header("Location: /");
        return;
    }
    $rattan = json_decode(file_get_contents('./data/rattan.json'), true);
    $rattan2 = json_decode(file_get_contents('./data/rattan2.json'), true);
    $heartbox = json_decode(file_get_contents('./data/heartbox.json'), true);
    $szalas = json_decode(file_get_contents('./data/szalas.json'), true);
    $koszoru = json_decode(file_get_contents('./data/koszoru.json'), true);
    $kaspo1 = json_decode(file_get_contents('./data/Nkaspo.json'), true);
    $kaspo2 = json_decode(file_get_contents('./data/Kkaspo.json'), true);

    $valentinTemplate = compileTemplate('./views/valentin.php', [
        'kaspo1' => $kaspo1,
        'kaspo2' => $kaspo2
    ]);

    $koszoruTemplate = compileTemplate('./views/koszoru.php', [
        'koszoru' => $koszoru
    ]);


    $szalasTemplate = compileTemplate('./views/szalas.php', [
        'szalas' => $szalas
    ]);

    $heartboxTemplate = compileTemplate('./views/heartbox.php', [
        'heartbox' => $heartbox
    ]);

    $rattanTemplate = compileTemplate('./views/rattan.php', [
        'rattan' => $rattan,
        "rattan2" => $rattan2
    ]);

    $kubliTemplate = compileTemplate('./views/kublik.php', [
        'kubli' => $kubli,
        'kubli2' => $kubli2,
        'foundProductIndex' => $foundProductIndex
    ]);
    $bemutatoTemplate = compileTemplate('./views/bemutato.php');
    $introductionTemplate = compileTemplate('./views/introduction.php');
    echo compileTemplate('./views/wrapper.php', [
        'innerTemplate' => $kubliTemplate,
        'innerIntroductionTemplate' => $introductionTemplate,
        'rattanTemplate' => $rattanTemplate,
        'heartboxTemplate' => $heartboxTemplate,
        'szalasTemplate' => $szalasTemplate,
        'koszoruTemplate' => $koszoruTemplate,
        'bemutatoTemplate' => $bemutatoTemplate,
        'karacsonyTemplate' => $karacsonyTemplate,
        'valentinTemplate' => $valentinTemplate,
        'loginTemplate' => null,
        'innerCartTemplate' => null,
        'isAuthorized' => isLoggedIn()


    ]);
    
}

/* ------------------------------- "/kublik2" ------------------------------- */

function kubli2Handler() {
    $kubliID = $_GET["id"] ?? "";
    $kubli = json_decode(file_get_contents("./data/kublik.json"), true);
    $kubli2 = json_decode(file_get_contents('./data/kublik2.json'), true);
    $foundProductIndex2 = -1;
    foreach($kubli2 as $index => $product) {
        if($product["id"] === $kubliID) {
            $foundProductIndex2 = $index;
            break;
        }
    }
    if($foundProductIndex2 === -1) {
        header("Location: /");
        return;
    }
    $rattan = json_decode(file_get_contents('./data/rattan.json'), true);
    $rattan2 = json_decode(file_get_contents('./data/rattan2.json'), true);
    $heartbox = json_decode(file_get_contents('./data/heartbox.json'), true);
    $szalas = json_decode(file_get_contents('./data/szalas.json'), true);
    $koszoru = json_decode(file_get_contents('./data/koszoru.json'), true);
    $kaspo1 = json_decode(file_get_contents('./data/Nkaspo.json'), true);
    $kaspo2 = json_decode(file_get_contents('./data/Kkaspo.json'), true);

    $valentinTemplate = compileTemplate('./views/valentin.php', [
        'kaspo1' => $kaspo1,
        'kaspo2' => $kaspo2
    ]);

    $koszoruTemplate = compileTemplate('./views/koszoru.php', [
        'koszoru' => $koszoru
    ]);


    $szalasTemplate = compileTemplate('./views/szalas.php', [
        'szalas' => $szalas
    ]);

    $heartboxTemplate = compileTemplate('./views/heartbox.php', [
        'heartbox' => $heartbox
    ]);

    $rattanTemplate = compileTemplate('./views/rattan.php', [
        'rattan' => $rattan,
        "rattan2" => $rattan2
    ]);

    $kubliTemplate = compileTemplate('./views/kublik.php', [
        'kubli' => $kubli,
        'kubli2' => $kubli2,
        'foundProductIndex2' => $foundProductIndex2
    ]);
    $bemutatoTemplate = compileTemplate('./views/bemutato.php');
    $introductionTemplate = compileTemplate('./views/introduction.php');
    echo compileTemplate('./views/wrapper.php', [
        'innerTemplate' => $kubliTemplate,
        'innerIntroductionTemplate' => $introductionTemplate,
        'rattanTemplate' => $rattanTemplate,
        'szalasTemplate' => $szalasTemplate,
        'heartboxTemplate' => $heartboxTemplate,
        'koszoruTemplate' => $koszoruTemplate,
        'bemutatoTemplate' => $bemutatoTemplate,
        'valentinTemplate' => $valentinTemplate,
        "karacsonyTemplate" => $karacsonyTemplate,
        'loginTemplate' => null,
        'innerCartTemplate' => null,
        'isAuthorized' => isLoggedIn()


    ]);
}

/* -------------------------------- "/rattan" ------------------------------- */

function rattanHandler() {
    $rattanID = $_GET["id"] ?? "";
    $rattan = json_decode(file_get_contents("./data/rattan.json"), true);
    $rattan2 = json_decode(file_get_contents('./data/rattan2.json'), true);
    $foundProductIndex = -1;
    foreach($rattan as $index => $product) {
        if($product["id"] === $rattanID) {
            $foundProductIndex = $index;
            break;
        }
    }
    if($foundProductIndex === -1) {
        header("Location: /");
        return;
    }

    $kubli = json_decode(file_get_contents('./data/kublik.json'), true);
    $kubli2 = json_decode(file_get_contents('./data/kublik2.json'), true);
    $heartbox = json_decode(file_get_contents('./data/heartbox.json'), true);
    $szalas = json_decode(file_get_contents('./data/szalas.json'), true);
    $koszoru = json_decode(file_get_contents('./data/koszoru.json'), true);
    $kaspo1 = json_decode(file_get_contents('./data/Nkaspo.json'), true);
    $kaspo2 = json_decode(file_get_contents('./data/Kkaspo.json'), true);

    $valentinTemplate = compileTemplate('./views/valentin.php', [
        'kaspo1' => $kaspo1,
        'kaspo2' => $kaspo2
    ]);

    $koszoruTemplate = compileTemplate('./views/koszoru.php', [
        'koszoru' => $koszoru
    ]);


    $szalasTemplate = compileTemplate('./views/szalas.php', [
        'szalas' => $szalas
    ]);

    $heartboxTemplate = compileTemplate('./views/heartbox.php', [
        'heartbox' => $heartbox
    ]);

    $kubliTemplate = compileTemplate('./views/kublik.php', [
        'kubli' => $kubli,
        'kubli2' => $kubli2
    ]);
    $rattanTemplate = compileTemplate('./views/rattan.php', [
        'rattan' => $rattan,
        'rattan2' => $rattan2,
        'foundProductIndex' => $foundProductIndex
    ]);
    $bemutatoTemplate = compileTemplate('./views/bemutato.php');
    $introductionTemplate = compileTemplate('./views/introduction.php');
    echo compileTemplate('./views/wrapper.php', [
        'innerTemplate' => $kubliTemplate,
        'innerIntroductionTemplate' => $introductionTemplate,
        'rattanTemplate' => $rattanTemplate,
        'szalasTemplate' => $szalasTemplate,
        'heartboxTemplate' => $heartboxTemplate,
        'koszoruTemplate' => $koszoruTemplate,
        'bemutatoTemplate' => $bemutatoTemplate,
        'valentinTemplate' => $valentinTemplate,
        "karacsonyTemplate" => $karacsonyTemplate,
        'loginTemplate' => null,
        'innerCartTemplate' => null,
        'isAuthorized' => isLoggedIn()


    ]);
}

/* ------------------------------- "/rattan2" ------------------------------- */

function rattan2Handler() {
    $rattanID = $_GET["id"] ?? "";
    $rattan = json_decode(file_get_contents("./data/rattan.json"), true);
    $rattan2 = json_decode(file_get_contents('./data/rattan2.json'), true);
    $foundProductIndex2 = -1;
    foreach($rattan2 as $index => $product) {
        if($product["id"] === $rattanID) {
            $foundProductIndex2 = $index;
            break;
        }
    }
    if($foundProductIndex2 === -1) {
        header("Location: /");
        return;
    }
    $kubli = json_decode(file_get_contents('./data/kublik.json'), true);
    $kubli2 = json_decode(file_get_contents('./data/kublik2.json'), true);
    $heartbox = json_decode(file_get_contents('./data/heartbox.json'), true);
    $szalas = json_decode(file_get_contents('./data/szalas.json'), true);
    $koszoru = json_decode(file_get_contents('./data/koszoru.json'), true);
    $kaspo1 = json_decode(file_get_contents('./data/Nkaspo.json'), true);
    $kaspo2 = json_decode(file_get_contents('./data/Kkaspo.json'), true);

    $valentinTemplate = compileTemplate('./views/valentin.php', [
        'kaspo1' => $kaspo1,
        'kaspo2' => $kaspo2
    ]);

    $koszoruTemplate = compileTemplate('./views/koszoru.php', [
        'koszoru' => $koszoru
    ]);


    $szalasTemplate = compileTemplate('./views/szalas.php', [
        'szalas' => $szalas
    ]);

    $heartboxTemplate = compileTemplate('./views/heartbox.php', [
        'heartbox' => $heartbox
    ]);


    $kubliTemplate = compileTemplate('./views/kublik.php', [
        'kubli' => $kubli,
        'kubli2' => $kubli2
    ]);

    $rattanTemplate = compileTemplate('./views/rattan.php', [
        'rattan' => $rattan,
        'rattan2' => $rattan2,
        'foundProductIndex2' => $foundProductIndex2
    ]);
    $bemutatoTemplate = compileTemplate('./views/bemutato.php');
    $introductionTemplate = compileTemplate('./views/introduction.php');
    echo compileTemplate('./views/wrapper.php', [
        'innerTemplate' => $kubliTemplate,
        'innerIntroductionTemplate' => $introductionTemplate,
        'rattanTemplate' => $rattanTemplate,
        'szalasTemplate' => $szalasTemplate,
        'heartboxTemplate' => $heartboxTemplate,
        'koszoruTemplate' => $koszoruTemplate,
        'bemutatoTemplate' => $bemutatoTemplate,
        'valentinTemplate' => $valentinTemplate,
        "karacsonyTemplate" => $karacsonyTemplate,
        'loginTemplate' => null,
        'innerCartTemplate' => null,
        'isAuthorized' => isLoggedIn()


    ]);
}

/* ------------------------------- "/heartbox" ------------------------------ */

function heartboxHandler() {
    $heartboxID = $_GET["id"] ?? "";
    $heartbox = json_decode(file_get_contents("./data/heartbox.json"), true);
    $foundProductIndex = -1;
    foreach($heartbox as $index => $product) {
        if($product["id"] === $heartboxID) {
            $foundProductIndex = $index;
            break;
        }
    }
    if($foundProductIndex === -1) {
        header("Location: /");
        return;
    }
    
    $kubli = json_decode(file_get_contents('./data/kublik.json'), true);
    $kubli2 = json_decode(file_get_contents('./data/kublik2.json'), true);
    $rattan = json_decode(file_get_contents('./data/rattan.json'), true);
    $rattan2 = json_decode(file_get_contents('./data/rattan2.json'), true);
    $szalas = json_decode(file_get_contents('./data/szalas.json'), true);
    $koszoru = json_decode(file_get_contents('./data/koszoru.json'), true);
    $kaspo1 = json_decode(file_get_contents('./data/Nkaspo.json'), true);
    $kaspo2 = json_decode(file_get_contents('./data/Kkaspo.json'), true);

    $valentinTemplate = compileTemplate('./views/valentin.php', [
        'kaspo1' => $kaspo1,
        'kaspo2' => $kaspo2
    ]);

    $koszoruTemplate = compileTemplate('./views/koszoru.php', [
        'koszoru' => $koszoru
    ]);


    $szalasTemplate = compileTemplate('./views/szalas.php', [
        'szalas' => $szalas
    ]);

    $heartboxTemplate = compileTemplate('./views/heartbox.php', [
        'heartbox' => $heartbox,
        'foundProductIndex' => $foundProductIndex
    ]);

    $rattanTemplate = compileTemplate('./views/rattan.php', [
        'rattan' => $rattan,
        "rattan2" => $rattan2
    ]);

    $kubliTemplate = compileTemplate('./views/kublik.php', [
        'kubli' => $kubli,
        'kubli2' => $kubli2
    ]);
    $bemutatoTemplate = compileTemplate('./views/bemutato.php');
    $introductionTemplate = compileTemplate('./views/introduction.php');
    echo compileTemplate('./views/wrapper.php', [
        'innerTemplate' => $kubliTemplate,
        'rattanTemplate' => $rattanTemplate,
        'heartboxTemplate' => $heartboxTemplate,
        'szalasTemplate' => $szalasTemplate,
        'koszoruTemplate' => $koszoruTemplate,
        "karacsonyTemplate" => $karacsonyTemplate,
        'bemutatoTemplate' => $bemutatoTemplate,
        'valentinTemplate' => $valentinTemplate,
        'innerIntroductionTemplate' => $introductionTemplate,
        'loginTemplate' => null,
        'innerCartTemplate' => null,
        'isAuthorized' => isLoggedIn()


    ]);
}

/* -------------------------------- "/szalas" ------------------------------- */

function szalasHandler() {
    $szalasID = $_GET["id"] ?? "";
    $szalas = json_decode(file_get_contents("./data/szalas.json"), true);
    $foundProductIndex = -1;
    foreach($szalas as $index => $product) {
        if($product["id"] === $szalasID) {
            $foundProductIndex = $index;
            break;
        }
    }
    if($foundProductIndex === -1) {
        header("Location: /");
        return;
    }
    
    $kubli = json_decode(file_get_contents('./data/kublik.json'), true);
    $kubli2 = json_decode(file_get_contents('./data/kublik2.json'), true);
    $rattan = json_decode(file_get_contents('./data/rattan.json'), true);
    $rattan2 = json_decode(file_get_contents('./data/rattan2.json'), true);
    $heartbox = json_decode(file_get_contents('./data/heartbox.json'), true);
    $koszoru = json_decode(file_get_contents('./data/koszoru.json'), true);
    $kaspo1 = json_decode(file_get_contents('./data/Nkaspo.json'), true);
    $kaspo2 = json_decode(file_get_contents('./data/Kkaspo.json'), true);

    $valentinTemplate = compileTemplate('./views/valentin.php', [
        'kaspo1' => $kaspo1,
        'kaspo2' => $kaspo2
    ]);

    $koszoruTemplate = compileTemplate('./views/koszoru.php', [
        'koszoru' => $koszoru
    ]);

    $szalasTemplate = compileTemplate('./views/szalas.php', [
        'szalas' => $szalas,
        'foundProductIndex' => $foundProductIndex
    ]);

    $heartboxTemplate = compileTemplate('./views/heartbox.php', [
        'heartbox' => $heartbox,
    ]);

    $rattanTemplate = compileTemplate('./views/rattan.php', [
        'rattan' => $rattan,
        "rattan2" => $rattan2
    ]);

    $kubliTemplate = compileTemplate('./views/kublik.php', [
        'kubli' => $kubli,
        'kubli2' => $kubli2
    ]);
    $bemutatoTemplate = compileTemplate('./views/bemutato.php');
    $introductionTemplate = compileTemplate('./views/introduction.php');
    echo compileTemplate('./views/wrapper.php', [
        'innerTemplate' => $kubliTemplate,
        'rattanTemplate' => $rattanTemplate,
        'heartboxTemplate' => $heartboxTemplate,
        'szalasTemplate' => $szalasTemplate,
        'koszoruTemplate' => $koszoruTemplate,
        "karacsonyTemplate" => $karacsonyTemplate,
        'bemutatoTemplate' => $bemutatoTemplate,
        'valentinTemplate' => $valentinTemplate,
        'innerIntroductionTemplate' => $introductionTemplate,
        'loginTemplate' => null,
        'innerCartTemplate' => null,
        'isAuthorized' => isLoggedIn()


    ]);
    
}

/* ------------------------------- "/koszoru" ------------------------------- */

function koszoruHandler() {
    $koszoruID = $_GET["id"] ?? "";
    $koszoru = json_decode(file_get_contents("./data/koszoru.json"), true);
    $foundProductIndex = -1;
    foreach($koszoru as $index => $product) {
        if($product["id"] === $koszoruID) {
            $foundProductIndex = $index;
            break;
        }
    }
    if($foundProductIndex === -1) {
        header("Location: /");
        return;
    }
    
    $kubli = json_decode(file_get_contents('./data/kublik.json'), true);
    $kubli2 = json_decode(file_get_contents('./data/kublik2.json'), true);
    $rattan = json_decode(file_get_contents('./data/rattan.json'), true);
    $rattan2 = json_decode(file_get_contents('./data/rattan2.json'), true);
    $heartbox = json_decode(file_get_contents('./data/heartbox.json'), true);
    $szalas = json_decode(file_get_contents('./data/szalas.json'), true);
    $kaspo1 = json_decode(file_get_contents('./data/Nkaspo.json'), true);
    $kaspo2 = json_decode(file_get_contents('./data/Kkaspo.json'), true);

    $valentinTemplate = compileTemplate('./views/valentin.php', [
        'kaspo1' => $kaspo1,
        'kaspo2' => $kaspo2
    ]);

    $koszoruTemplate = compileTemplate('./views/koszoru.php', [
        'koszoru' => $koszoru,
        'foundProductIndex' => $foundProductIndex
    ]);

    $szalasTemplate = compileTemplate('./views/szalas.php', [
        'szalas' => $szalas
    ]);

    $heartboxTemplate = compileTemplate('./views/heartbox.php', [
        'heartbox' => $heartbox,
    ]);

    $rattanTemplate = compileTemplate('./views/rattan.php', [
        'rattan' => $rattan,
        "rattan2" => $rattan2
    ]);

    $kubliTemplate = compileTemplate('./views/kublik.php', [
        'kubli' => $kubli,
        'kubli2' => $kubli2
    ]);
    $bemutatoTemplate = compileTemplate('./views/bemutato.php');
    $introductionTemplate = compileTemplate('./views/introduction.php');
    echo compileTemplate('./views/wrapper.php', [
        'innerTemplate' => $kubliTemplate,
        'rattanTemplate' => $rattanTemplate,
        'heartboxTemplate' => $heartboxTemplate,
        'szalasTemplate' => $szalasTemplate,
        'koszoruTemplate' => $koszoruTemplate,
        "karacsonyTemplate" => $karacsonyTemplate,
        'bemutatoTemplate' => $bemutatoTemplate,
        'valentinTemplate' => $valentinTemplate,
        'innerIntroductionTemplate' => $introductionTemplate,
        'loginTemplate' => null,
        'innerCartTemplate' => null,
        'isAuthorized' => isLoggedIn()


    ]);
}

/* -------------------------------- "/angel" -------------------------------- */

function angelHandler() {
    $angelID = $_GET["id"] ?? "";
    $angel = json_decode(file_get_contents("./data/angel.json"), true);
    $mikulas = json_decode(file_get_contents('./data/mikulas.json'), true);
    $foundProductIndex = -1;
    foreach($angel as $index => $product) {
        if($product["id"] === $angelID) {
            $foundProductIndex = $index;
            break;
        }
    }
    if($foundProductIndex === -1) {
        header("Location: /");
        return;
    }

    $kubli = json_decode(file_get_contents('./data/kublik.json'), true);
    $kubli2 = json_decode(file_get_contents('./data/kublik2.json'), true);
    $rattan = json_decode(file_get_contents('./data/rattan.json'), true);
    $rattan2 = json_decode(file_get_contents('./data/rattan2.json'), true);
    $heartbox = json_decode(file_get_contents('./data/heartbox.json'), true);
    $szalas = json_decode(file_get_contents('./data/szalas.json'), true);
    $koszoru = json_decode(file_get_contents('./data/koszoru.json'), true);
    $kaspo1 = json_decode(file_get_contents('./data/Nkaspo.json'), true);
    $kaspo2 = json_decode(file_get_contents('./data/Kkaspo.json'), true);

    $valentinTemplate = compileTemplate('./views/valentin.php', [
        'kaspo1' => $kaspo1,
        'kaspo2' => $kaspo2
    ]);

    $karacsonyTemplate= compileTemplate("./views/karacsony.php", [
        "angel" => $angel,
        "mikulas" => $mikulas,
        'foundProductIndex' => $foundProductIndex
    ]);

    $koszoruTemplate = compileTemplate('./views/koszoru.php', [
        'koszoru' => $koszoru
    ]);


    $szalasTemplate = compileTemplate('./views/szalas.php', [
        'szalas' => $szalas
    ]);

    $heartboxTemplate = compileTemplate('./views/heartbox.php', [
        'heartbox' => $heartbox
    ]);

    $kubliTemplate = compileTemplate('./views/kublik.php', [
        'kubli' => $kubli,
        'kubli2' => $kubli2
    ]);
    $rattanTemplate = compileTemplate('./views/rattan.php', [
        'rattan' => $rattan,
        'rattan2' => $rattan2
    ]);
    $bemutatoTemplate = compileTemplate('./views/bemutato.php');
    $introductionTemplate = compileTemplate('./views/introduction.php');
    echo compileTemplate('./views/wrapper.php', [
        'innerTemplate' => $kubliTemplate,
        'innerIntroductionTemplate' => $introductionTemplate,
        'rattanTemplate' => $rattanTemplate,
        'szalasTemplate' => $szalasTemplate,
        'heartboxTemplate' => $heartboxTemplate,
        'koszoruTemplate' => $koszoruTemplate,
        'bemutatoTemplate' => $bemutatoTemplate,
        'valentinTemplate' => $valentinTemplate,
        "karacsonyTemplate" => $karacsonyTemplate,
        'loginTemplate' => null,
        'innerCartTemplate' => null,
        'isAuthorized' => isLoggedIn()


    ]);
}

/* ------------------------------- "/mikulas" ------------------------------- */

function mikulasHandler() {
    $mikulasID = $_GET["id"] ?? "";
    $angel = json_decode(file_get_contents("./data/angel.json"), true);
    $mikulas = json_decode(file_get_contents('./data/mikulas.json'), true);
    $foundProductIndex2 = -1;
    foreach($mikulas as $index => $product) {
        if($product["id"] === $mikulasID) {
            $foundProductIndex2 = $index;
            break;
        }
    }
    if($foundProductIndex2 === -1) {
        header("Location: /");
        return;
    }

    $kubli = json_decode(file_get_contents('./data/kublik.json'), true);
    $kubli2 = json_decode(file_get_contents('./data/kublik2.json'), true);
    $rattan = json_decode(file_get_contents('./data/rattan.json'), true);
    $rattan2 = json_decode(file_get_contents('./data/rattan2.json'), true);
    $heartbox = json_decode(file_get_contents('./data/heartbox.json'), true);
    $szalas = json_decode(file_get_contents('./data/szalas.json'), true);
    $koszoru = json_decode(file_get_contents('./data/koszoru.json'), true);
    $kaspo1 = json_decode(file_get_contents('./data/Nkaspo.json'), true);
    $kaspo2 = json_decode(file_get_contents('./data/Kkaspo.json'), true);

    $valentinTemplate = compileTemplate('./views/valentin.php', [
        'kaspo1' => $kaspo1,
        'kaspo2' => $kaspo2
    ]);


    $karacsonyTemplate= compileTemplate("./views/karacsony.php", [
        "angel" => $angel,
        "mikulas" => $mikulas,
        'foundProductIndex2' => $foundProductIndex2
    ]);

    $koszoruTemplate = compileTemplate('./views/koszoru.php', [
        'koszoru' => $koszoru
    ]);


    $szalasTemplate = compileTemplate('./views/szalas.php', [
        'szalas' => $szalas
    ]);

    $heartboxTemplate = compileTemplate('./views/heartbox.php', [
        'heartbox' => $heartbox
    ]);

    $kubliTemplate = compileTemplate('./views/kublik.php', [
        'kubli' => $kubli,
        'kubli2' => $kubli2
    ]);
    $rattanTemplate = compileTemplate('./views/rattan.php', [
        'rattan' => $rattan,
        'rattan2' => $rattan2
    ]);
    $bemutatoTemplate = compileTemplate('./views/bemutato.php');
    $introductionTemplate = compileTemplate('./views/introduction.php');
    echo compileTemplate('./views/wrapper.php', [
        'innerTemplate' => $kubliTemplate,
        'innerIntroductionTemplate' => $introductionTemplate,
        'rattanTemplate' => $rattanTemplate,
        'szalasTemplate' => $szalasTemplate,
        'heartboxTemplate' => $heartboxTemplate,
        'koszoruTemplate' => $koszoruTemplate,
        'bemutatoTemplate' => $bemutatoTemplate,
        'valentinTemplate' => $valentinTemplate,
        "karacsonyTemplate" => $karacsonyTemplate,
        'loginTemplate' => null,
        'innerCartTemplate' => null,
        'isAuthorized' => isLoggedIn()


    ]);
}

/* -------------------------------- "/kaspo1" ------------------------------- */

function kaspo1Handler() {
    $kaspo1ID = $_GET["id"] ?? "";
    $kaspo2 = json_decode(file_get_contents("./data/Kkaspo.json"), true);
    $kaspo1 = json_decode(file_get_contents('./data/Nkaspo.json'), true);
    $foundProductIndex = -1;
    foreach($kaspo1 as $index => $product) {
        if($product["id"] === $kaspo1ID) {
            $foundProductIndex = $index;
            break;
        }
    }
    if($foundProductIndex === -1) {
        header("Location: /");
        return;
    }

    $kubli = json_decode(file_get_contents('./data/kublik.json'), true);
    $kubli2 = json_decode(file_get_contents('./data/kublik2.json'), true);
    $rattan = json_decode(file_get_contents('./data/rattan.json'), true);
    $rattan2 = json_decode(file_get_contents('./data/rattan2.json'), true);
    $heartbox = json_decode(file_get_contents('./data/heartbox.json'), true);
    $szalas = json_decode(file_get_contents('./data/szalas.json'), true);
    $koszoru = json_decode(file_get_contents('./data/koszoru.json'), true);
    $angel = json_decode(file_get_contents('./data/angel.json'), true);
    $mikulas = json_decode(file_get_contents('./data/mikulas.json'), true);

    $valentinTemplate = compileTemplate('./views/valentin.php', [
        "kaspo1" => $kaspo1,
        "kaspo2" => $kaspo2,
        'foundProductIndex' => $foundProductIndex
    ]);
    $karacsonyTemplate = compileTemplate("./views/karacsony.php", [
        "angel" => $angel,
        "mikulas" => $mikulas
    ]);

    $koszoruTemplate = compileTemplate('./views/koszoru.php', [
        'koszoru' => $koszoru
    ]);


    $szalasTemplate = compileTemplate('./views/szalas.php', [
        'szalas' => $szalas
    ]);

    $heartboxTemplate = compileTemplate('./views/heartbox.php', [
        'heartbox' => $heartbox
    ]);

    $kubliTemplate = compileTemplate('./views/kublik.php', [
        'kubli' => $kubli,
        'kubli2' => $kubli2
    ]);
    $rattanTemplate = compileTemplate('./views/rattan.php', [
        'rattan' => $rattan,
        'rattan2' => $rattan2
    ]);
    $bemutatoTemplate = compileTemplate('./views/bemutato.php');
    $introductionTemplate = compileTemplate('./views/introduction.php');
    echo compileTemplate('./views/wrapper.php', [
        'innerTemplate' => $kubliTemplate,
        'innerIntroductionTemplate' => $introductionTemplate,
        'rattanTemplate' => $rattanTemplate,
        'szalasTemplate' => $szalasTemplate,
        'heartboxTemplate' => $heartboxTemplate,
        'koszoruTemplate' => $koszoruTemplate,
        'bemutatoTemplate' => $bemutatoTemplate,
        'valentinTemplate' => $valentinTemplate,
        "karacsonyTemplate" => $karacsonyTemplate,
        'innerCartTemplate' => null,
        'loginTemplate' => null,
        'isAuthorized' => isLoggedIn()


    ]);
}

/* -------------------------------- "/kaspo2" ------------------------------- */

function kaspo2Handler() {
    $kaspo2ID = $_GET["id"] ?? "";
    $kaspo2 = json_decode(file_get_contents("./data/Kkaspo.json"), true);
    $kaspo1 = json_decode(file_get_contents('./data/Nkaspo.json'), true);
    $foundProductIndex2 = -1;
    foreach($kaspo2 as $index => $product) {
        if($product["id"] === $kaspo2ID) {
            $foundProductIndex2 = $index;
            break;
        }
    }
    if($foundProductIndex2 === -1) {
        header("Location: /");
        return;
    }

    $kubli = json_decode(file_get_contents('./data/kublik.json'), true);
    $kubli2 = json_decode(file_get_contents('./data/kublik2.json'), true);
    $rattan = json_decode(file_get_contents('./data/rattan.json'), true);
    $rattan2 = json_decode(file_get_contents('./data/rattan2.json'), true);
    $heartbox = json_decode(file_get_contents('./data/heartbox.json'), true);
    $szalas = json_decode(file_get_contents('./data/szalas.json'), true);
    $koszoru = json_decode(file_get_contents('./data/koszoru.json'), true);
    $angel = json_decode(file_get_contents('./data/angel.json'), true);
    $mikulas = json_decode(file_get_contents('./data/mikulas.json'), true);

    $valentinTemplate = compileTemplate('./views/valentin.php', [
        "kaspo1" => $kaspo1,
        "kaspo2" => $kaspo2,
        'foundProductIndex2' => $foundProductIndex2
    ]);
    
    $karacsonyTemplate = compileTemplate("./views/karacsony.php", [
        "angel" => $angel,
        "mikulas" => $mikulas
    ]);

    $koszoruTemplate = compileTemplate('./views/koszoru.php', [
        'koszoru' => $koszoru
    ]);


    $szalasTemplate = compileTemplate('./views/szalas.php', [
        'szalas' => $szalas
    ]);

    $heartboxTemplate = compileTemplate('./views/heartbox.php', [
        'heartbox' => $heartbox
    ]);

    $kubliTemplate = compileTemplate('./views/kublik.php', [
        'kubli' => $kubli,
        'kubli2' => $kubli2
    ]);
    $rattanTemplate = compileTemplate('./views/rattan.php', [
        'rattan' => $rattan,
        'rattan2' => $rattan2
    ]);
    $bemutatoTemplate = compileTemplate('./views/bemutato.php');
    $introductionTemplate = compileTemplate('./views/introduction.php');
    echo compileTemplate('./views/wrapper.php', [
        'innerTemplate' => $kubliTemplate,
        'innerIntroductionTemplate' => $introductionTemplate,
        'rattanTemplate' => $rattanTemplate,
        'szalasTemplate' => $szalasTemplate,
        'heartboxTemplate' => $heartboxTemplate,
        'koszoruTemplate' => $koszoruTemplate,
        'bemutatoTemplate' => $bemutatoTemplate,
        'valentinTemplate' => $valentinTemplate,
        "karacsonyTemplate" => $karacsonyTemplate,
        'innerCartTemplate' => null,
        'loginTemplate' => null,
        'isAuthorized' => isLoggedIn()


    ]);
}

/* --------------------------------- "/cart" -------------------------------- */

function cartHandler() {
    $cartTemplate = compileTemplate('./views/cart.php', [
        "editedProductId" => $_GET["szerkesztes"] ?? ""
    ]);
    echo compileTemplate('./views/wrapper.php', [
        'innerCartTemplate' => $cartTemplate,
        'rattanTemplate' => null,
        'heartboxTemplate' => null,
        'szalasTemplate' => null,
        'koszoruTemplate' => null,
        "karacsonyTemplate" => null,
        'bemutatoTemplate' => null,
        'valentinTemplate' => null,
        'innerIntroductionTemplate' => null,
        'loginTemplate' => null,
        'innerTemplate' => null,
        'isAuthorized' => isLoggedIn(),
        'isSuccess' => isset($_GET['kuldesSikeres'])
    ]);
}

/* ----------------------------- "/regisztracio" ---------------------------- */

function regisztracioHandler()
{
    $regisztracioTemplate = compileTemplate('./views/register.php', [
        "message" => ""
    ]);
    echo compileTemplate('./views/wrapper.php', [
            'loginTemplate' => $regisztracioTemplate,
            'rattanTemplate' => null,
            'heartboxTemplate' => null,
            'szalasTemplate' => null,
            'koszoruTemplate' => null,
            "karacsonyTemplate" => null,
            'bemutatoTemplate' => null,
            'valentinTemplate' => null,
            'innerIntroductionTemplate' => null,
            'innerTemplate' => null,
            'innerCartTemplate' => null,
            'isAuthorized' => isLoggedIn(),
            'isSuccess' => isset($_GET['kuldesSikeres'])
    ]);
    header('Location: /bejelentkezes');
}

/* ---------------------------- "/bejelentkezes" ---------------------------- */

function bejelentkezesHandler()
{
    if(isLoggedIn()) {
        $szerkesztes = $_GET["p-edit"];
        $transportEdit = $_GET["t-edit"];
        $userId = $_SESSION["userId"];
        $pdo = getConnection();
        $statement = $pdo->prepare("SELECT * FROM users WHERE id=?");
        $statement->execute([$userId]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        $userEmail =  $user["email"];
        if($user["personalID"] === null){
            $loginTemplate = compileTemplate('./views/loggedin.php', [
                "id" => $userId,
                "email" => $userEmail,
                "personal" => null,
                "transport" => null,
                "personalEdit" => $szerkesztes ?? "",
                "transportEdit" => $transportEdit ?? "",
            ] );
            echo compileTemplate('./views/wrapper.php', [
                'loginTemplate' => $loginTemplate,
                'rattanTemplate' => null,
                'heartboxTemplate' => null,
                'szalasTemplate' => null,
                'koszoruTemplate' => null,
                "karacsonyTemplate" => null,
                'bemutatoTemplate' => null,
                'valentinTemplate' => null,
                'innerIntroductionTemplate' => null,
                'innerTemplate' => null,
                'innerCartTemplate' => null,
                'isAuthorized' => isLoggedIn(),
                'isSuccess' => isset($_GET['kuldesSikeres'])
                
            ]);
            return;
            
        }
        else{
            $szerkesztes = $_GET["p-edit"];
            $transportEdit = $_GET["t-edit"];
            $personalID = $user["personalID"];
            $pdo = getConnection();
            $statement = $pdo->prepare("SELECT * FROM `personal` WHERE id=?");
            $statement->execute([$personalID]);
            $personal = $statement->fetch(PDO::FETCH_ASSOC);
            if($personal["transportID"] === null)
            {
                $loginTemplate = compileTemplate('./views/loggedin.php', [
                    "id" => $personalID,
                    "email" => $userEmail,
                    "personal" => $personalID,
                    "personalEdit" => $szerkesztes ?? "",
                    "transportEdit" => $transportEdit ?? "",
                    "transport" => null,
                    "name" => $personal["name"],
                    "phone" => $personal["phoneNumber"],
                    "taxnumber" => $personal["taxNumber"],
                    "zipcode" => $personal["zipcode"],
                    "city" => $personal["city"],
                    "address" => $personal["address"]
                ] );
                echo compileTemplate('./views/wrapper.php', [
                    'loginTemplate' => $loginTemplate,
                    'rattanTemplate' => null,
                    'heartboxTemplate' => null,
                    'szalasTemplate' => null,
                    'koszoruTemplate' => null,
                    "karacsonyTemplate" => null,
                    'bemutatoTemplate' => null,
                    'valentinTemplate' => null,
                    'innerIntroductionTemplate' => null,
                    'innerTemplate' => null,
                    'innerCartTemplate' => null,
                    'isAuthorized' => isLoggedIn(),
                    'isSuccess' => isset($_GET['kuldesSikeres'])
                    
                ]);
                return;
            }else{
                $transportID = $personal["transportID"];
                $pdo = getConnection();
                $statement = $pdo->prepare("SELECT * FROM `transport` WHERE id=?");
                $statement->execute([$transportID]);
                $transport = $statement->fetch(PDO::FETCH_ASSOC);
                $loginTemplate = compileTemplate('./views/loggedin.php', [
                    "id" => $personalID,
                    "email" => $userEmail,
                    "personal" => $personalID,
                    "transport" => $transportID,
                    "personalEdit" => $szerkesztes ?? "",
                    "transportEdit" => $transportEdit ?? "",
                    "name" => $personal["name"],
                    "phone" => $personal["phoneNumber"],
                    "taxnumber" => $personal["taxNumber"],
                    "zipcode" => $personal["zipcode"],
                    "city" => $personal["city"],
                    "address" => $personal["address"],
                    "transportName" => $transport["name"],
                    "transportPhone" => $transport["phone"],
                    "transportZipcode" => $transport["zipcode"],
                    "transportCity" => $transport["city"],
                    "transportAddress" => $transport["address"],
                    "transportComment" => $transport["comment"],

                ] );
                echo compileTemplate('./views/wrapper.php', [
                    'loginTemplate' => $loginTemplate,
                    'rattanTemplate' => null,
                    'heartboxTemplate' => null,
                    'szalasTemplate' => null,
                    'koszoruTemplate' => null,
                    "karacsonyTemplate" => null,
                    'bemutatoTemplate' => null,
                    'valentinTemplate' => null,
                    'innerIntroductionTemplate' => null,
                    'innerTemplate' => null,
                    'innerCartTemplate' => null,
                    'isAuthorized' => isLoggedIn(),
                    'isSuccess' => isset($_GET['kuldesSikeres'])
                    
                ]);
                return;
            }
        }
    }
    
    $loginTemplate = compileTemplate('./views/login.php', [
        "message" => ""
    ] );
        echo compileTemplate('./views/wrapper.php', [
            'loginTemplate' => $loginTemplate,
            'rattanTemplate' => null,
            'heartboxTemplate' => null,
            'szalasTemplate' => null,
            'koszoruTemplate' => null,
            "karacsonyTemplate" => null,
            'bemutatoTemplate' => null,
            'valentinTemplate' => null,
            'innerIntroductionTemplate' => null,
            'innerTemplate' => null,
            'innerCartTemplate' => null,
            'isAuthorized' => false,
            'isSuccess' => isset($_GET['kuldesSikeres'])
    ]);
    
}

/* ---------------------------- "/delete-product" --------------------------- */

function orderDeleteHandler()
{
    $deletedProductId = $_GET["id"] ?? "";
    $products = json_decode(file_get_contents("./data/order.json"), true); 
    $foundProductIndex = -1; 
    foreach ($products as $index => $product) {
        if ($product["id"] === $deletedProductId) {
            $foundProductIndex = $index;
            break;
        }
    }

    if ($foundProductIndex === -1) {
        header("Location: /cart");
        return;
    }
    $orderType = $products[$foundProductIndex]["type"];
    $orderPiece = $products[$foundProductIndex]["piece"];
    $orderPreviousId = $products[$foundProductIndex]["previous"];
    $orderLocation = $products[$foundProductIndex]["location"];
    $Location = "./data/$orderLocation.json";
    $foundProducts = json_decode(file_get_contents($Location), true); 
    $previousProductIndex = -1; 
    foreach($foundProducts as $index => $product) {
        if ($product["id"] === $orderPreviousId) {
            $foundProducts[$index]["piece"] += $orderPiece;
            break;
        }
    }
    $json = json_encode($foundProducts, JSON_UNESCAPED_UNICODE);

    file_put_contents($Location, $json);

    array_splice($products, $foundProductIndex, 1);

    file_put_contents("./data/order.json", json_encode($products, JSON_UNESCAPED_UNICODE));
    header("Location: /cart#cart");
}

/* --------------------------------- "/user" -------------------------------- */

function userHandler()
{
    
   if(isLoggedIn()) {
        $szerkesztes = $_GET["p-edit"];
        $transportEdit = $_GET["t-edit"];
        $userId = $_SESSION["userId"];
        $pdo = getConnection();
        $statement = $pdo->prepare("SELECT * FROM users WHERE id=?");
        $statement->execute([$userId]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        $userEmail =  $user["email"];
        if($user["personalID"] === null){
            $loginTemplate = compileTemplate('./views/user.php', [
                "id" => $userId,
                "email" => $userEmail,
                "personal" => null,
                "transport" => null,
                "personalEdit" => $szerkesztes ?? "",
                "transportEdit" => $transportEdit ?? "",
            ] );
            echo compileTemplate('./views/wrapper.php', [
                'loginTemplate' => $loginTemplate,
                'rattanTemplate' => null,
                'heartboxTemplate' => null,
                'szalasTemplate' => null,
                'koszoruTemplate' => null,
                "karacsonyTemplate" => null,
                'bemutatoTemplate' => null,
                'valentinTemplate' => null,
                'innerIntroductionTemplate' => null,
                'innerTemplate' => null,
                'innerCartTemplate' => null,
                'isAuthorized' => isLoggedIn(),
                'isSuccess' => isset($_GET['kuldesSikeres'])
                
            ]);
            return;
            
        }
        else{
            $szerkesztes = $_GET["p-edit"];
            $transportEdit = $_GET["t-edit"];
            $personalID = $user["personalID"];
            $pdo = getConnection();
            $statement = $pdo->prepare("SELECT * FROM `personal` WHERE id=?");
            $statement->execute([$personalID]);
            $personal = $statement->fetch(PDO::FETCH_ASSOC);
            if($personal["transportID"] === null)
            {
                $loginTemplate = compileTemplate('./views/user.php', [
                    "id" => $personalID,
                    "email" => $userEmail,
                    "personal" => $personalID,
                    "personalEdit" => $szerkesztes ?? "",
                    "transportEdit" => $transportEdit ?? "",
                    "transport" => null,
                    "name" => $personal["name"],
                    "phone" => $personal["phoneNumber"],
                    "taxnumber" => $personal["taxNumber"],
                    "zipcode" => $personal["zipcode"],
                    "city" => $personal["city"],
                    "address" => $personal["address"]
                ] );
                echo compileTemplate('./views/wrapper.php', [
                    'loginTemplate' => $loginTemplate,
                    'rattanTemplate' => null,
                    'heartboxTemplate' => null,
                    'szalasTemplate' => null,
                    'koszoruTemplate' => null,
                    "karacsonyTemplate" => null,
                    'bemutatoTemplate' => null,
                    'valentinTemplate' => null,
                    'innerIntroductionTemplate' => null,
                    'innerTemplate' => null,
                    'innerCartTemplate' => null,
                    'isAuthorized' => isLoggedIn(),
                    'isSuccess' => isset($_GET['kuldesSikeres'])
                    
                ]);
                return;
            }else{
                $transportID = $personal["transportID"];
                $pdo = getConnection();
                $statement = $pdo->prepare("SELECT * FROM `transport` WHERE id=?");
                $statement->execute([$transportID]);
                $transport = $statement->fetch(PDO::FETCH_ASSOC);
                $loginTemplate = compileTemplate('./views/user.php', [
                    "id" => $personalID,
                    "email" => $userEmail,
                    "personal" => $personalID,
                    "transport" => $transportID,
                    "personalEdit" => $szerkesztes ?? "",
                    "transportEdit" => $transportEdit ?? "",
                    "name" => $personal["name"],
                    "phone" => $personal["phoneNumber"],
                    "taxnumber" => $personal["taxNumber"],
                    "zipcode" => $personal["zipcode"],
                    "city" => $personal["city"],
                    "address" => $personal["address"],
                    "transportName" => $transport["name"],
                    "transportPhone" => $transport["phone"],
                    "transportZipcode" => $transport["zipcode"],
                    "transportCity" => $transport["city"],
                    "transportAddress" => $transport["address"],
                    "transportComment" => $transport["comment"],

                ] );
                echo compileTemplate('./views/wrapper.php', [
                    'loginTemplate' => $loginTemplate,
                    'rattanTemplate' => null,
                    'heartboxTemplate' => null,
                    'szalasTemplate' => null,
                    'koszoruTemplate' => null,
                    "karacsonyTemplate" => null,
                    'bemutatoTemplate' => null,
                    'valentinTemplate' => null,
                    'innerIntroductionTemplate' => null,
                    'innerTemplate' => null,
                    'innerCartTemplate' => null,
                    'isAuthorized' => isLoggedIn(),
                    'isSuccess' => isset($_GET['kuldesSikeres'])
                    
                ]);
                return;
            }
        }
    }
    
    $userTemplate = compileTemplate('./views/user.php', [
        "message" => "",
        "email" => ""
    ]);
    echo compileTemplate('./views/wrapper.php', [
        'innerCartTemplate' => $userTemplate,
        'rattanTemplate' => null,
        'heartboxTemplate' => null,
        'szalasTemplate' => null,
        'koszoruTemplate' => null,
        "karacsonyTemplate" => null,
        'bemutatoTemplate' => null,
        'valentinTemplate' => null,
        'innerIntroductionTemplate' => null,
        'loginTemplate' => null,
        'innerTemplate' => null,
        'isAuthorized' => isLoggedIn(),
        'isSuccess' => isset($_GET['kuldesSikeres'])
    ]); 
    
}

/* ------------------------- "/transportandpayment" ------------------------- */

function  paymentHandler() {
    $transportpayment = json_decode(file_get_contents("./data/transportpayment.json"), true);
    $transportpayment = [];
    $json = json_encode($transportpayment, JSON_UNESCAPED_UNICODE);
    file_put_contents('./data/transportpayment.json', $json);

    if(isLoggedIn()) {
        $szerkesztes = $_GET["p-edit"];
        $transportEdit = $_GET["t-edit"];
        $userId = $_SESSION["userId"];
        $pdo = getConnection();
        $statement = $pdo->prepare("SELECT * FROM users WHERE id=?");
        $statement->execute([$userId]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        $userEmail =  $user["email"];
        if($user["personalID"] === null){
            $loginTemplate = compileTemplate('./views/paymentandtransport.php', [
                "id" => $userId,
                "email" => $userEmail,
                "personal" => null,
                "transport" => null,
                "personalEdit" => $szerkesztes ?? "",
                "transportEdit" => $transportEdit ?? "",
            ] );
            echo compileTemplate('./views/wrapper.php', [
                'loginTemplate' => $loginTemplate,
                'rattanTemplate' => null,
                'heartboxTemplate' => null,
                'szalasTemplate' => null,
                'koszoruTemplate' => null,
                "karacsonyTemplate" => null,
                'bemutatoTemplate' => null,
                'valentinTemplate' => null,
                'innerIntroductionTemplate' => null,
                'innerTemplate' => null,
                'innerCartTemplate' => null,
                'isAuthorized' => isLoggedIn(),
                'isSuccess' => isset($_GET['kuldesSikeres'])
                
            ]);
            return;
            
        }
        else{
            $szerkesztes = $_GET["p-edit"];
            $transportEdit = $_GET["t-edit"];
            $personalID = $user["personalID"];
            $pdo = getConnection();
            $statement = $pdo->prepare("SELECT * FROM `personal` WHERE id=?");
            $statement->execute([$personalID]);
            $personal = $statement->fetch(PDO::FETCH_ASSOC);
            if($personal["transportID"] === null)
            {
                $loginTemplate = compileTemplate('./views/paymentandtransport.php', [
                    "id" => $personalID,
                    "email" => $userEmail,
                    "personal" => $personalID,
                    "personalEdit" => $szerkesztes ?? "",
                    "transportEdit" => $transportEdit ?? "",
                    "transport" => null,
                    "name" => $personal["name"],
                    "phone" => $personal["phoneNumber"],
                    "taxnumber" => $personal["taxNumber"],
                    "zipcode" => $personal["zipcode"],
                    "city" => $personal["city"],
                    "address" => $personal["address"]
                ] );
                echo compileTemplate('./views/wrapper.php', [
                    'loginTemplate' => $loginTemplate,
                    'rattanTemplate' => null,
                    'heartboxTemplate' => null,
                    'szalasTemplate' => null,
                    'koszoruTemplate' => null,
                    "karacsonyTemplate" => null,
                    'bemutatoTemplate' => null,
                    'valentinTemplate' => null,
                    'innerIntroductionTemplate' => null,
                    'innerTemplate' => null,
                    'innerCartTemplate' => null,
                    'isAuthorized' => isLoggedIn(),
                    'isSuccess' => isset($_GET['kuldesSikeres'])
                    
                ]);
                return;
            }else{
                $transportID = $personal["transportID"];
                $pdo = getConnection();
                $statement = $pdo->prepare("SELECT * FROM `transport` WHERE id=?");
                $statement->execute([$transportID]);
                $transport = $statement->fetch(PDO::FETCH_ASSOC);
                $loginTemplate = compileTemplate('./views/paymentandtransport.php', [
                    "id" => $personalID,
                    "email" => $userEmail,
                    "personal" => $personalID,
                    "transport" => $transportID,
                    "personalEdit" => $szerkesztes ?? "",
                    "transportEdit" => $transportEdit ?? "",
                    "name" => $personal["name"],
                    "phone" => $personal["phoneNumber"],
                    "taxnumber" => $personal["taxNumber"],
                    "zipcode" => $personal["zipcode"],
                    "city" => $personal["city"],
                    "address" => $personal["address"],
                    "transportName" => $transport["name"],
                    "transportPhone" => $transport["phone"],
                    "transportZipcode" => $transport["zipcode"],
                    "transportCity" => $transport["city"],
                    "transportAddress" => $transport["address"],
                    "transportComment" => $transport["comment"],

                ] );
                echo compileTemplate('./views/wrapper.php', [
                    'loginTemplate' => $loginTemplate,
                    'rattanTemplate' => null,
                    'heartboxTemplate' => null,
                    'szalasTemplate' => null,
                    'koszoruTemplate' => null,
                    "karacsonyTemplate" => null,
                    'bemutatoTemplate' => null,
                    'valentinTemplate' => null,
                    'innerIntroductionTemplate' => null,
                    'innerTemplate' => null,
                    'innerCartTemplate' => null,
                    'isAuthorized' => isLoggedIn(),
                    'isSuccess' => isset($_GET['kuldesSikeres'])
                    
                ]);
                return;
            }
        }
    }
    
    $paymentTemplate = compileTemplate('./views/paymentandtransport.php', [
        "message" => "",
        "email" => ""
    ]);
    echo compileTemplate('./views/wrapper.php', [
        'innerCartTemplate' => $paymentTemplate,
        'rattanTemplate' => null,
        'heartboxTemplate' => null,
        'szalasTemplate' => null,
        'koszoruTemplate' => null,
        "karacsonyTemplate" => null,
        'bemutatoTemplate' => null,
        'valentinTemplate' => null,
        'innerIntroductionTemplate' => null,
        'loginTemplate' => null,
        'innerTemplate' => null,
        'isAuthorized' => isLoggedIn(),
        'isSuccess' => isset($_GET['kuldesSikeres'])
    ]); 
    
}

/* -------------------------------- "/tools/images" -------------------------------- */

function imagesHandler() {
    $imageTemplate = compileTemplate('./views/images.php', []);
    echo compileTemplate('./views/tools.php', [
        'toolsTemplate' => $imageTemplate
    ]);
    
} 

/* --------------------------- "/tools/background" -------------------------- */

function backgroundsHandler() {
    $backgroundTemplate = compileTemplate('./views/backgrounds.php', []);
    echo compileTemplate('./views/tools.php', [
        'toolsTemplate' => $backgroundTemplate
    ]);
}

/* ----------------------------- "/tools/colors" ---------------------------- */

function colorsHandler() {
    $colorTemplate = compileTemplate('./views/colors.php', []);
    echo compileTemplate('./views/tools.php', [
        'toolsTemplate' => $colorTemplate
    ]);
}

/* ------------------------------ "/tools/png" ------------------------------ */

function pngHandler() {
    $pngTemplate = compileTemplate('./views/png.php', []);
    echo compileTemplate('./views/tools.php', [
        'toolsTemplate' => $pngTemplate
    ]);
}

/* ----------------------------- "/tools/other" ----------------------------- */

function otherHandler() {
    $otherTemplate = compileTemplate('./views/other.php', []);
    echo compileTemplate('./views/tools.php', [
        'toolsTemplate' => $otherTemplate
    ]);
}

/* ----------------------------- "/ordersummary" ---------------------------- */

function ordersummaryHandler(){
    if(isLoggedIn()) {
        $userId = $_SESSION["userId"];
        $pdo = getConnection();
        $statement = $pdo->prepare("SELECT * FROM users WHERE id=?");
        $statement->execute([$userId]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        $userEmail =  $user["email"];
            $personalID = $user["personalID"];
            $pdo = getConnection();
            $statement = $pdo->prepare("SELECT * FROM `personal` WHERE id=?");
            $statement->execute([$personalID]);
            $personal = $statement->fetch(PDO::FETCH_ASSOC);
                $transportID = $personal["transportID"];
                $pdo = getConnection();
                $statement = $pdo->prepare("SELECT * FROM `transport` WHERE id=?");
                $statement->execute([$transportID]);
                $transport = $statement->fetch(PDO::FETCH_ASSOC);
                $ordersummaryTemplate = compileTemplate('./views/ordersummary.php', [
                    "id" => $personalID,
                    "email" => $userEmail,
                    "personal" => $personalID,
                    "transport" => $transportID,
                    "personalEdit" => $szerkesztes ?? "",
                    "transportEdit" => $transportEdit ?? "",
                    "name" => $personal["name"],
                    "phone" => $personal["phoneNumber"],
                    "taxnumber" => $personal["taxNumber"],
                    "zipcode" => $personal["zipcode"],
                    "city" => $personal["city"],
                    "address" => $personal["address"],
                    "transportName" => $transport["name"],
                    "transportPhone" => $transport["phone"],
                    "transportZipcode" => $transport["zipcode"],
                    "transportCity" => $transport["city"],
                    "transportAddress" => $transport["address"],
                    "transportComment" => $transport["comment"],

                ] );
                echo compileTemplate('./views/wrapper.php', [
                    'loginTemplate' => $ordersummaryTemplate,
                    'rattanTemplate' => null,
                    'heartboxTemplate' => null,
                    'szalasTemplate' => null,
                    'koszoruTemplate' => null,
                    "karacsonyTemplate" => null,
                    'bemutatoTemplate' => null,
                    'valentinTemplate' => null,
                    'innerIntroductionTemplate' => null,
                    'innerTemplate' => null,
                    'innerCartTemplate' => null,
                    'isAuthorized' => isLoggedIn(),
                    'isSuccess' => isset($_GET['kuldesSikeres'])
                    
                ]);
                return;
    }

    
    $ordersummaryTemplate = compileTemplate('./views/ordersummary.php', [
        "message" => "",
        "email" => ""
    ]);
    echo compileTemplate('./views/wrapper.php', [
        'innerCartTemplate' => $ordersummaryTemplate,
        'rattanTemplate' => null,
        'heartboxTemplate' => null,
        'szalasTemplate' => null,
        'koszoruTemplate' => null,
        "karacsonyTemplate" => null,
        'bemutatoTemplate' => null,
        'valentinTemplate' => null,
        'innerIntroductionTemplate' => null,
        'loginTemplate' => null,
        'innerTemplate' => null,
        'isAuthorized' => isLoggedIn(),
        'isSuccess' => isset($_GET['kuldesSikeres'])
    ]); 
    
}



/* -------------------------------------------------------------------------- */
/*                      Rendszerfüggvények "POST" method                      */
/* -------------------------------------------------------------------------- */


/* -------------------------------- "/edited" ------------------------------- */

function editedHandler() {
    $orderLocation = $_POST["location"];
    $previous = $_POST["previous"];
    $Location = "./data/$orderLocation.json";
    $products = json_decode(file_get_contents($Location), true);
    $foundProductIndex = -1;
    foreach($products as $index => $product) {
        if($product["id"] === $previous) {
            $foundProductIndex = $index;
            break;
        }
    }
    if($foundProductIndex === -1) {
        header("Location: /");
        return;
    }
    $stock = $products[$foundProductIndex]["piece"] + $_POST["orderPiece"];
    $products[$foundProductIndex]["piece"] = $stock - $_POST["piece"];
    $json = json_encode($products, JSON_UNESCAPED_UNICODE);

    file_put_contents($Location, $json);
    $id = $_POST["id"]; 

    $order = json_decode(file_get_contents("./data/order.json"), true); 
    $foundOrderIndex = -1; 
    foreach ($order as $index => $product) {
        if ($product["id"] === $id) {
            $foundOrderIndex = $index;
            break;
        }
    }

    if ($foundOrderIndex === -1) {
        header("Location: /cart#cart");
        return;
    }
    $order[$foundOrderIndex]["piece"] = $_POST["piece"];
    $order[$foundOrderIndex]["stock"] = $stock - $_POST["piece"];
    $orderjson = json_encode($order, JSON_UNESCAPED_UNICODE);

    file_put_contents("./data/order.json", $orderjson);
    header("Location: /cart");
}

/* --------------------------------- "/cart" -------------------------------- */

function cartSendHandler() 
{
    $orderProductID = $_POST["id"];
    $orderLocation = $_POST["location"];
    $Location = "./data/$orderLocation.json";
    $orderProductPiece = (int)$_POST["piece"];

    $products = json_decode(file_get_contents($Location), true);
    $lastIndex = count($products)-1;
    $foundProductIndex = -1;
    foreach($products as $index => $product) {
        if($product["id"] === $orderProductID) {
            $foundProductIndex = $index;
            break;
        }
    }
    if($foundProductIndex === -1) {
        header("Location: /");
        return;
    }
    $products[$foundProductIndex]["piece"] = $products[$foundProductIndex]["piece"] - $orderProductPiece;
    $json = json_encode($products, JSON_UNESCAPED_UNICODE);

    file_put_contents($Location, $json);
    
    $newOrder = [
        "id" => uniqid(),
        "previous" => $products[$foundProductIndex]["id"],
        "stock" => $products[$foundProductIndex]["piece"],
        "name" => $products[$foundProductIndex]["name"],
        "img" => $products[$foundProductIndex]["img"],
        "piece" => $orderProductPiece,
        "price" => $products[$lastIndex]["price"],
        "type" =>  $products[$lastIndex]["type"],
        "location" => $products[$lastIndex]["location"]
    ];
    $order = json_decode(file_get_contents("./data/order.json"), true);
    array_push($order, $newOrder);
    $orderjson = json_encode($order, JSON_UNESCAPED_UNICODE);

    file_put_contents('./data/order.json', $orderjson);
    header("Location: /#$orderProductID");
    
}

/* ------------------------------- "/register" ------------------------------ */

function registrationHandler()
{
    $pdo = getConnection();
    $statement = $pdo->prepare("SELECT email FROM users WHERE email = ?");
    $statement->execute([$_POST["email"]]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if($user) {
        $regisztracioTemplate = compileTemplate('./views/register.php', [
            'message' => "invalid"
        ]);
        echo compileTemplate('./views/wrapper.php', [
            'loginTemplate' => $regisztracioTemplate,
            'rattanTemplate' => null,
            'heartboxTemplate' => null,
            'szalasTemplate' => null,
            'koszoruTemplate' => null,
            "karacsonyTemplate" => null,
            'bemutatoTemplate' => null,
            'valentinTemplate' => null,
            'innerIntroductionTemplate' => null,
            'innerTemplate' => null,
            'innerCartTemplate' => null,
            'isAuthorized' => isLoggedIn()
    ]);

        return;
    
    };
    if($_POST['password'] === "") {
        $regisztracioTemplate = compileTemplate('./views/register.php', [
            'message' => "invalid"
        ]);
        echo compileTemplate('./views/wrapper.php', [
            'loginTemplate' => $regisztracioTemplate,
            'rattanTemplate' => null,
            'heartboxTemplate' => null,
            'szalasTemplate' => null,
            'koszoruTemplate' => null,
            "karacsonyTemplate" => null,
            'bemutatoTemplate' => null,
            'valentinTemplate' => null,
            'innerIntroductionTemplate' => null,
            'innerTemplate' => null,
            'innerCartTemplate' => null,
            'isAuthorized' => isLoggedIn()
    ]);

        return;
    
    };
    $statment2 = $pdo->prepare(
        "INSERT INTO `users` (`email`, `password`, `createdAt`, `personalID`) 
        VALUES (?, ?, ?, ?);" 
    );
    $statment2->execute([
        $_POST["email"],
        password_hash($_POST["password"], PASSWORD_DEFAULT),
        time(),
        null
    ]);
    $regisztracioTemplate = compileTemplate('./views/login.php', [
        'message' => "successful"
    ]);
    echo compileTemplate('./views/wrapper.php', [
        'loginTemplate' => $regisztracioTemplate,
        'rattanTemplate' => null,
        'heartboxTemplate' => null,
        'szalasTemplate' => null,
        'koszoruTemplate' => null,
        "karacsonyTemplate" => null,
        'bemutatoTemplate' => null,
        'valentinTemplate' => null,
        'innerIntroductionTemplate' => null,
        'innerTemplate' => null,
        'innerCartTemplate' => null,
        'isAuthorized' => isLoggedIn(),
        'isSuccess' => isset($_GET['kuldesSikeres'])
    ]);

    header('Location: /bejelentkezes'); 
}

/* -------------------------------- "/login" -------------------------------- */

function loginHandler()
{
    $Location = $_POST["location"];
    $pdo = getConnection();
    $statement = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $statement->execute([$_POST["email"]]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if(!$user) {
        $regisztracioTemplate = compileTemplate('./views/login.php', [
            'message' => "invalid"
        ]);
        echo compileTemplate('./views/wrapper.php', [
            'loginTemplate' => $regisztracioTemplate,
            'rattanTemplate' => null,
            'heartboxTemplate' => null,
            'szalasTemplate' => null,
            'koszoruTemplate' => null,
            "karacsonyTemplate" => null,
            'bemutatoTemplate' => null,
            'valentinTemplate' => null,
            'innerIntroductionTemplate' => null,
            'innerTemplate' => null,
            'innerCartTemplate' => null,
            'isAuthorized' => isLoggedIn()
    ]);
        return;
    
    };
    $isVerified = password_verify($_POST['password'], $user["password"]);

    if(!$isVerified) {
        $regisztracioTemplate = compileTemplate('./views/login.php', [
            'message' => "invalid"
        ]);
        echo compileTemplate('./views/wrapper.php', [
            'loginTemplate' => $regisztracioTemplate,
            'rattanTemplate' => null,
            'heartboxTemplate' => null,
            'szalasTemplate' => null,
            'koszoruTemplate' => null,
            "karacsonyTemplate" => null,
            'bemutatoTemplate' => null,
            'valentinTemplate' => null,
            'innerIntroductionTemplate' => null,
            'innerTemplate' => null,
            'innerCartTemplate' => null,
            'isAuthorized' => isLoggedIn()
    ]);
        return;
    }
    session_start();
    $_SESSION['userId'] = $user["id"];
    header('Location: /' . $Location);
    
}

/* -------------------------------- "/logout" ------------------------------- */

function logoutHandler()
{
    session_start();
    $params = session_get_cookie_params(); 
    setcookie(session_name(),  '', 0, $params['path'], $params['domain'], $params['secure'], isset($params['httponly']));
    session_destroy(); 
    header('Location: /'); 
}


/* ----------------------------- /submit-message ---------------------------- */

function submitMessageHandler()
{
    $pdo = getConnection();
    $statement = $pdo->prepare("INSERT INTO `messages` 
    (`email`, `subject`, `body`, `status`, `numberOfAttempts`, `sentAt`, `createdAt`) 
    VALUES 
    (?, ?, ?, ?, ?, ?, ?);");
    $body = compileTemplate("./views/email-template.php", [
        'name' =>  $_POST['name'] ?? '',
        'email' =>  $_POST['email'] ?? '',
        'content' =>  $_POST['content'],
    ]);
    $statement->execute([
        $_SERVER['RECIPIENT_EMAIL'],
        "Új üzenet érkezett",
        $body,
        'notSent',
        0,
        0,
        time()
    ]);

    header('Location: /?kuldesSikeres=1#contact');   
}

/* ------------------------------- /send-mails ------------------------------ */

function sendMailsHandler()
{
    if(($_POST['key'] ?? '') !== $_SERVER['WORKER_KEY']) {
        http_response_code(401);
        echo json_encode(['error' => 'unauthorized']);
        return;
    }

    $pdo = getConnection();
    $statement = $pdo->prepare(
        "SELECT * FROM messages 
        WHERE 
        status = 'notSent' AND 
        numberOfAttempts < 10 
        ORDER BY createdAt ASC"
    );
    $statement->execute();
    $messages = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($messages as $message) {
        $pdo = getConnection();
        $statement = $pdo->prepare(
            "UPDATE `messages` SET 
                status = 'sending', 
                numberOfAttempts = ? 
            WHERE id = ?;"
        );

        $statement->execute([
            (int)$message['numberOfAttempts'] + 1,
            $message['id']
        ]);

        $isSent = sendMail(
            $message['email'],
            $message['subject'],
            $message['body']
        );

        if ($isSent) {
            $statement = $pdo->prepare(
                "UPDATE `messages` SET status = 'sent', sentAt = ? WHERE id = ?;"
            );
            $statement->execute([
                time(),
                $message['id'],
            ]);
        } else {
            $statement = $pdo->prepare("UPDATE `messages` SET status = 'notSent' WHERE id = ?;");
            $statement->execute([
                $message['id']
            ]);
        }
    }
}

/* ----------------------------- /userinvoicing ----------------------------- */

function userInvoicingHandler()
{
    $userID = $_POST["id"];
    $pdo = getConnection();
    $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
    $userEmail = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
    $zipcode = filter_var($_POST["zipcode"], FILTER_SANITIZE_STRING);
    $city = filter_var($_POST["city"], FILTER_SANITIZE_STRING);
    $address = filter_var($_POST["address"], FILTER_SANITIZE_STRING);
    $phonenumber = filter_var($_POST["phonenumber"], FILTER_SANITIZE_STRING);
    $taxnumber = filter_var($_POST["taxnumber"], FILTER_SANITIZE_STRING);
    if(empty($username)) {
        $loginTemplate = compileTemplate('./views/loggedin.php', [
            "message" => "invalid",
            "id" => $userID,
        ]);
        echo compileTemplate('./views/wrapper.php', [
                'loginTemplate' => $loginTemplate,
                'rattanTemplate' => null,
                'heartboxTemplate' => null,
                'szalasTemplate' => null,
                'koszoruTemplate' => null,
                "karacsonyTemplate" => null,
                'bemutatoTemplate' => null,
                'valentinTemplate' => null,
                'innerIntroductionTemplate' => null,
                'innerTemplate' => null,
                'innerCartTemplate' => null,
                'isAuthorized' => isLoggedIn(),
                'isSuccess' => isset($_GET['kuldesSikeres'])
        ]);
        header('Location: /bejelentkezes');
        exit;
    };
    if(empty($zipcode)) {
        $loginTemplate = compileTemplate('./views/loggedin.php', [
            "message" => "invalid",
            "id" => $userID
        ]);
        echo compileTemplate('./views/wrapper.php', [
                'loginTemplate' => $loginTemplate,
                'rattanTemplate' => null,
                'heartboxTemplate' => null,
                'szalasTemplate' => null,
                'koszoruTemplate' => null,
                "karacsonyTemplate" => null,
                'bemutatoTemplate' => null,
                'valentinTemplate' => null,
                'innerIntroductionTemplate' => null,
                'innerTemplate' => null,
                'innerCartTemplate' => null,
                'isAuthorized' => isLoggedIn(),
                'isSuccess' => isset($_GET['kuldesSikeres'])
        ]);
        header('Location: /bejelentkezes');
        exit;
    };
    if(empty($city)) {
        $loginTemplate = compileTemplate('./views/loggedin.php', [
            "message" => "invalid",
            "id" => $userID
        ]);
        echo compileTemplate('./views/wrapper.php', [
                'loginTemplate' => $loginTemplate,
                'rattanTemplate' => null,
                'heartboxTemplate' => null,
                'szalasTemplate' => null,
                'koszoruTemplate' => null,
                "karacsonyTemplate" => null,
                'bemutatoTemplate' => null,
                'valentinTemplate' => null,
                'innerIntroductionTemplate' => null,
                'innerTemplate' => null,
                'innerCartTemplate' => null,
                'isAuthorized' => isLoggedIn(),
                'isSuccess' => isset($_GET['kuldesSikeres'])
        ]);
        header('Location: /bejelentkezes');
        exit;
    };
    if(empty($address)) {
        $loginTemplate = compileTemplate('./views/loggedin.php', [
            "message" => "invalid",
            "id" => $userID
        ]);
        echo compileTemplate('./views/wrapper.php', [
                'loginTemplate' => $loginTemplate,
                'rattanTemplate' => null,
                'heartboxTemplate' => null,
                'szalasTemplate' => null,
                'koszoruTemplate' => null,
                "karacsonyTemplate" => null,
                'bemutatoTemplate' => null,
                'valentinTemplate' => null,
                'innerIntroductionTemplate' => null,
                'innerTemplate' => null,
                'innerCartTemplate' => null,
                'isAuthorized' => isLoggedIn(),
                'isSuccess' => isset($_GET['kuldesSikeres'])
        ]);
        header('Location: /bejelentkezes');
        exit;
    };
    if(strlen($zipcode) !== 4) {
        $loginTemplate = compileTemplate('./views/loggedin.php', [
            "message" => "not4",
            "id" => $userID
        ]);
        echo compileTemplate('./views/wrapper.php', [
                'loginTemplate' => $loginTemplate,
                'rattanTemplate' => null,
                'heartboxTemplate' => null,
                'szalasTemplate' => null,
                'koszoruTemplate' => null,
                "karacsonyTemplate" => null,
                'bemutatoTemplate' => null,
                'valentinTemplate' => null,
                'innerIntroductionTemplate' => null,
                'innerTemplate' => null,
                'innerCartTemplate' => null,
                'isAuthorized' => isLoggedIn(),
                'isSuccess' => isset($_GET['kuldesSikeres'])
        ]);
        header('Location: /bejelentkezes');
        exit;
    };
    
   
    $personalEmail = $pdo->prepare("SELECT email FROM users WHERE id = ?");
    $personalEmail->execute([$userID]);
    $email = $personalEmail->fetchAll(PDO::FETCH_ASSOC);
    $userEmail = $email[0]["email"];
    $statement = $pdo->prepare("INSERT INTO `personal` 
    (`name`, `zipcode`, `city`, `address`, `phoneNumber`, `taxNumber`, `email`, `transportID`) 
    VALUES 
    (?, ?, ?, ?, ?, ?, ?, ?);");
    $statement->execute([
    $username,
    $zipcode, 
    $city, 
    $address, 
    $phonenumber, 
    $taxnumber,
    $userEmail,
    null

    ]);
    $newrecord = $pdo->prepare("SELECT * FROM `personal` ");
    $newrecord->execute();
    $personal = $newrecord->fetchAll(PDO::FETCH_ASSOC);
    $lastId = end($personal);
    $personalID = $pdo->prepare("UPDATE `users`
    SET personalID = ?
    WHERE id = ?");
    $personalID->execute([
        $lastId["id"],
        $userID
    ]);
    header('Location: /bejelentkezes');
  
   
}

/* ---------------------------- "/usertransport" ---------------------------- */

function userTransportHandler()
{
    $userID = $_POST["id"];
    $pdo = getConnection();
    $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
    $phonenumber = filter_var($_POST["phonenumber"], FILTER_SANITIZE_STRING);
    $zipcode = filter_var($_POST["zipcode"], FILTER_SANITIZE_STRING);
    $city = filter_var($_POST["city"], FILTER_SANITIZE_STRING);
    $address = filter_var($_POST["address"], FILTER_SANITIZE_STRING);
    $comment = filter_var($_POST["content"], FILTER_SANITIZE_STRING);
    if(empty($username)) {
        $loginTemplate = compileTemplate('./views/loggedin.php', [
            "message" => "invalid2",
            "id" => $userID,
        ]);
        echo compileTemplate('./views/wrapper.php', [
                'loginTemplate' => $loginTemplate,
                'rattanTemplate' => null,
                'heartboxTemplate' => null,
                'szalasTemplate' => null,
                'koszoruTemplate' => null,
                "karacsonyTemplate" => null,
                'bemutatoTemplate' => null,
                'valentinTemplate' => null,
                'innerIntroductionTemplate' => null,
                'innerTemplate' => null,
                'innerCartTemplate' => null,
                'isAuthorized' => isLoggedIn(),
                'isSuccess' => isset($_GET['kuldesSikeres'])
        ]);
        header('Location: /bejelentkezes');
        exit;
    };
    if(empty($zipcode)) {
        $loginTemplate = compileTemplate('./views/loggedin.php', [
            "message" => "invalid2",
            "id" => $userID
        ]);
        echo compileTemplate('./views/wrapper.php', [
                'loginTemplate' => $loginTemplate,
                'rattanTemplate' => null,
                'heartboxTemplate' => null,
                'szalasTemplate' => null,
                'koszoruTemplate' => null,
                "karacsonyTemplate" => null,
                'bemutatoTemplate' => null,
                'valentinTemplate' => null,
                'innerIntroductionTemplate' => null,
                'innerTemplate' => null,
                'innerCartTemplate' => null,
                'isAuthorized' => isLoggedIn(),
                'isSuccess' => isset($_GET['kuldesSikeres'])
        ]);
        header('Location: /bejelentkezes');
        exit;
    };
    if(empty($city)) {
        $loginTemplate = compileTemplate('./views/loggedin.php', [
            "message" => "invalid2",
            "id" => $userID
        ]);
        echo compileTemplate('./views/wrapper.php', [
                'loginTemplate' => $loginTemplate,
                'rattanTemplate' => null,
                'heartboxTemplate' => null,
                'szalasTemplate' => null,
                'koszoruTemplate' => null,
                "karacsonyTemplate" => null,
                'bemutatoTemplate' => null,
                'valentinTemplate' => null,
                'innerIntroductionTemplate' => null,
                'innerTemplate' => null,
                'innerCartTemplate' => null,
                'isAuthorized' => isLoggedIn(),
                'isSuccess' => isset($_GET['kuldesSikeres'])
        ]);
        header('Location: /bejelentkezes');
        exit;
    };
    if(empty($address)) {
        $loginTemplate = compileTemplate('./views/loggedin.php', [
            "message" => "invalid2",
            "id" => $userID
        ]);
        echo compileTemplate('./views/wrapper.php', [
                'loginTemplate' => $loginTemplate,
                'rattanTemplate' => null,
                'heartboxTemplate' => null,
                'szalasTemplate' => null,
                'koszoruTemplate' => null,
                "karacsonyTemplate" => null,
                'bemutatoTemplate' => null,
                'valentinTemplate' => null,
                'innerIntroductionTemplate' => null,
                'innerTemplate' => null,
                'innerCartTemplate' => null,
                'isAuthorized' => isLoggedIn(),
                'isSuccess' => isset($_GET['kuldesSikeres'])
        ]);
        header('Location: /bejelentkezes');
        exit;
    };
    if(strlen($zipcode) !== 4) {
        $loginTemplate = compileTemplate('./views/loggedin.php', [
            "message" => "not42",
            "id" => $userID
        ]);
        echo compileTemplate('./views/wrapper.php', [
                'loginTemplate' => $loginTemplate,
                'rattanTemplate' => null,
                'heartboxTemplate' => null,
                'szalasTemplate' => null,
                'koszoruTemplate' => null,
                "karacsonyTemplate" => null,
                'bemutatoTemplate' => null,
                'valentinTemplate' => null,
                'innerIntroductionTemplate' => null,
                'innerTemplate' => null,
                'innerCartTemplate' => null,
                'isAuthorized' => isLoggedIn(),
                'isSuccess' => isset($_GET['kuldesSikeres'])
        ]);
        header('Location: /bejelentkezes');
        exit;
    };
    $statement = $pdo->prepare("INSERT INTO `transport` 
    (`name`, `phone`, `zipcode`, `city`, `address`,  `comment`) 
    VALUES 
    (?, ?, ?, ?, ?, ?);");
    $statement->execute([
        $username,
        $phonenumber,
        $zipcode, 
        $city, 
        $address, 
        $comment

    ]);
    $newrecord = $pdo->prepare("SELECT * FROM `transport` ");
    $newrecord->execute();
    $transport = $newrecord->fetchAll(PDO::FETCH_ASSOC);
    $lastId = end($transport);
    $transportID = $pdo->prepare("UPDATE `personal`
    SET transportID = ?
    WHERE id = ?");
    $transportID->execute([
        $lastId["id"],
        $userID
    ]);
    header('Location: /bejelentkezes');
}

/* ---------------------------- "/personaledited" --------------------------- */

function personaleditedHandler()
{
   $personalID = $_POST["personalID"];
   $location = $_POST["location"];
   $column = $_POST["column"];
   $newValue = $_POST["$column"];
   $pdo = getConnection();
   $editedValue = $pdo->prepare("UPDATE `personal`
   SET $column = ? 
   WHERE id = ?");
   $editedValue->execute([
    $newValue,
    $personalID
   ]);
   header('Location: /' . $location);
   
}

/* ---------------------------- "/transportedited" --------------------------- */

function transporteditedHandler()
{
   $transportID = $_POST["transportID"];
   $location = $_POST["location"];
   $column = $_POST["column"];
   $newValue = $_POST["$column"];
   $pdo = getConnection();
   $editedValue = $pdo->prepare("UPDATE `transport`
   SET $column = ? 
   WHERE id = ?");
   $editedValue->execute([
    $newValue,
    $transportID
   ]);
   header('Location: /' . $location);
   
}

/* ---------------------------- "/orderinvoicing" --------------------------- */

function orderInvoicingHandler()
{
    $szerkesztes = $_GET["p-edit"];
    $transportEdit = $_GET["t-edit"];
    $userID = $_POST["id"];
    $pdo = getConnection();
    $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
    $zipcode = filter_var($_POST["zipcode"], FILTER_SANITIZE_STRING);
    $city = filter_var($_POST["city"], FILTER_SANITIZE_STRING);
    $address = filter_var($_POST["address"], FILTER_SANITIZE_STRING);
    $phonenumber = filter_var($_POST["phonenumber"], FILTER_SANITIZE_STRING);
    $taxnumber = filter_var($_POST["taxnumber"], FILTER_SANITIZE_STRING);
    if(empty($username)) {
        $loginTemplate = compileTemplate('./views/user.php', [
            "message" => "invalid",
            "id" => $userID,
        ]);
        echo compileTemplate('./views/wrapper.php', [
                'loginTemplate' => $loginTemplate,
                'rattanTemplate' => null,
                'heartboxTemplate' => null,
                'szalasTemplate' => null,
                'koszoruTemplate' => null,
                "karacsonyTemplate" => null,
                'bemutatoTemplate' => null,
                'valentinTemplate' => null,
                'innerIntroductionTemplate' => null,
                'innerTemplate' => null,
                'innerCartTemplate' => null,
                'isAuthorized' => isLoggedIn(),
                'isSuccess' => isset($_GET['kuldesSikeres'])
        ]);
        header('Location: /user');
        exit;
    };
    if(empty($zipcode)) {
        $loginTemplate = compileTemplate('./views/user.php', [
            "message" => "invalid",
            "id" => $userID
        ]);
        echo compileTemplate('./views/wrapper.php', [
                'loginTemplate' => $loginTemplate,
                'rattanTemplate' => null,
                'heartboxTemplate' => null,
                'szalasTemplate' => null,
                'koszoruTemplate' => null,
                "karacsonyTemplate" => null,
                'bemutatoTemplate' => null,
                'valentinTemplate' => null,
                'innerIntroductionTemplate' => null,
                'innerTemplate' => null,
                'innerCartTemplate' => null,
                'isAuthorized' => isLoggedIn(),
                'isSuccess' => isset($_GET['kuldesSikeres'])
        ]);
        header('Location: /user');
        exit;
    };
    if(empty($city)) {
        $loginTemplate = compileTemplate('./views/user.php', [
            "message" => "invalid",
            "id" => $userID
        ]);
        echo compileTemplate('./views/wrapper.php', [
                'loginTemplate' => $loginTemplate,
                'rattanTemplate' => null,
                'heartboxTemplate' => null,
                'szalasTemplate' => null,
                'koszoruTemplate' => null,
                "karacsonyTemplate" => null,
                'bemutatoTemplate' => null,
                'valentinTemplate' => null,
                'innerIntroductionTemplate' => null,
                'innerTemplate' => null,
                'innerCartTemplate' => null,
                'isAuthorized' => isLoggedIn(),
                'isSuccess' => isset($_GET['kuldesSikeres'])
        ]);
        header('Location: /user');
        exit;
    };
    if(empty($address)) {
        $loginTemplate = compileTemplate('./views/user.php', [
            "message" => "invalid",
            "id" => $userID
        ]);
        echo compileTemplate('./views/wrapper.php', [
                'loginTemplate' => $loginTemplate,
                'rattanTemplate' => null,
                'heartboxTemplate' => null,
                'szalasTemplate' => null,
                'koszoruTemplate' => null,
                "karacsonyTemplate" => null,
                'bemutatoTemplate' => null,
                'valentinTemplate' => null,
                'innerIntroductionTemplate' => null,
                'innerTemplate' => null,
                'innerCartTemplate' => null,
                'isAuthorized' => isLoggedIn(),
                'isSuccess' => isset($_GET['kuldesSikeres'])
        ]);
        header('Location: /user');
        exit;
    };
    if(strlen($zipcode) !== 4) {
        $loginTemplate = compileTemplate('./views/user.php', [
            "message" => "not4",
            "id" => $userID
        ]);
        echo compileTemplate('./views/wrapper.php', [
                'loginTemplate' => $loginTemplate,
                'rattanTemplate' => null,
                'heartboxTemplate' => null,
                'szalasTemplate' => null,
                'koszoruTemplate' => null,
                "karacsonyTemplate" => null,
                'bemutatoTemplate' => null,
                'valentinTemplate' => null,
                'innerIntroductionTemplate' => null,
                'innerTemplate' => null,
                'innerCartTemplate' => null,
                'isAuthorized' => isLoggedIn(),
                'isSuccess' => isset($_GET['kuldesSikeres'])
        ]);
        header('Location: /user');
        exit;
    };
    if(isLoggedIn()){
        
        $personalEmail = $pdo->prepare("SELECT email FROM users WHERE id = ?");
        $personalEmail->execute([$userID]);
        $email = $personalEmail->fetchAll(PDO::FETCH_ASSOC);
        $userEmail = $email[0]["email"];
        $statement = $pdo->prepare("INSERT INTO `personal` 
        (`name`, `zipcode`, `city`, `address`, `phoneNumber`, `taxNumber`, `email`, `transportID`) 
        VALUES 
        (?, ?, ?, ?, ?, ?, ?, ?);");
        $statement->execute([
        $username,
        $zipcode, 
        $city, 
        $address, 
        $phonenumber, 
        $taxnumber,
        $userEmail,
        null

        ]);
        $newrecord = $pdo->prepare("SELECT * FROM `personal` ");
        $newrecord->execute();
        $personal = $newrecord->fetchAll(PDO::FETCH_ASSOC);
        $lastId = end($personal);
        $personalID = $pdo->prepare("UPDATE `users`
        SET personalID = ?
        WHERE id = ?");
        $personalID->execute([
            $lastId["id"],
            $userID
        ]);
        header('Location: /user');
  
    } 
    header('Location: /user');
}

/* ----------------------------- "/ordersummary" ---------------------------- */

function formCheckHandler(){
    $transport = $_POST["transport"];
    $payment = $_POST["payment"];
    if($transport === "mpl"){
        $selected = [
            "content" => "MPL-es házhozszállítás:",
            "price" => 1000
        ];
        transportPaymentChecker($selected);
        if($payment === "cash") {
            $selected = [
                "content" => "Bankkártyás utalással:"
            ];
            transportPaymentChecker($selected);
        }
    } else {
        $selected = [
            "content" => "Személyes átvétel:",
            "price" => 0
        ];
        transportPaymentChecker($selected);
        if($payment === "cash") {
            $selected = [
                "content" => "Kézpénzes fizetés (csak személyes átvételnél):"
            ];
            transportPaymentChecker($selected);
        }
    }
    if($payment === "card"){
        $selected = [
            "content" => "Bankkártyás utalással:"
        ];
        transportPaymentChecker($selected);
    }
    
}












?>

