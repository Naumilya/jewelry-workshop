<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Product;
use App\MoonShine\Pages\Query1;
use App\MoonShine\Pages\Query10;
use App\MoonShine\Pages\Query2;
use App\MoonShine\Pages\Query3;
use App\MoonShine\Pages\Query4;
use App\MoonShine\Pages\Query5;
use App\MoonShine\Pages\Query6;
use App\MoonShine\Pages\Query7;
use App\MoonShine\Pages\Query8;
use App\MoonShine\Pages\Query9;
use App\MoonShine\Resources\CategoryResource;
use App\MoonShine\Resources\MasterResource;
use App\MoonShine\Resources\MaterialResource;
use App\MoonShine\Resources\NewsResource;
use App\MoonShine\Resources\OrderResource;
use App\MoonShine\Resources\Product_CategoryResource;
use App\MoonShine\Resources\Product_MaterialResource;
use App\MoonShine\Resources\Product_StoneResource;
use App\MoonShine\Resources\ProductResource;
use App\MoonShine\Resources\StoneResource;
use App\MoonShine\Resources\UserResource;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\MoonShine;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;
use MoonShine\Contracts\Resources\ResourceContract;
use MoonShine\Menu\MenuElement;
use MoonShine\Pages\Page;
use Closure;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{

    public function boot(): void
    {
        parent::boot();

        moonshineColors()
            ->background('#171717')
            ->content('#171717')
            ->tableRow('#171717')
            ->dividers('#cfcece')
            ->borders('#cfcece')
            ->buttons('#171717')
            ->primary('#171717')
            ->secondary('#FFE766');
    }
    /**
     * @return list<ResourceContract>
     */
    protected function resources(): array
    {
        return [];
    }

    /**
     * @return list<Page>
     */
    protected function pages(): array
    {
        return [];
    }

    /**
     * @return Closure|list<MenuElement>
     */
    protected function menu(): array
    {
        return [
            MenuGroup::make(static fn() => __('moonshine::ui.resource.system'), [
                MenuItem::make(
                    static fn() => __('moonshine::ui.resource.admins_title'),
                    new MoonShineUserResource()
                ),
                MenuItem::make(
                    static fn() => __('moonshine::ui.resource.role_title'),
                    new MoonShineUserRoleResource()
                ),
            ]),

            MenuGroup::make(static fn() => __('Data base'), [
                MenuItem::make(
                    static fn() => __('categories'),
                    new CategoryResource()
                ),
                MenuItem::make(
                    static fn() => __('masters'),
                    new MasterResource()
                ),
                MenuItem::make(
                    static fn() => __('materials'),
                    new MaterialResource()
                ),
                MenuItem::make(
                    static fn() => __('news'),
                    new NewsResource()
                ),
                MenuItem::make(
                    static fn() => __('orders'),
                    new OrderResource()
                ),
                MenuGroup::make(static fn() => __('products'), [
                    MenuItem::make(
                        static fn() => __('products'),
                        new ProductResource()
                    ),
                    MenuItem::make(
                        static fn() => __('product__categories'),
                        new Product_CategoryResource()
                    ),
                    MenuItem::make(
                        static fn() => __('product__materials'),
                        new Product_MaterialResource()
                    ),
                    MenuItem::make(
                        static fn() => __('product__stones'),
                        new Product_StoneResource()
                    ),
                ]),
                MenuItem::make(
                    static fn() => __('stones'),
                    new StoneResource()
                ),
                MenuItem::make(
                    static fn() => __('users'),
                    new UserResource()
                ),
                MenuGroup::make(static fn() => __('Queries'), [
                    MenuItem::make('Query1', Query1::make('Query1', 'query1')),
                    MenuItem::make('Query2', Query2::make('Query2', 'query2')),
                    MenuItem::make('Query3', Query3::make('Query3', 'query3')),
                    MenuItem::make('Query4', Query4::make('Query4', 'query4')),
                    MenuItem::make('Query5', Query5::make('Query5', 'query5')),
                    MenuItem::make('Query6', Query6::make('Query6', 'query6')),
                    MenuItem::make('Query7', Query7::make('Query7', 'query7')),
                    MenuItem::make('Query8', Query8::make('Query8', 'query8')),
                    MenuItem::make('Query9', Query9::make('Query9', 'query9')),
                    MenuItem::make('Query10', Query10::make('Query10', 'query10')),
                ]),
            ]),
        ];
    }

    /**
     * @return Closure|array{css: string, colors: array, darkColors: array}
     */
    protected function theme(): array
    {
        return [
            // 'colors' => [
            //     'body' => '#171717',
            //     'primary' => '#171717',
            //     'secondary' => '#ffe766',
            // ],
        ];
    }
}
