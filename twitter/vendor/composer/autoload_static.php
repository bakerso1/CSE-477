<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcb9eaefe74c7f5a34e260d312f84db90
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Twitter\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Twitter\\' => 
        array (
            0 => __DIR__ . '/../..' . '/lib/Twitter',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcb9eaefe74c7f5a34e260d312f84db90::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcb9eaefe74c7f5a34e260d312f84db90::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}