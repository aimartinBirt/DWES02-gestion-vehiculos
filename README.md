# DWES02 - Gestión de vehículos

Proyecto PHP con arquitectura MVC, namespaces, Composer y autoload PSR-4.

## Requisitos
- PHP 8.0 o superior
- Composer

## Instalación
1. Abre una terminal dentro de esta carpeta.
2. Ejecuta `composer install` (o `composer dump-autoload`). Esto genera `vendor/autoload.php`.
3. Ejecuta `php -S localhost:8000`.
4. Abre `http://localhost:8000/index.html`.

## Pruebas
- GET: busca IDs existentes del 1 al 10 y uno inexistente como 99.
- POST: pega una sola línea de `vehiculos_prueba.txt` en el cuadro JSON y pulsa Guardar.
- Cada envío POST es temporal: el fichero de datos original no se modifica, tal como indica el enunciado.

## Estructura
- `index.html`: formulario inicial.
- `index.php`: front-controller; distingue GET y POST.
- `src/Models`: clases Vehiculo, Coche y Moto.
- `src/Controllers`: VehicleController.
- `data/vehiculos_bbdd.php`: datos iniciales.
- `views`: resultados GET, POST y errores.
- `public`: estilos CSS.
