<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\Models\User;
use MoonShine\Components\FormBuilder;
use MoonShine\Decorations\TextBlock;
use MoonShine\Pages\Page;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Decorations\Block;
use MoonShine\Fields\Select;

class Query3 extends Page
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
        return $this->title ?: 'Query3';
    }

    /**
     * @return list<MoonShineComponent>
     */
    public function components(): array
    {
        $user_id = Select::make('user_id')->value();

        $action = '/admin/page/query3?' . http_build_query([
            'user_id' => $user_id,
        ]);

        return [
            TextBlock::make("Получить список всех заказов определенного клиента", ''),
            Block::make([
                FormBuilder::make()
                    ->action($action)
                    ->method('POST')
                    ->fields([
                        Select::make('Клиент', 'user_id')
                            ->options(
                                User::pluck('name', 'id')
                                    ->all()
                            )->nullable(),
                    ])
                    ->submit(label: 'Сделать запрос', attributes: ['class' => 'btn-success'])
            ])
        ];
    }
}
