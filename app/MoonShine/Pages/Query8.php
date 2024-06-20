<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use MoonShine\Components\FormBuilder;
use MoonShine\Pages\Page;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\TextBlock;
use MoonShine\Fields\Date;

class Query8 extends Page
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
        return $this->title ?: 'Query8';
    }

    /**
     * @return list<MoonShineComponent>
     */
    public function components(): array
    {
        $action = '/admin/page/query8';

        return [
            TextBlock::make("Получить список всех заказов за определенный период времени", ''),
            Block::make([
                FormBuilder::make()
                    ->action($action)
                    ->method('POST')
                    ->fields([
                        Date::make('Начальная дата', 'start_date')->required(),
                        Date::make('Конечная дата', 'end_date')->required(),
                    ])
                    ->submit(label: 'Сделать запрос', attributes: ['class' => 'btn-success'])
            ])
        ];
    }
}
