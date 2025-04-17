<?php

    function statusArray(){
        return [
            '' => 'Select Status',
            'active' => 'Active',
            'inactive' => 'In Active'
        ];
    }

    function statusValue($key){
        $array = statusArray();
        return $array[$key];
    }

    function imagesMime(){
        return explode(',', str_replace('.', '', env('IMAGE_MIME')));
    }

    function imagesMimeText(){
        return implode(',', imagesMime());
    }

    function getUserStores(){
        $user = auth()->user();
        return $user->stores;
    }

    function priceDecimal($price){
        return '₹ ' . number_format($price, 2);
    }