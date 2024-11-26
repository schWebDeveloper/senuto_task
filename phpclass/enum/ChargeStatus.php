<?php

namespace SCHCar\enum;
enum ChargeStatus: int
{
    case NOT_SUPPORTED = 0;
    case PLUGGED = 1;
    case CHARGING = 2;
    case CHARGED = 3;
    case NOT_CHARGING = 4;
    case NOT_PLUGGED = 5;
}