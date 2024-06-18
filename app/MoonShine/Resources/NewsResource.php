<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\News;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Date;
use MoonShine\Fields\Text;

/**
 * @extends ModelResource<News>
 */
class NewsResource extends ModelResource
{
    protected string $model = News::class;

    protected string $title = 'News';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('title', 'title'),
                Text::make('theme', 'theme'),
                Text::make('copyright', 'copyright'),
                Text::make('description', 'description'),
                Text::make('image_path', 'image_path'),
                Date::make('created_at', 'created_at'),
                Date::make('updated_at', 'updated_at'),
            ]),
        ];
    }

    /**
     * @param News $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
