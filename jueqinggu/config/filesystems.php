<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "s3", "rackspace"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_KEY'),
            'secret' => env('AWS_SECRET'),
            'region' => env('AWS_REGION'),
            'bucket' => env('AWS_BUCKET'),
        ],
//
//        'qiniu' => [       // 公共空间
//            'driver' => 'qiniu',
//            'domain' => 'http://owibc8tdj.bkt.clouddn.com',          //你的七牛域名，支持 http 和 https，也可以不带协议，默认 http
//            'access_key' => 'UhYWJIgbXnIzPHiZdVCenSnWVksXLlOY4WBAYc91',                          //AccessKey
//            'secret_key' => 'kVIfTnGjvMU6U9f7l5n_0cTzG4rlGh_v-MXdcKlf',                           //SecretKey
//            'bucket'     => 'php25',                                  //Bucket名字
//        ],
//
//        'qiniu_private' => [ // 私有空间
//            'driver' => 'qiniu',
//            'domain' => 'https://www.example.com',          //你的七牛域名，支持 http 和 https，也可以不带协议，默认 http
//            'access_key'    => '',                          //AccessKey
//            'secret_key' => '',                             //SecretKey
//            'bucket' => 'qiniu_private',                    //Bucket名字
//        ],

        'qiniu' => [
            'driver' => 'qiniu',
            'domain' => 'http://owj54qwym.bkt.clouddn.com',          //你的七牛域名，支持 http 和 https，也可以不带协议，默认 http
            'access_key'    => 'L6l2vQPx--81RNkCflDZFybvYUHgDbgvOI_n0N73',                          //AccessKey
            'secret_key' => 'XDiO9pvjrmm6qp-yklch_IN1-mq3OilBlcNpjLG8',                             //SecretKey
            'bucket' => 'jueqinggu',                                 //Bucket名字
        ],

        'qiniu_private' => [
            'driver' => 'qiniu',
            'domain' => 'https://www.example.com',          //你的七牛域名，支持 http 和 https，也可以不带协议，默认 http
            'access_key'    => '',                          //AccessKey
            'secret_key' => '',                             //SecretKey
            'bucket' => 'qiniu_private',                    //Bucket名字
        ],

    ],

];
