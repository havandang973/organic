<?php

namespace App\Enums;

class Status
{
    const PENDING = 'PENDING';
    const CANCELED = 'CANCELED';
    const COMPLETED = 'COMPLETED';
    const DELIVERY  = 'DELIVERY';

    const STATUS = array(
        'PENDING' => 'PENDING',
        'CANCELED' => 'CANCELED',
        'COMPLETED' => 'COMPLETED',
        'DELIVERY'  => 'DELIVERY'
    );

}

