<?php
use App\Models\Coche;
use App\Models\Moto;
function e($valor): string { return htmlspecialchars((string)$valor, ENT_QUOTES, 'UTF-8'); }
?>
<!doctype html><html lang="es"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Resultado de búsqueda</title><link rel="stylesheet" href="public/styles.css"></head><body><main class="contenedor"><section class="panel">
<h1>Resultado de la búsqueda</h1>
<?php if ($vehiculo === null): ?>
  <p class="aviso">No se ha encontrado ningún vehículo con ese ID.</p>
<?php else: ?>
  <p><strong>ID:</strong> <?= e($vehiculo->getId()) ?></p>
  <p><strong>Tipo:</strong> <?= e(ucfirst($vehiculo->getTipo())) ?></p>
  <p><strong>Marca:</strong> <?= e($vehiculo->getMarca()) ?></p>
  <p><strong>Modelo:</strong> <?= e($vehiculo->getModelo()) ?></p>
  <p><strong>Año:</strong> <?= e($vehiculo->getAnio()) ?></p>
  <?php if ($vehiculo instanceof Coche): ?><p><strong>Puertas:</strong> <?= e($vehiculo->getPuertas()) ?></p><?php elseif ($vehiculo instanceof Moto): ?><p><strong>Sidecar:</strong> <?= $vehiculo->tieneSidecar() ? 'Sí' : 'No' ?></p><?php endif; ?>
<?php endif; ?>
<a class="enlace" href="index.html">Volver al inicio</a>
</section></main></body></html>
