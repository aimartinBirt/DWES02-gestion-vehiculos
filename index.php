<?php
declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use App\Controllers\VehicleController;

$controller = new VehicleController();
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

try {
    if ($method === 'GET' && isset($_GET['id'])) {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id || $id < 1) {
            throw new InvalidArgumentException('Introduce un ID numérico válido.');
        }
        $vehiculo = $controller->getById($id);
        require __DIR__ . '/views/vehiculo_get.php';
        exit;
    }

    if ($method === 'POST') {
        $json = $_POST['jsonPost'] ?? '';
        $datos = json_decode($json, true);
        if (json_last_error() !== JSON_ERROR_NONE || !is_array($datos)) {
            throw new InvalidArgumentException('El JSON no es válido: ' . json_last_error_msg());
        }
        $vehiculos = $controller->store($datos);
        require __DIR__ . '/views/vehiculo_post.php';
        exit;
    }

    require __DIR__ . '/index.html';
} catch (Throwable $error) {
    $mensajeError = $error->getMessage();
    require __DIR__ . '/views/error.php';
}
