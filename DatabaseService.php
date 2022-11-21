<?php

namespace Larso\Database;

use Illuminate\Database\Capsule\Manager;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

class DatabaseService
{
    /**
     * Boot Service Database
     *
     * @param array $config
     * @return void
     */
    public static function boot(array $config)
    {
        if (! is_array($config)) {
            throw new \InvalidArgumentException(
                "Please passing array infomation connect to DB"
            );
        }

        $configKeyRequire = [
            'database',
            'username',
            'password',
        ];
        foreach ($configKeyRequire as $req) {
            if (! isset($config[$req])) {
                throw new \InvalidArgumentException(
                    sprintf(
                        "key '%s' of config is require",
                        $req
                    )
                );
            }
        }

        $configDefault = [
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ];
        foreach ($configDefault as $key => $value) {
            // Set default value if missing it
            if (! isset($config[$key])) {
                $config[$key] = $value;
            }
        }

		$capsule = new Manager();
        $capsule->addConnection($config);
        $capsule->setEventDispatcher(new Dispatcher(new Container()));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}
