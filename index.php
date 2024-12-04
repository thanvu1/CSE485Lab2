<?php
require_once 'controllers/HomeController.php';
require_once 'controllers/AdminController.php';

$controller = $_GET['controller'] ?? 'home';
$action = $_GET['action'] ?? 'index';

switch ($controller) {
    case 'home':
        $homeController = new HomeController();
        $homeController->$action();
        break;
    case 'admin':
        $adminController = new AdminController();
        $adminController->$action();
        break;
    default:
        echo "404 Not Found";
}
?>
