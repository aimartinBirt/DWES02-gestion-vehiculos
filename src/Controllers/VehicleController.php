<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Coche;
use App\Models\Moto;
use App\Models\Vehiculo;
use InvalidArgumentException;

class VehicleController
{
    private string $rutaDatos;

    public function __construct(?string $rutaDatos = null)
    {
        $this->rutaDatos = $rutaDatos ?? dirname(__DIR__, 2) . '/data/vehiculos_bbdd.php';
    }

    /** Devuelve todos los registros del fichero como objetos Coche o Moto. */
    private function leerVehiculos(): array
    {
        if (!is_file($this->rutaDatos)) {
            throw new InvalidArgumentException('No se encuentra el fichero de vehículos.');
        }

        $registros = require $this->rutaDatos;
        $vehiculos = [];

        foreach ($registros as $datos) {
            $vehiculos[] = $this->crearVehiculo($datos);
        }
        return $vehiculos;
    }

    private function crearVehiculo(array $datos): Vehiculo
    {
        $tipo = strtolower(trim((string)($datos['tipo'] ?? '')));
        $id = (int)($datos['id'] ?? 0);
        $marca = trim((string)($datos['marca'] ?? ''));
        $modelo = trim((string)($datos['modelo'] ?? ''));
        $anio = (int)($datos['anio'] ?? 0);

        if ($id < 1 || $marca === '' || $modelo === '' || $anio < 1886) {
            throw new InvalidArgumentException('Faltan datos obligatorios o no son válidos (id, marca, modelo, año).');
        }

        if ($tipo === 'coche') {
            if (!isset($datos['puertas']) || (int)$datos['puertas'] < 1) {
                throw new InvalidArgumentException('Un coche debe tener al menos una puerta.');
            }
            return new Coche($id, $marca, $modelo, $anio, (int)$datos['puertas']);
        }

        if ($tipo === 'moto') {
            $sidecar = filter_var($datos['sidecar'] ?? false, FILTER_VALIDATE_BOOLEAN);
            return new Moto($id, $marca, $modelo, $anio, $sidecar);
        }

        throw new InvalidArgumentException('El tipo debe ser "coche" o "moto".');
    }

    public function getById($id): ?Vehiculo
    {
        foreach ($this->leerVehiculos() as $vehiculo) {
            if ($vehiculo->getId() === (int)$id) {
                return $vehiculo;
            }
        }
        return null;
    }

    /** Añade el vehículo solo durante esta petición; no modifica el fichero original. */
    public function store($vehiculoData): array
    {
        if (!is_array($vehiculoData)) {
            throw new InvalidArgumentException('Los datos recibidos no tienen el formato esperado.');
        }
        $vehiculos = $this->leerVehiculos();
        $nuevoVehiculo = $this->crearVehiculo($vehiculoData);

        foreach ($vehiculos as $vehiculo) {
            if ($vehiculo->getId() === $nuevoVehiculo->getId()) {
                throw new InvalidArgumentException('Ya existe un vehículo con ese ID.');
            }
        }
        $vehiculos[] = $nuevoVehiculo;
        return $vehiculos;
    }
}
