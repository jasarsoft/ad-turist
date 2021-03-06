<?php
    #otvaranje novog output buffera
    ob_start();

    #ucitavanje autoloader funkcije koja ce pomoci prilikom ucitavanja
    #klasa prilikom njihove prve upotrebe
    require_once 'sys/Autoload.php';
    
    #zapocinje sesiju
    Session::begin();

    #preuzimanje pritiglog zahtjeva
    $uriWithBase = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_STRING);
    $uri = substr($uriWithBase, strlen(Configuration::BASE_PATH));

    #ucitavanje definisanih ruta za app
    $Routes = require_once 'Routes.php';
    $FoundRoute = null;
    $Arguments = [];
    
    #nalazenje odgovarajuce rute
    foreach ($Routes as $Route) {
        if (preg_match($Route['Pattern'], $uri, $Arguments)) {
            $FoundRoute = $Route;
            break;
        }
    }
    #preuzimanje spiska argumenata koji su dio zahtjeva (poziva)
    unset($Arguments[0]);
    $Arguments = array_values($Arguments);

    $Controller = $FoundRoute['Controller'];
    $Method = $FoundRoute['Method'];
    
    #ucitavanje kontrolera za izabranu rutu
    $fileName = 'app/controllers/' . $Controller . 'Controller.php';
    if (!file_exists($fileName)) {
        $Controller = 'Main';
        $fileName = 'app/controllers/' . $Controller . 'Controller.php';
    }

    require_once $fileName;
    #instanciranje kontrolera
    $className = $Controller . 'Controller';
    $worker = new $className;

    #izvrsavanje metoda kontrolera koji je definisan za izabranu rutu
    $Method = method_exists($worker, $Method)?$Method:'index';

    call_user_func_array([$worker, '__pre'], []);
    call_user_func_array([$worker, $Method], $Arguments);

    #preuzimanje podataka koje je pripremio kontroler za slanje sablonima za
    #gnerisanje odgovora
    $DATA = $worker->getData();

    #ako je izvrsen kontroler za API pozive, onda preuzmete podatke 
    #poslati enkodirane u JSON formatu
    if ($worker instanceof ApiController) {
        ob_clean();
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($DATA, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit;
    }

    require_once 'app/views/'.$Controller.'/'.$Method.'.php';
