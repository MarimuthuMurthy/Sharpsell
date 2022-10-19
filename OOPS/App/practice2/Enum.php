<?php

// namespace App\practice2;
class Enum{

        public const PAID = 'paid';
        public const PENDING = 'pending';
        public const DECLINED = 'declined';
    
        public const ALL_STATUS=[
            self::PAID => 'Paid',
            self::PENDING=>'pending',
            self::DECLINED => 'declined',
        ];
}




?>