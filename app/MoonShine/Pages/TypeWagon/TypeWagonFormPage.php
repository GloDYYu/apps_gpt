<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\TypeWagon;

use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Models\MoonshineUserRole;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Support\DTOs\FileItemExtra;
use MoonShine\Support\Enums\Color;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use Throwable;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\Layout\Grid;


/**
 * @extends FormPage<ModelResource>
 */
class TypeWagonFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            ID::make()->sortable(),
            Grid::make([
                Column::make(
                    [
                        Text::make('Сокр.название', 'short_name')->required(),
                    ],
                    colSpan: 4,
                    adaptiveColSpan: 6
                ),
                Column::make(
                    [
                        Text::make('Полное название', 'full_name'),
                    ],
                    colSpan: 8,
                    adaptiveColSpan: 6
                ),
            ]),
            Image::make('Изображение', 'image')
                ->dir('img')
                ->hint('Допускается только загрузка файлов с расширением: jpg, png, jpeg, gif')
//                ->multiple()
                ->removable()
                ->allowedExtensions(['jpg', 'png', 'jpeg', 'gif']),
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function topLayer(): array
    {
        return [
            ...parent::topLayer()
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function mainLayer(): array
    {
        return [
            ...parent::mainLayer()
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function bottomLayer(): array
    {
        return [
            ...parent::bottomLayer()
        ];
    }
}
