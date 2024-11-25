<?php

namespace SCHCar;

class PHEVCar extends ElectricCar
{

    public function __construct()
    {
        parent::__construct();
        $this->fuelType = FuelType::PLUG_IN;

    }

    public function fillFuel(): void
    {

    }

}