<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcb98276c4d3f8c3264a63e5ebdb99b4e
{
    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'Packer' => 
            array (
                0 => __DIR__ . '/..' . '/mauris/packer/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInitcb98276c4d3f8c3264a63e5ebdb99b4e::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
