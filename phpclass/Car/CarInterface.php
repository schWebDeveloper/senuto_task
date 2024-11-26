<?php

namespace SCHCar\Car;

use SCHCar\enum\FuelType;

interface CarInterface
{
    public function fillFuel(int $percentage): void;

    public function turnOn();

    public function turnOff();

    public function charge(int $amount): void;

    public function open();

    public function close();

    public function addPassengers(int $amount): void;

    public function removePassengers(int $amount): void;

    public function drive(): void;

    public function park(): void;

    public function setFuelType(FuelType $fuelType): void;

    public function plugIn();

}
