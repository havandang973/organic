<?php

namespace App\Enums;

class Status
{
    const PENDING = 'PENDING';
    const COMPLETED = 'COMPLETED';
    const CANCELED = 'CANCELED';
    const DELIVERY = 'DELIVERY';
    const CONFIRMED = 'CONFIRMED';
    const PAID = 'PAID'; 

    const STATUS = array(
        self::PENDING => 'Chờ xử lý',
        self::CONFIRMED => 'Đã xác nhận',
        self::DELIVERY => 'Đang giao',
        self::PAID => 'Đã thanh toán',
        self::COMPLETED => 'Hoàn thành',
        self::CANCELED => 'Đã hủy',
    );

}

