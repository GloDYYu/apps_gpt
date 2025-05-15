<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MoonShine\Contracts\Core\DependencyInjection\ConfiguratorContract;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use MoonShine\Laravel\DependencyInjection\MoonShine;
use MoonShine\Laravel\DependencyInjection\MoonShineConfigurator;
use App\MoonShine\Resources\MoonShineUserResource;
use App\MoonShine\Resources\MoonShineUserRoleResource;
use App\MoonShine\Resources\TypeWagonResource;

class MoonShineServiceProvider extends ServiceProvider
{
    /**
     * @param  MoonShine  $core
     * @param  MoonShineConfigurator  $config
     *
     */
    public function boot(CoreContract $core, ConfiguratorContract $config): void
    {
        // $config->authEnable();
        $config
            ->title('Газпромтранс')
            ->logo('vendor/moonshine/logo_gpt.svg')
            ->logo('vendor/moonshine/logo_gpt.svg', true)
            ->useMigrations()
            ->useNotifications()
            ->useDatabaseNotifications()
            ->useProfile()
            ->dir('app/MoonShine', 'App\MoonShine')
            ->prefixes('admin', 'page', 'resource')
            ->homeRoute('moonshine.index')
            ->locale('ru');

        $core
            ->resources([
                MoonShineUserResource::class,
                MoonShineUserRoleResource::class,
                TypeWagonResource::class,
            ])
            ->pages([
                ...$config->getPages(),
            ])
        ;
    }
}
