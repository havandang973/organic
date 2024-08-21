<?php

namespace App\Enums;

class Transaction
{
    const ONLINE = 'Thanh toán online';
    const CASH = 'Thanh toán khi nhận hàng';

    const TRANSACTION = array(
        self::ONLINE => 'Thanh toán online',
        self::CASH => 'Thanh toán khi nhận hàng',
    );
}

