<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use MoonShine\Components\FormBuilder;
use MoonShine\Decorations\TextBlock;
use MoonShine\Pages\Page;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Decorations\Block;
use MoonShine\Fields\Select;

class Query10 extends Page
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
        return $this->title ?: 'Query10';
    }

    /**
     * @return list<MoonShineComponent>
     */
    public function components(): array
    {


        $specialization = Select::make('specialization')->value();

        $action = '/admin/page/query10?' . http_build_query([
            'specialization' => $specialization,
        ]);

        return [
            TextBlock::make("Список мастеров, специализирующихся на определенных типах изделий", ''),
            Block::make([
                FormBuilder::make()
                    ->action($action)
                    ->method('POST')
                    ->fields([
                        Select::make('Специализация', 'specialization')
                            ->options([
                                'золото' => 'Золото',
                                'платина' => 'Платина',
                                'серебро' => 'Серебро',
                                'алмаз' => 'Алмаз',
                            ])
                            ->nullable(),
                    ])
                    ->submit(label: 'Сделать запрос', attributes: ['class' => 'btn-success'])
            ])
        ];
    }
}
