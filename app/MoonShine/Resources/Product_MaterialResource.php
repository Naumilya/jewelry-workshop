<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Material;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product_Material;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Relationships\BelongsTo;

/**
 * @extends ModelResource<Product_Material>
 */
class Product_MaterialResource extends ModelResource
{
    protected string $model = Product_Material::class;

    protected string $title = 'Product_Materials';

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
                    __('material_id'),
                    'material',
                    static fn(Material $model) => $model->name,
                    new MaterialResource(),
                ),
            ]),
        ];
    }

    /**
     * @param Product_Material $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
