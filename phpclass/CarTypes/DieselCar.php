<?php

namespace SCHCar\CarTypes;

use SCHCar\Car\Car;
use SCHCar\enum\ChargeStatus;
use SCHCar\enum\FuelType;

class DieselCar extends Car
{
    public function __construct(){
        parent::__construct($this->company, $this->model);
        $this->fuelType = FuelType::DIESEL;
        $this->chargeStatus = ChargeStatus::NOT_SUPPORTED;
    }

    public function prepareForDrive(): void
    {
        $this->fillFuel(100);
    }
}