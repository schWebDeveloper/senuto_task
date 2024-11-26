<?php

namespace SCHCar\enum;
enum CarStatus
{
    case CLOSED;
    case OPENED;
    case ENGINE_ON;
    case ENGINE_OFF;
    case CHARGING;
    case PLUGGED;
}