<?php
declare(strict_types=1);

namespace App\Models;

class Coche extends Vehiculo
{
    public function __construct(int $id, string $marca, string $modelo, int $anio, private int $puertas)
    {
        parent::__construct($id, $marca, $modelo, $anio, 'coche');
    }

    public function getPuertas(): int { return $this->puertas; }
}
