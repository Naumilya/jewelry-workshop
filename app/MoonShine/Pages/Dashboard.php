<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use MoonShine\Decorations\TextBlock;
use MoonShine\Pages\Page;
use MoonShine\Components\MoonShineComponent;

class Dashboard extends Page
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
        return $this->title ?: 'Главная страница';
    }

    /**
     * @return list<MoonShineComponent>
     */
    public function components(): array
    {
        return [
            TextBlock::make('Здесь вы можете редактировать, обновлять, просматривать, удалять таблицы из бд. Также есть доступ к запросам.', 'Выберете один из пунктов в меню.')
        ];
    }
}
