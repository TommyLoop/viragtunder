<?php

$method = $_SERVER["REQUEST_METHOD"];
$parsed = parse_url($_SERVER["REQUEST_URI"]);
$path = $parsed['path'];

$routes = [
    "GET" => [
        "/" => "homeHandler",
        "/kublik" => "kubliHandler",
        "/kublik2" => "kubli2Handler",
        "/rattan" => "rattanHandler",
        "/rattan2" => "rattan2Handler",
        "/heartbox" => "heartboxHandler",
        "/szalas" => "szalasHandler",
        "/koszoru" => "koszoruHandler",
        "/angel" =>"angelHandler",
        "/mikulas" => "mikulasHandler",
        "/kaspo1" => "kaspo1Handler",
        "/kaspo2" => "kaspo2Handler",
        "/cart" => "cartHandler",
        "/regisztracio" => "regisztracioHandler",
        "/bejelentkezes" => "bejelentkezesHandler",
        "/delete-product" => "orderDeleteHandler"
    ],
    "POST" => [
        "/edited" => "editedHandler",
        "/cart" => "cartSendHandler",
        '/register' => 'registrationHandler',
        '/login' => 'login2Handler',
        '/logout' => 'logoutHandler'
        
    ]
];
$handlerFunction = $routes[$method][$path] ?? "notFoundHandler";

$safeHandlerFunction = function_exists($handlerFunction) ? $handlerFunction : "notFoundHandler";
$safeHandlerFunction();

/* ----------------------------- Segéd function ----------------------------- */


function compileTemplate($filePath, $params = []): string
{
    ob_start();
    require($filePath);
    return ob_get_clean();
}

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
function logoutHandler()
{
    session_start();
    $params = session_get_cookie_params(); 
    setcookie(session_name(),  '', 0, $params['path'], $params['domain'], $params['secure'], isset($params['httponly']));
    session_destroy(); 
    header('Location: /bejelentkezes'); 
}

function login2Handler()
{
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
    header('Location: /bejelentkezes');
    
}
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
            'isAuthorized' => isLoggedIn()
    ]);
}
function bejelentkezesHandler()
{
    if(isLoggedIn()) {
        $loginTemplate = compileTemplate('./views/loggedin.php', [
        
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
            'isAuthorized' => isLoggedIn()
            
        ]);
        return;
        
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
            'isAuthorized' => false
    ]);
    
    
    

}

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
        "INSERT INTO `users` (`email`, `password`, `createdAt`) 
        VALUES (?, ?, ?);" 
    );
    $statment2->execute([
        $_POST["email"],
        password_hash($_POST["password"], PASSWORD_DEFAULT),
        time()
    ]);
    $regisztracioTemplate = compileTemplate('./views/register.php', [
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
        'isAuthorized' => isLoggedIn()
    ]);

    header('Location: /regisztracio'); 
}

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
        'loginTemplate' => null

    ]);
}
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

    ]);
}
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
        'innerCartTemplate' => null

    ]);
}
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
        'innerCartTemplate' => null

    ]);
}
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
        'innerCartTemplate' => null

    ]);
}
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
        'innerCartTemplate' => null

    ]);
    
}

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
        'innerCartTemplate' => null

    ]);
}
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
        'innerCartTemplate' => null

    ]);
}

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
        'innerCartTemplate' => null

    ]);
}
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
        'innerCartTemplate' => null

    ]);
    
}
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
        'innerCartTemplate' => null

    ]);
}
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
        'isAuthorized' => isLoggedIn()

    ]);


};


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
        'isAuthorized' => false
    ]);
};

function notFoundHandler() {
   echo "Oldal nem található";
};

?>

