<?php
use App\Models\Coche;
use App\Models\Moto;
function e($valor): string { return htmlspecialchars((string)$valor, ENT_QUOTES, 'UTF-8'); }
?>
<!doctype html><html lang="es"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Vehículos registrados</title><link rel="stylesheet" href="public/styles.css"></head><body><main class="contenedor"><section class="panel">
<h1>Vehículo añadido correctamente</h1>
<p>Listado de vehículos durante esta petición (el alta es temporal).</p>
<div class="tabla-wrap"><table><thead><tr><th>ID</th><th>Tipo</th><th>Marca</th><th>Modelo</th><th>Año</th><th>Característica</th></tr></thead><tbody>
<?php foreach ($vehiculos as $v): ?><tr><td><?= e($v->getId()) ?></td><td><?= e(ucfirst($v->getTipo())) ?></td><td><?= e($v->getMarca()) ?></td><td><?= e($v->getModelo()) ?></td><td><?= e($v->getAnio()) ?></td><td><?php if ($v instanceof Coche): ?><?= e($v->getPuertas()) ?> puertas<?php elseif ($v instanceof Moto): ?>Sidecar: <?= $v->tieneSidecar() ? 'Sí' : 'No' ?><?php endif; ?></td></tr><?php endforeach; ?>
</tbody></table></div><a class="enlace" href="index.html">Volver al inicio</a>
</section></main></body></html>
