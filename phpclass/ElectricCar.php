<?php

namespace SCHCar;

class ElectricCar extends Car
{

    public protected(set) int $batteryLevelPercentage;

    public function __construct($company, $model)
    {
        parent::__construct($company, $model);
        $this->fuelType = FuelType::ELECTRIC;
        $this->batteryLevelPercentage = 0;
    }

    public function plugIn(): void
    {
        $this->status = CarStatus::PLUGGED;
    }

    public function charge(int $amount): void
    {
        $this->park();
        $this->plugIn();
        $this->status = CarStatus::CHARGING;
        $this->batteryLevelPercentage += $amount;
    }

    public function fillFuel(int $percentage): void
    {
        return false;
    }


}