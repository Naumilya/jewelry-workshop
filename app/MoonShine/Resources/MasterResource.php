<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Enums\SpecializationEnum;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Date;
use MoonShine\Fields\Enum;
use MoonShine\Fields\Select;
use MoonShine\Fields\Text;

/**
 * @extends ModelResource<Master>
 */
class MasterResource extends ModelResource
{
    protected string $model = Master::class;

    protected string $title = 'Masters';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make("name", "name"),
                Enum::make("specialization")->attach(SpecializationEnum::class),
                // Date::make('created_at', 'created_at'),
                // Date::make('updated_at', 'updated_at'),
            ]),
        ];
    }

    public function filters(): array
    {
        return [
            Select::make('Материал', 'specialization')
                ->options(
                    [
                        'золото' => 'золото',
                        'платина' => 'платина',
                        'серебро' => 'серебро',
                        'алмаз' => 'алмаз'
                    ]
                )->nullable(),
        ];
    }


    /**
     * @param Master $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
