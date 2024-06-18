<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Enums\MaterialNameEnum;
use Illuminate\Database\Eloquent\Model;
use App\Models\Material;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Date;
use MoonShine\Fields\Enum;

/**
 * @extends ModelResource<Material>
 */
class MaterialResource extends ModelResource
{
    protected string $model = Material::class;

    protected string $title = 'Materials';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Enum::make('name')->attach(MaterialNameEnum::class),
                Date::make('created_at', 'created_at'),
                Date::make('updated_at', 'updated_at'),
            ]),
        ];
    }

    /**
     * @param Material $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
