<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\Models\Material;
use MoonShine\Components\FormBuilder;
use MoonShine\Decorations\TextBlock;
use MoonShine\Pages\Page;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Decorations\Block;
use MoonShine\Fields\Select;

class Query9 extends Page
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
        return $this->title ?: 'Query9';
    }

    /**
     * @return list<MoonShineComponent>
     */
    public function components(): array
    {
        $material_id = Select::make('material_id')->value();

        $action = '/admin/page/query9?' . http_build_query([
            'material_id' => $material_id,
        ]);

        return [
            TextBlock::make("Список изделий, сгруппированных по материалу и указанием количества изделий для каждого материала", ''),
            Block::make([
                FormBuilder::make()
                    ->action($action)
                    ->method('POST')
                    ->fields([
                        Select::make('Материал', 'material_id')
                            ->options(
                                Material::pluck('name', 'id')
                                    ->all()
                            )->nullable(),
                    ])
                    ->submit(label: 'Сделать запрос', attributes: ['class' => 'btn-success'])
            ])
        ];
    }
}
