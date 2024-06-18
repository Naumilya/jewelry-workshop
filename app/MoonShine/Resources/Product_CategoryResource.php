<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product_Category;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Relationships\BelongsTo;

/**
 * @extends ModelResource<Product_Category>
 */
class Product_CategoryResource extends ModelResource
{
    protected string $model = Product_Category::class;

    protected string $title = 'Product_Categories';

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
                    __('category_id'),
                    'category',
                    static fn(Category $model) => $model->name,
                    new CategoryResource(),
                ),
            ]),
        ];
    }

    /**
     * @param Product_Category $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
