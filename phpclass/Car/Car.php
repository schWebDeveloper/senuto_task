<?php
// PHP 8.4
namespace SCHCar\Car;

use SCHCar\enum\CarStatus;
use SCHCar\enum\ChargeStatus;
use SCHCar\enum\FuelType;
use SCHCar\enum\GearMode;

class Car implements CarInterface
{
    public protected(set) string $color;
    public protected(set) int $year;
    public protected(set) int $currentPassengers = 0;
    public protected(set) int $fuelLevelPercentage = 0;
    public protected(set) CarStatus $status;
    public protected(set) ChargeStatus $chargeStatus;
    public protected(set) int $batteryLevelPercentage = 0;
    public protected(set) FuelType $fuelType;
    public protected(set) GearMode $gearMode;

    public function __construct(
        public private(set) string $company,
        public private(set) string $model
    ){}

    public function __invoke(): void
    {
        $this->batteryLevelPercentage = 0;
        $this->fuelLevelPercentage = 0;
        $this->year = date('Y');
        $this->color = 'white';
        $this->setGearMode(GearMode::P);
        $this->status = CarStatus::CLOSED;
        $this->chargeStatus = ChargeStatus::NOT_SUPPORTED;
    }


    public string $fullName {
        get {
            $this->company . ' ' . $this->model;
        }
    }

    public function turnOn(): void
    {
        $this->status = CarStatus::ENGINE_ON;
    }

    public function setGearMode(GearMode $gearMode): void
    {
        $this->gearMode = $gearMode;
    }

    public function turnOff(): void
    {
        $this->gearMode = GearMode::P;
        $this->status = CarStatus::ENGINE_OFF;
    }

    public function setFuelType(FuelType $fuelType): void
    {
        $this->fuelType = $fuelType;
    }

    public function open(): void
    {
        $this->status = CarStatus::OPENED;
    }

    public function close(): void
    {
        $this->status = CarStatus::CLOSED;
    }

    public function addPassengers(int $amount): void
    {
        $this->currentPassengers += $amount;
    }

    public function removePassengers(int $amount): void
    {
        $this->currentPassengers -= $amount;
    }

    public function drive(): void
    {
        $this->open();
        $this->addPassengers(1);
        $this->turnOn();
        $this->setGearMode(GearMode::D);
    }

    public function park(): void
    {
        $this->turnOff();
        $this->removePassengers($this->currentPassengers);
        $this->close();;
    }

    public function fillFuel(int $percentage): void
    {
        if(!in_array($this->fuelType, [FuelType::DIESEL, FuelType::PB, FuelType::PLUG_IN])){
            throw new \Exception('Fill fuel action not supported');
        }

        $this->fuelLevelPercentage += $percentage;
    }

    public function charge(int $amount): void
    {
        if($this->chargeStatus === ChargeStatus::NOT_SUPPORTED) {
            throw new \Exception('Charging not supported');
        }

        $this->park();
        $this->plugIn();
        $this->status = CarStatus::CHARGING;
        sleep($amount);
        $this->batteryLevelPercentage += $amount;
        $this->chargeStatus = ChargeStatus::CHARGED;
    }

    public function plugOut(): void
    {
        if($this->chargeStatus === ChargeStatus::CHARGED) {
            $this->chargeStatus = ChargeStatus::NOT_PLUGGED;
        }
    }


    public function plugIn(): void
    {
        if($this->chargeStatus === ChargeStatus::NOT_SUPPORTED) {
            throw new \Exception('Charging not supported');
        }

        $this->status = CarStatus::PLUGGED;
    }
}
