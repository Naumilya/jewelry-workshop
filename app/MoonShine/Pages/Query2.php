<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use MoonShine\Components\FormBuilder;
use MoonShine\Decorations\TextBlock;
use MoonShine\Pages\Page;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Decorations\Block;
use MoonShine\Fields\Date;
use MoonShine\Fields\Number;
use MoonShine\Fields\Text;

class Query2 extends Page
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
        return $this->title ?: 'Query2';
    }

    /**
     * @return list<MoonShineComponent>
     */
    public function components(): array
    {
        $cost = Number::make('cost')->value();

        $action = '/admin/page/query2?' . http_build_query([
            'cost' => $cost,
        ]);

        return [
            TextBlock::make("Получить список всех изделий, у которых стоимость превышает заданную сумму", ''),
            Block::make([
                FormBuilder::make()
                    ->action($action)
                    ->method('POST')
                    ->fields([
                        Number::make('Стоимость', 'cost')->step(0.01)->min(0),
                    ])
                    ->submit(label: 'Сделать запрос', attributes: ['class' => 'btn-success'])
            ])
        ];
    }

}
