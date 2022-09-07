<?php

    return [

        // bisa begini
        // "author" => [
        //     'first' => 'Ali',
        //     'last' => 'Mutezar'
        // ],


        // atau bisa begini, artinya cari dan ambil value di environment dari key NAME_FIRST. Kalo ngga ada maka ambil default value 'ali'
        'author' => [
            'first' => env('NAME_FIRST', 'ali'),
            'last' => env('LAST_NAME', 'Mutezar')
        ],

        'email' => 'aamutezar@gmail.com',
        'web' => 'http://www.alimutezar.com'
    ];