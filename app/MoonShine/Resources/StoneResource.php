<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Enums\StoneNameEnum;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stone;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Enum;

/**
 * @extends ModelResource<Stone>
 */
class StoneResource extends ModelResource
{
    protected string $model = Stone::class;

    protected string $title = 'Stones';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Enum::make('name')->attach(StoneNameEnum::class)
            ]),
        ];
    }

    /**
     * @param Stone $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
