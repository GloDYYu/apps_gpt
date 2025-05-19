<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use MoonShine\Laravel\Layouts\CompactLayout;
use MoonShine\ColorManager\ColorManager;
use MoonShine\AssetManager\InlineCss;
use MoonShine\Contracts\ColorManager\ColorManagerContract;
use MoonShine\Laravel\Components\Layout\{Locales, Notifications, Profile, Search};
use MoonShine\UI\Components\{Breadcrumbs,
    Components,
    Layout\Flash,
    Layout\Div,
    Layout\Body,
    Layout\Burger,
    Layout\Content,
    Layout\Footer,
    Layout\Head,
    Layout\Favicon,
    Layout\Assets,
    Layout\Meta,
    Layout\Header,
    Layout\Html,
    Layout\Layout,
    Layout\Logo,
    Layout\Menu,
    Layout\Sidebar,
    Layout\ThemeSwitcher,
    Layout\TopBar,
    Layout\Wrapper,
    When
};
use App\MoonShine\Resources\TypeWagonResource;
use MoonShine\MenuManager\{MenuItem, MenuDivider, MenuGroup};

final class MoonShineLayout extends CompactLayout
{
    protected function assets(): array
    {
        return [
            ...parent::assets(),

            InlineCss::make(
                <<<'Style'
            :root {
              --radius: 0.15rem;
              --radius-sm: 0.075rem;
              --radius-md: 0.275rem;
              --radius-lg: 0.3rem;
              --radius-xl: 0.4rem;
              --radius-2xl: 0.5rem;
              --radius-3xl: 1rem;
              --radius-full: 9999px;
            }
        Style
            ),
        ];
    }

    protected function menu(): array
    {
        return [

            MenuGroup::make('Справочники', [
                MenuItem::make('Типы вагонов', TypeWagonResource::class, 'squares-2x2'),
                MenuItem::make('Неисправности', 'test1', 'squares-2x2'),
                MenuItem::make('Модели вагонов', 'test2', 'squares-2x2')
            ], 's.arrow-top-right-on-square'),
            //MenuDivider::make(),
            MenuDivider::make('Новый раздел меню'),

            ...parent::menu(),
        ];
    }

    /**
     * @param ColorManager $colorManager
     */
    protected function colors(ColorManagerContract $colorManager): void
    {
        parent::colors($colorManager);

        $colorManager
            ->primary('#0079c2')
            ->secondary('#1D8A99');
    }

    protected function getFooterMenu(): array
    {
        return [
            'https://trans.gazprom.ru' => 'ООО "Газпромтранс"',
        ];
    }

    protected function getFooterCopyright(): string
    {
        return '&copy; 2024-2025 🛠 Разработка ⭐
                <a href="https://glodyyu.ru"
                class="font-semibold text-primary hover:text-secondary"
                target="_blank"
                >Юрий Деревенкин</a> ⭐';
    }

    public function build(): Layout
    {
        return parent::build();
    }
}
