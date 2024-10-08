<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit86c0fc18f33818ce26b0f7529f4eebf5
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MF\\' => 3,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MF\\' => 
        array (
            0 => __DIR__ . '/..' . '/MF',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit86c0fc18f33818ce26b0f7529f4eebf5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit86c0fc18f33818ce26b0f7529f4eebf5::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
