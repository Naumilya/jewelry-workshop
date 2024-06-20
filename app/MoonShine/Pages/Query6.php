<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use MoonShine\Components\FormBuilder;
use MoonShine\Pages\Page;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\TextBlock;
use MoonShine\Fields\Date;
use MoonShine\Fields\Number;

class Query6 extends Page
{
    /**
     * @return array<string, string>
     */
    public function breadcrumbs(): array
    {
        return [
            '#' => $this->title()
        ];
    }

    public function title(): string
    {
        return $this->title ?: 'Query6';
    }

    /**
     * @return list<MoonShineComponent>
     */
    public function components(): array
    {
        $total_orders = Number::make('total_orders')->value();

        $action = '/admin/page/query6?' . http_build_query([
            'total_orders' => $total_orders,
        ]);

        return [
            TextBlock::make("Список всех клиентов, у которых сумма заказов превышает заданное значение", ''),
            Block::make([
                FormBuilder::make()
                    ->action($action)
                    ->method('POST')
                    ->fields([
                        Number::make('Сумма заказов', 'total_orders')->min(0)->step(1),
                    ])
                    ->submit(label: 'Сделать запрос', attributes: ['class' => 'btn-success'])
            ])
        ];
    }
}
