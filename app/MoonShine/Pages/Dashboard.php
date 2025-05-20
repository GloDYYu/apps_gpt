<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Pages\Page;
use MoonShine\UI\Components\Heading;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Components\Layout\LineBreak;

#[\MoonShine\MenuManager\Attributes\SkipMenu]
class Dashboard extends Page
{
    /**
     * @return array<string, string>
     */
    public function getBreadcrumbs(): array
    {
        return [
            '#' => $this->getTitle()
        ];
    }

    public function getTitle(): string
    {
        return $this->title ?: 'Инфопанель';
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        return [
            Heading::make('Добро пожаловать в бэк-офис приложение!', 1),

            Heading::make('Версия: 0.1', 1),

            LineBreak::make(),

            Grid::make([
                Column::make([

                ])->columnSpan(6),

                Column::make([

                ])->columnSpan(6),

                Column::make([

                ])->columnSpan(12),
            ]),
        ];
    }
}
