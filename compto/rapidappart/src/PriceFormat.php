<?php
    class PriceFormat{

        public static function price(float $name, string $sigle = "F CFA"): string
        {
            return number_format($name, '2', '.',' '). ' ' .$sigle;
        }

    }