<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\Models\TypeWagon;
use App\MoonShine\Sets\DashboardTableWithForm;
use MoonShine\Advanced\Components\Tabs\AsyncTab;
use MoonShine\Advanced\Components\Tabs\AsyncTabs;
use MoonShine\Apexcharts\Components\DonutChartMetric;
use MoonShine\Apexcharts\Components\LineChartMetric;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Http\Responses\MoonShineJsonResponse;
use MoonShine\Laravel\MoonShineRequest;
use MoonShine\Laravel\Pages\Page;
use MoonShine\UI\Components\Heading;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Components\Layout\LineBreak;
use MoonShine\UI\Components\Metrics\Wrapped\ValueMetric;

#[\MoonShine\MenuManager\Attributes\SkipMenu]
class Dashboard extends Page
{
    /**
     * @return array<string, string>
     */
    protected function assets(): array
    {
        return [
            ...DonutChartMetric::make('')->getAssets(),
        ];
    }

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

            LineBreak::make(),

            Grid::make([
                Column::make([
                    ValueMetric::make('Прибыло составов на ст.Серная')
                        ->value(TypeWagon::query()->count())
                        ->progress(12)
                        ->icon('map-pin')
                ])->columnSpan(4),

                Column::make([
                    ValueMetric::make('Отправлено составов на Аксарайская 2')
                        ->value(TypeWagon::query()->count())
                    //->progress(6)
                ])->columnSpan(4),

                Column::make([
                    ValueMetric::make('Отгружено товарной продукции')
                        ->value('24 тонн')
                        ->progress(10)
                ])->columnSpan(4),

                Column::make([
                    AsyncTabs::make([
                        AsyncTab::make('За истекшие сутки', $this->getRouter()->getEndpoints()->method('metrics')),
                        AsyncTab::make('По периоду', '/resource/type-wagons/type-wagon-index-page'),
                    ]),
                ]),
            ]),
        ];
    }

    public function tableWithForm(MoonShineRequest $request): MoonShineJsonResponse
    {
        $set = new DashboardTableWithForm();

        if ($request->has('date')) {
            return MoonShineJsonResponse::make()->html([
                '.async-table' => (string)$set->table(),
            ]);
        }

        return MoonShineJsonResponse::make()->html(
            (string)$set->form('tableWithForm'),
        );
    }

    public function metrics(): MoonShineJsonResponse
    {
        return MoonShineJsonResponse::make()->html(
            (string)Grid::make([
                Column::make([
                    Heading::make('Подготовка', 1),
                    DonutChartMetric::make('По родам вагонов')
                        ->columnSpan(6)
                        ->values(['ЖС-ЦС' => 48, 'НП-ЦС' => 98, 'ЛЮК-ПВ' => 114, 'ГЛ-ПВ' => 74])
                        ->colors(['#ffcc00', '#00bb00', '#cd36ac', '#0079c2']),
                ])->columnSpan(5, 12),
                Column::make([
                    LineChartMetric::make('Динамика поступления вагонов')
                        ->line([
                            'Цистерны' => [
                                now()->format('d-m-Y') => 96,
                                now()->addDay()->format('d-m-Y') => 54,
                                now()->addDays(2)->format('d-m-Y') => 68,
                                now()->addDays(3)->format('d-m-Y') => 142,
                            ],
                        ], '#0079C2', 'column')
                        ->line([
                            'Полувагоны' => [
                                now()->format('d-m-Y') => 147,
                                now()->addDay()->format('d-m-Y') => 132,
                                now()->addDays(2)->format('d-m-Y') => 72,
                                now()->addDays(3)->format('d-m-Y') => 101
                            ],
                        ], '#EC4176', 'column')
                        ->line([
                            'Жидкая сера' => [
                                now()->format('d-m-Y') => 35,
                                now()->addDay()->format('d-m-Y') => 45,
                                now()->addDays(2)->format('d-m-Y') => 61,
                                now()->addDays(3)->format('d-m-Y') => 53,
                            ],
                        ], '#7D00fc', 'column'),
                ])->columnSpan(7, 12),
            ]),
        );
    }
}
