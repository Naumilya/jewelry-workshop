<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use MoonShine\Components\FormBuilder;
use MoonShine\Pages\Page;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\TextBlock;
use MoonShine\Fields\Date;

class Query7 extends Page
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
        return $this->title ?: 'Query7';
    }

    /**
     * @return list<MoonShineComponent>
     */
    public function components(): array
    {
        $order_date = Date::make('order_date')->value();

        $action = '/admin/page/query7?' . http_build_query([
            'order_date' => $order_date,
        ]);

        return [
            TextBlock::make("Получить список всех изделий, у которых год выпуска позднее заданного значения", ''),
            Block::make([
                FormBuilder::make()
                    ->action($action)
                    ->method('POST')
                    ->fields([
                        Date::make('Год выпуска', 'order_date'),
                    ])
                    ->submit(label: 'Сделать запрос', attributes: ['class' => 'btn-success'])
            ])
        ];
    }
}
