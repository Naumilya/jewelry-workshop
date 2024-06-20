<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\Models\Category;
use App\Models\Product_Category;
use MoonShine\Components\FormBuilder;
use MoonShine\Decorations\TextBlock;
use MoonShine\Pages\Page;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Decorations\Block;
use MoonShine\Fields\Select;

class Query5 extends Page
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
        return $this->title ?: 'Query5';
    }

    /**
     * @return list<MoonShineComponent>
     */
    public function components(): array
    {

        $category_id = Select::make('category_id')->value();

        $action = '/admin/page/query5?' . http_build_query([
            'category_id' => $category_id,
        ]);

        return [
            TextBlock::make("Список всех заказов, сгруппированных по типу изделия и указанием общего количества выполненных изделий для каждого типа", ''),
            Block::make([
                FormBuilder::make()
                    ->action($action)
                    ->method('POST')
                    ->fields([
                        Select::make('Тип изделия', 'category_id')
                            ->options(
                                Category::pluck('name', 'id')
                                    ->all()
                            )->nullable(),
                    ])
                    ->submit(label: 'Сделать запрос', attributes: ['class' => 'btn-success'])
            ])
        ];
    }
}
