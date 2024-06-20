<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\Models\Master;
use MoonShine\Components\FormBuilder;
use MoonShine\Decorations\TextBlock;
use MoonShine\Pages\Page;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Decorations\Block;
use MoonShine\Fields\Number;
use MoonShine\Fields\Select;

class Query1 extends Page
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
        return $this->title ?: 'Query1';
    }

    /**
     * @return list<MoonShineComponent>
     */
    public function components(): array
    {
        $master_id = Select::make('master_id')->value();

        $action = '/admin/page/query1?' . http_build_query([
            'master_id' => $master_id,
        ]);

        return [
            TextBlock::make("Получить список всех изделий, выполненных определенным мастером", ''),
            Block::make([
                FormBuilder::make()
                    ->action($action)
                    ->method('POST')
                    ->fields([
                        Select::make('Мастер', 'master_id')
                            ->options(
                                Master::pluck('name', 'id')
                                    ->all()
                            )->nullable(),
                    ])
                    ->submit(label: 'Сделать запрос', attributes: ['class' => 'btn-success'])
            ])
        ];
    }

}
