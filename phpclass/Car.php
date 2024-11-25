<?php
// PHP 8.4
namespace SCHCar;

class Car
{

    public protected(set) int $engine = 0;
    public protected(set) string $color;
    public protected(set) int $year;
    public protected(set) int $currentPassengers = 0;
    public protected(set) int $fuelLevelPercentage = 0;
    public protected(set) CarStatus $status;
    public protected(set) FuelType $fuelType;
    public protected(set) GearMode $gearMode;

    public function __construct(
        public private(set) string $company,
        public private(set) string $model
    )
    {

        $this->fuelLevelPercentage = 0;
        $this->status = CarStatus::CLOSED;
        $this->year = date('Y');
        $this->color = 'white';
    }


    public string $fullName {
        get {
            $this->company . ' ' . $this->model;
        }
    }

    public function fillFuel(int $percentage): void
    {
        $this->fuelLevelPercentage += $percentage;
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
}
