<?php
declare(strict_types=1);

namespace App\Models;

class Moto extends Vehiculo
{
    public function __construct(int $id, string $marca, string $modelo, int $anio, private bool $sidecar)
    {
        parent::__construct($id, $marca, $modelo, $anio, 'moto');
    }

    public function tieneSidecar(): bool { return $this->sidecar; }
}
