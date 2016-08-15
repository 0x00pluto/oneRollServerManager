<?php

return [

    /*
     * |--------------------------------------------------------------------------
     * | PDO Fetch Style
     * |--------------------------------------------------------------------------
     * |
     * | By default, database results will be returned as instances of the PHP
     * | stdClass object; however, you may desire to retrieve records in an
     * | array format for simplicity. Here you can tweak the fetch style.
     * |
     */

    'fetch' => PDO::FETCH_CLASS,

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => 'mongodb',

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'database' => storage_path('database.sqlite'),
            'prefix' => ''
        ],

        'mysql' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', 'localhost'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
            'strict' => false
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'host' => env('DB_HOST', 'localhost'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'schema' => 'public'
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'host' => env('DB_HOST', 'localhost'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => ''
        ],

        'mongodb' => array(
            'driver' => 'mongodb',
            'host' => env('DB_HOST','dds-2ze2462d8b06cc942.mongodb.rds.aliyuncs.com'),
            'port' => env('DB_PORT','3717'),
            'database' => env('DB_DATABASE','cookingwebadmin'),
            'username' => env('DB_USERNAME','dbnamecookingwebadmin'),
            'password' => env('DB_PASSWORD','dbnamecookingwebadmin'),
            'options' => array(
                'db' => env('DB_DATABASE','cookingwebadmin')
            )
            
        ), // sets the authentication database required by mongo 3

        'mongodb_game' => array(
            'driver' => 'mongodb',
            'host' => env('DB_GAME_HOST','dds-2ze2462d8b06cc942.mongodb.rds.aliyuncs.com'),
            'port' => env('DB_GAME_PORT','3717'),
            'database' => env('DB_GAME_DATABASE','cooking_db'),
            'username' => env('DB_GAME_USERNAME','lookup'),
            'password' => env('DB_GAME_PASSWORD','lookup'),
            'options' => array(
                'db' => env('DB_GAME_DATABASE','cooking_db')
            )

        ),
        'mongodb_log' => array(
            'driver' => 'mongodb',
            'host' => env('DB_GAME_LOG_HOST','dds-2ze2462d8b06cc942.mongodb.rds.aliyuncs.com'),
            'port' => env('DB_GAME_LOG_PORT','3717'),
            'database' => env('DB_GAME_LOG_DATABASE','logsystem'),
            'username' => env('DB_GAME_LOG_USERNAME','lookup'),
            'password' => env('DB_GAME_LOG_PASSWORD','lookup'),
            'options' => array(
                'db' => env('DB_GAME_LOG_DATABASE','logsystem')
            )
        )


    ] // sets the authentication database required by mongo 3


    ,

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer set of commands than a typical key-value systems
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'cluster' => false,

        'default' => [
            'host' => '127.0.0.1',
            'port' => 6379,
            'database' => 0
        ]
    ]
];
