<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitef65d7a09b2484c05cc8085b2ce71749
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WebSocketsZMQ\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WebSocketsZMQ\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitef65d7a09b2484c05cc8085b2ce71749::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitef65d7a09b2484c05cc8085b2ce71749::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}