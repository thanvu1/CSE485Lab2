<?php
// Tự động tải các tệp cần thiết
require_once 'models/Database.php';
require_once 'controllers/HomeController.php';
require_once 'controllers/AdminController.php';
// Xác định controller và action (mặc định là HomeController và index)
$controllerName = isset($_GET['controller']) ? $_GET['controller'] : 'home';
$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';

// Điều hướng đến controller tương ứng
switch ($controllerName) {
    case 'home':
        $controller = new HomeController();
        break;
    case 'admin':
        $controller = new AdminController();
        break;
    default:
        die("Controller không tồn tại!");
}

// Gọi phương thức tương ứng
if (method_exists($controller, $actionName)) {
    $controller->{$actionName}();
} else {
    die("Action không tồn tại trong controller $controllerName!");
}
?>
