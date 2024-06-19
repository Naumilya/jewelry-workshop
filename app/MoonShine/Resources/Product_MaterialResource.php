<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Material;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product_Material;
use Illuminate\Support\Facades\DB;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Select;
use MoonShine\Metrics\ValueMetric;
use PHPUnit\Util\Filter;

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

    public function filters(): array
    {
        return [
            Select::make('Материал', 'material_id')
                ->options(
                    Material::pluck('name', 'id')
                        ->all()
                )->nullable(),

        ];
    }


    public function metrics(): array
    {
        return [
            ValueMetric::make('Общее количество изделий')
                ->value(function () {
                    $query = Product_Material::query();

                    if ($materialId = request('filters.material_id')) {
                        $query->where('material_id', $materialId);
                    }

                    return $query->count();
                }),
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
