<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product_Stone;
use App\Models\Stone;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Relationships\BelongsTo;

/**
 * @extends ModelResource<Product_Stone>
 */
class Product_StoneResource extends ModelResource
{
    protected string $model = Product_Stone::class;

    protected string $title = 'Product_Stones';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                BelongsTo::make(
                    __('product_id'),
                    'product',
                    static fn(Product $model) => $model->name,
                    new ProductResource(),
                ),
                BelongsTo::make(
                    __('stone_id'),
                    'stone',
                    static fn(Stone $model) => $model->name,
                    new StoneResource(),
                ),
            ]),
        ];
    }

    /**
     * @param Product_Stone $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
