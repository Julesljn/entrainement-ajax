<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit540b4de7fbf2aa4dab4f5254cd3bb612
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Trombistock\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Trombistock\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit540b4de7fbf2aa4dab4f5254cd3bb612::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit540b4de7fbf2aa4dab4f5254cd3bb612::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit540b4de7fbf2aa4dab4f5254cd3bb612::$classMap;

        }, null, ClassLoader::class);
    }
}
