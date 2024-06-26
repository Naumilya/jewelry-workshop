<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use MoonShine\Resources\Resource;
use MoonShine\Http\Request\MoonShineRequest;
use App\Enums\OrderStatusEnum;
use App\Models\Master;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use MoonShine\Http\Requests\MoonShineFormRequest;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Date;
use MoonShine\Fields\DateRange;
use MoonShine\Fields\Enum;
use MoonShine\Fields\Number;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Select;
use MoonShine\Filters\Filter;
use MoonShine\Fields\Text;

/**
 * @extends ModelResource<Order>
 */
class OrderResource extends ModelResource
{
    protected string $model = Order::class;

    protected string $title = 'Orders';

    // protected bool $saveFilterState = true;

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                BelongsTo::make(
                    __('user_id'),
                    'user',
                    static fn(User $model) => $model->name,
                    new UserResource(),
                ),
                BelongsTo::make(
                    __('master_id'),
                    'master',
                    static fn(Master $model) => $model->name,
                    new MasterResource(),
                ),
                BelongsTo::make(
                    __('product_id'),
                    'product',
                    static fn(Product $model) => $model->name,
                    new ProductResource(),
                ),
                Date::make('order_date', 'order_date'),
                Date::make('delivery_date', 'delivery_date'),
                Number::make('total_cost', 'total_cost'),
                Enum::make('status')->attach(OrderStatusEnum::class)
            ]),
        ];
    }

    public function filters(): array
    {
        return [
            Select::make('Пользователь', 'user_id')
                ->options(
                    User::pluck('name', 'id')
                        ->all()
                )->nullable(),
            Select::make('Мастер', 'master_id')
                ->options(
                    Master::pluck('name', 'id')
                        ->all()
                )->nullable(),
            DateRange::make('Дата выполнения заказа', 'delivery_date'),
            Date::make('Дата создания заказа', 'order_date_before')
                ->placeholder('Выберите дату')
                ->nullable()
                ->onChangeMethod('filterByOrderDateAfter'),
            Number::make('Сумма заказов больше чем', 'total_order_sum')
        ];
    }

    // public function filterByOrderDateAfter(MoonShineRequest $request): void
    // {
    //     $year = $request->input('order_date_after');
    //     $this->query->whereYear('created_at', '>', $year);
    // }




    /**
     * @param Order $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
