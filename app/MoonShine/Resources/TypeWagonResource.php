<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\TypeWagon;
use App\MoonShine\Pages\TypeWagon\TypeWagonIndexPage;
use App\MoonShine\Pages\TypeWagon\TypeWagonFormPage;
use App\MoonShine\Pages\TypeWagon\TypeWagonDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Laravel\Pages\Page;

/**
 * @extends ModelResource<TypeWagon, TypeWagonIndexPage, TypeWagonFormPage, TypeWagonDetailPage>
 */
class TypeWagonResource extends ModelResource
{
    protected string $model = TypeWagon::class;

    protected string $title = 'Типы вагонов';

    protected ?string $alias = 'type-wagons';

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

}
