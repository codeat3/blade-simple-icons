<?php

declare(strict_types=1);

namespace Codeat3\BladeSimpleIcons;

use BladeUI\Icons\Factory;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

final class BladeSimpleIconsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerConfig();

        $this->callAfterResolving(Factory::class, function (Factory $factory, Container $container) {
            $config = $container->make('config')->get('blade-simple-icons', []);

            $factory->add('simple-icons', array_merge(['path' => __DIR__ . '/../resources/svg'], $config));
        });
    }

    private function registerConfig(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/blade-simple-icons.php', 'blade-simple-icons');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/svg' => public_path('vendor/blade-simple-icons'),
            ], 'blade-si'); // TODO: updating this alias to `blade-simple-icons` in next major release

            $this->publishes([
                __DIR__ . '/../config/blade-simple-icons.php' => $this->app->configPath('blade-simple-icons.php'),
            ], 'blade-simple-icons-config');
        }
    }
}
