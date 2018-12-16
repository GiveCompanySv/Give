<?php
    /**
    *This is the Give Web Page with the MVC's paradigm
    *this is our main page in where our clients are going to know about us
    *and they could contact us
    *
    *Give Web Page v1.0 (mvc)
    *Developed by: Mario Roberto Vanegas
    *
    *STARTED:
    *December 16th, 2018
    *Sunday - 01:45
    */

    include_once 'Config/General.php';
    session_start();

    $Url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'],'/')) : '/';

    if ($Url == "/") {
        require_once __DIR__ . '/Models/Home.Model.php';
        require_once __DIR__ . '/Views/Home.View.php';
        require_once __DIR__ . '/Controllers/Home.Controller.php';

        $HomeView = new HomeView();
        $HomeModel = new HomeModel();
        $HomeController = new HomeController($HomeModel, $HomeView);

        echo $HomeController->LoadView();
    } else {
        $RequiredController = $Url[0];
        $RequiredAction = isset($Url[1])? $Url[1] : '';
        $RequiredParams = array_slice($Url, 2);
        $ControllerRoute = __DIR__ . '/Controllers/' . ucfirst($RequiredController) . '.Controller.php';

        if (file_exists($ControllerRoute)) {
            require_once __DIR__ . '/Models/' . ucfirst($RequiredController) . '.Model.php';
            require_once __DIR__ . '/Controllers/' . ucfirst($RequiredController) . '.Controller.php';
            require_once __DIR__ . '/Views/' . ucfirst($RequiredController) . '.View.php';

            //Creamos los nombres de las clases a partir de la URL
            $ModelName = ucfirst($RequiredController) . 'Model';
            $ControllerName = ucfirst($RequiredController) . 'Controller';
            $ViewName = ucfirst($RequiredController) . 'View';

            //Creamos los objetos de las clases anteriores

            $ControllerObject = new $ControllerName(new $ModelName, new $ViewName);

            //Si existen parametros dentro del metodo llamado
            if (!empty($RequiredAction)) {
                if (!empty($RequiredParams[1])) {
                    //Entonces llamamos el método por medio de la vistas
                    //Llamada dinámica de la vistas
                    print $ControllerObject->$RequiredAction($RequiredParams[0], $RequiredParams[1]);
                } else if (!empty($RequiredParams[0])) {
                    print $ControllerObject->$RequiredAction($RequiredParams[0]);
                } else {
                    print $ControllerObject->LoadView($RequiredAction);
                }
            } else {
                //Si no, solo llamamos el objeto vista
                print $ControllerObject->LoadView();
            }
        } else {
            //Si no existe el controlador, significa que la página no existe, por tanto mostrmos error

            require_once __DIR__ . '/Models/Error.Model.php';
            require_once __DIR__ . '/Controllers/Error.Controller.php';
            require_once __DIR__ . '/Views/Error.View.php';

            $NotFoundModel = New ErrorModelo();
            $NotFoundView = New ErrorVista();
            $NotFoundController = New ErrorControlador($NotFoundModel,$NotFoundView);

            print $NotFoundController->LoadView();
        }
    }
?>
