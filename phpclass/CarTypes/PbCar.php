<?php

namespace SCHCar\CarTypes;

use SCHCar\Car\Car;
use SCHCar\enum\ChargeStatus;
use SCHCar\enum\FuelType;

class PbCar extends Car
{
    public function __construct(){
        parent::__construct($this->company, $this->model);
        $this->fuelType = FuelType::PB;
        $this->chargeStatus = ChargeStatus::NOT_SUPPORTED;
    }
}