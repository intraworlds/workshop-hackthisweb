<?php
require_once('../include/constants.php');

if(ENABLE_HIDE_ERROR){
    ini_set('display_errors', 0);
}

if(!ENABLE_XSS){
    header("X-Frame-Options: Deny");
    header("X-XSS-Protection: 1; mode=block");
    header("Content-Security-Policy: form-action 'self'; script-src 'self'; style-src 'self'; img-src 'self'");
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header("Access-Control-Allow-Methods: GET, POST");   
}

if(ENABLE_SECURE_SESSION){
    session_set_cookie_params(0, '/', $_SERVER['SERVER_NAME'], true, true);
}
session_start();

require_once('../include/model.php');

// logout user
if (strcmp($_GET['path'], 'logout') == 0  && (!ENABLE_SECURE_LOGOUT || strcmp( $_GET['secTok'], $_SESSION['csrf']) == 0)) {
    unset($_SESSION['user']);
    header('Location:/');
    exit;
}

// init DB model
$model = new Model();

if (isset($_SESSION['user'])) {
    $currentUserBalance = $model->getUserBalance($_SESSION['user']['id']);
}

// form handlers
if (ENABLE_REQUEST ? isset($_REQUEST['submit']) : isset($_POST['submit'])) {
    // login
    if (strcmp(ENABLE_REQUEST ? $_REQUEST['submit'] : $_POST['submit'], 'login') == 0) {
        $user = $model->getUserByEmail($_POST['email']);
        // user is successfully verified
        if ($user && password_verify($_POST['password'], $user['password'])) {
            $loginError = false;
            $_SESSION['user'] = $user;
            $currentUserBalance = $model->getUserBalance($_SESSION['user']['id']);

            if(ENABLE_SECURE_SESSION) {
                session_regenerate_id(true);
            }
        }
        // credentials are not valid
        else {
            $loginError = true;
            unset($_SESSION['user']);
        }
    }
    // add transaction
    elseif (isset($_SESSION['user']) && strcmp(ENABLE_REQUEST ? $_REQUEST['submit'] : $_POST['submit'], 'create') == 0) {
        if ($currentUserBalance >= intval($_POST['amount'])) {
            if (ENABLE_CSRF && strcmp($_POST['csrf'], $_SESSION['csrf']) !== 0) {
                $isError = true;
                $errorMessage = 'CSRF token is not valid! Please reload page and try again...';
            }
            else {
                $result = $model->addTransaction(
                    $_SESSION['user']['id'],
                    ENABLE_REQUEST ? $_REQUEST['receiver'] : $_POST['receiver'],
                    ENABLE_REQUEST ? $_REQUEST['amount'] : $_POST['amount'],
                    ENABLE_REQUEST ? $_REQUEST['desc'] :$_POST['desc']
                );

                header('Location: /?path=list');
                exit;
            }
        }
        else {
            $isError = true;
            $errorMessage = 'You don\'t have enough coins. Your current balance is ' . $currentUserBalance . ' IWC';
        }
    }
    // registration
    elseif (strcmp(ENABLE_REQUEST ? $_REQUEST['submit'] : $_POST['submit'], 'register') == 0) {
        require_once ('../include/register.php');
    }

}



// generate new CSRF token
$_SESSION['csrf'] = md5(random_bytes(32));

?>

<html>
    <head>
        <title>IW Coin</title>
        <meta charset='utf-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="shortcut icon" type="image/x-icon" href="favicon.png" />
        <script src='js/jquery-3.2.1.min.js'></script>
    </head>
    <body>
        <div class="container">
            <?php if (isset($_SESSION['user'])): ?>
                <div class="float-right">
                    <?= ENABLE_XSS ? $_SESSION['user']['name'] : htmlentities($_SESSION['user']['name']) ?>,
                    current balance: <?= $currentUserBalance ?> IWC
                </div>
            <?php endif; ?>

            <?php
                $path = $_GET['path'] ?? 'list';

                if (!isset($_SESSION['user']) && !isset($_GET['register'])) {
                    require_once('../include/login.php');
                } elseif (!isset($_SESSION['user']) && isset($_GET['register']) && $_GET['register']==1) {
                    require_once('../include/registerForm.php');
                } elseif (ENABLE_PATH_TRAVERSAL || (in_array($path, ['list', 'create'], true) && file_exists('../include/' . $path . '.php'))) {
                    require_once('../include/' . $path . '.php');
                } else {
                    echo "NOT FOUND";
                }
            ?>
        </div>
    </body>
</html>
