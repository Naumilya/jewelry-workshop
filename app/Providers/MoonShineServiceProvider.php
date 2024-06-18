<?php

declare(strict_types=1);

namespace App\Providers;

use App\MoonShine\Resources\CategoryResource;
use App\MoonShine\Resources\MasterResource;
use App\MoonShine\Resources\MaterialResource;
use App\MoonShine\Resources\NewsResource;
use App\MoonShine\Resources\OrderResource;
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
            ]),
        ];
    }

    /**
     * @return Closure|array{css: string, colors: array, darkColors: array}
     */
    protected function theme(): array
    {
        return [];
    }
}
