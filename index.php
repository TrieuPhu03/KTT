<?php
// Bật hiển thị lỗi để debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Bắt đầu session nếu cần dùng
session_start();

// Định nghĩa BASE_URL để sử dụng trong các đường dẫn
define('BASE_URL', 'http://localhost/KT/KiemTra');

// Lấy URL từ request và loại bỏ dấu /
$url = isset($_GET['url']) ? trim($_GET['url'], '/') : '';

// Tách URL thành các phần (controller, action, params)
$urlParts = explode('/', $url);
$controllerName = !empty($urlParts[0]) ? ucfirst($urlParts[0]) . 'Controller' : 'StudentController';
$actionName = !empty($urlParts[1]) ? $urlParts[1] : 'index';
$params = array_slice($urlParts, 2);

// Load file controller tương ứng
$controllerFile = 'app/controllers/' . $controllerName . '.php';
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controller = new $controllerName();

    if (method_exists($controller, $actionName)) {
        call_user_func_array([$controller, $actionName], $params);
    } else {
        echo "⚠️ Lỗi: Phương thức '$actionName' không tồn tại trong $controllerName.";
    }
} else {
    echo "❌ Lỗi 404: Không tìm thấy controller '$controllerName'.";
}
