<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\TypeWagon;
use App\MoonShine\Pages\TypeWagon\TypeWagonIndexPage;
use App\MoonShine\Pages\TypeWagon\TypeWagonFormPage;
use App\MoonShine\Pages\TypeWagon\TypeWagonDetailPage;
use MoonShine\ImportExport\Contracts\HasImportExportContract;
use MoonShine\ImportExport\Traits\ImportExportConcern;
use MoonShine\Laravel\Enums\Action;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\{ID, Text};

/**
 * @extends ModelResource<TypeWagon, TypeWagonIndexPage, TypeWagonFormPage, TypeWagonDetailPage>
 */
class TypeWagonResource extends ModelResource implements HasImportExportContract
{
    use ImportExportConcern;

    protected string $model = TypeWagon::class;

    protected string $title = 'Типы вагонов';
    protected ?string $alias = 'type-wagons';
    protected bool $columnSelection = true;

    protected string $column = 'short_name';
    protected bool $createInModal = true;

    // Ниже функция, которая убирает кнопку ВЬЮ
    protected function activeActions(): ListOf
    {
        return parent::activeActions()->except(Action::VIEW);
    }

    /**
     * @return list<Page>
     */
    protected function pages(): array
    {
        return [
            TypeWagonIndexPage::class,
            TypeWagonFormPage::class,
            TypeWagonDetailPage::class,
        ];
    }

    /**
     * @param TypeWagon $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }

    protected function search(): array
    {
        return [
            'id',
            'short_name',
            'full_name',
        ];
    }

    protected function filters(): iterable
    {
        return [
            Text::make('Сокр.назв', 'short_name'),
        ];
    }

    protected function exportFields(): iterable
    {
        return [
            ID::make('№ п/п', 'id'),
            Text::make('Сокр.назв', 'short_name'),
            Text::make('Полное название', 'full_name'),
        ];
    }

    protected function importFields(): iterable
    {
        return [
            ID::make('№ п/п', 'id'),
            Text::make('Сокр.назв', 'short_name'),
            Text::make('Полное название', 'full_name'),
        ];
    }
}
