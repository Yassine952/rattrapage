<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit53a2ca1330441eff3489e6aec5ab8542
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit53a2ca1330441eff3489e6aec5ab8542::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit53a2ca1330441eff3489e6aec5ab8542::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit53a2ca1330441eff3489e6aec5ab8542::$classMap;

        }, null, ClassLoader::class);
    }
}
