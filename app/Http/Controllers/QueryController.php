<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Material;
use App\MoonShine\Pages\Query1;
use App\MoonShine\Pages\Query2;
use App\MoonShine\Pages\Query3;
use App\MoonShine\Pages\Query4;
use App\MoonShine\Pages\Query5;
use Illuminate\Support\Facades\DB;

class QueryController extends Controller
{
    /**
     * Get list of all products made by a specific master
     *
     * @param int $masterId
     * @return \Illuminate\Support\Collection
     */
    public function query1(Request $request)
    {

        $master_id = $request->input('master_id');

        $query1 = DB::table('products')
            ->join('orders', 'products.id', '=', 'orders.product_id')
            ->join('masters', 'orders.master_id', '=', 'masters.id')
            ->select('products.id as product_id', 'products.name as product_name', 'masters.name as master_name')
            ->where('orders.master_id', '=', $master_id)
            ->get();


        return Query1::make('Запрос 1', 'query1')
            ->setContentView('queries/query1', ['queries' => $query1])
            ->setBreadcrumbs(['#' => 'Запрос 1']);
        // return view('queries.query1', ['queries' => $query1]);
    }

    /**
     * Get list of all products with cost greater than a specified amount
     *
     * @param int $minCost
     * @return \Illuminate\Support\Collection
     */
    public function query2(Request $request)
    {
        $cost = $request->input('cost');

        $query2 = DB::table('products')
            ->select('id', 'name', 'cost')
            ->where('cost', '>', $cost)
            ->get();

        return Query2::make('Запрос 2', 'query2')
            ->setContentView('queries/query2', ['queries' => $query2])
            ->setBreadcrumbs(['#' => 'Запрос 2']);
    }

    /**
     * Get list of all orders made by a specific user
     *
     * @param int $userId
     * @return \Illuminate\Support\Collection
     */
    public function query3(Request $request)
    {
        $user_id = $request->input('user_id');

        $query3 = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->select('orders.id as order_id', 'users.name as user_name', 'products.name as product_name', 'orders.total_cost', 'orders.order_date')
            ->where('orders.user_id', '=', $user_id)
            ->get();

        return Query3::make('Запрос 3', 'query3')
            ->setContentView('queries/query3', ['queries' => $query3])
            ->setBreadcrumbs(['#' => 'Запрос 3']);
    }

    /**
     * Get list of all orders made by a specific master
     *
     * @param int $masterId
     * @return \Illuminate\Support\Collection
     */
    public function query4(Request $request)
    {
        $master_id = $request->input('master_id');

        $query4 = DB::table('orders')
            ->join('masters', 'orders.master_id', '=', 'masters.id')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->select('orders.id as order_id', 'users.name as user_name', 'products.name as product_name', 'orders.total_cost', 'orders.order_date', 'masters.name as master_name')
            ->where('orders.master_id', '=', $master_id)
            ->get();

        return Query4::make('Запрос 4', 'query4')
            ->setContentView('queries/query4', ['queries' => $query4])
            ->setBreadcrumbs(['#' => 'Запрос 4']);
    }

    /**
     * Get list of all orders grouped by product type and total orders
     *
     * @return \Illuminate\Support\Collection
     */
    public function query5(Request $request)
    {
        $category_id = $request->input('category_id');

        // Получение заказов для выбранного типа изделия
        $orders = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->join('product__categories', 'products.id', '=', 'product__categories.product_id')
            ->join('categories', 'product__categories.category_id', '=', 'categories.id')
            ->select('orders.id as order_id', 'products.name as product_name', 'categories.name as category_name')
            ->where('categories.id', $category_id)
            ->get();

        // Получение общего количества заказов для выбранного типа изделия
        $total_orders = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->join('product__categories', 'products.id', '=', 'product__categories.product_id')
            ->join('categories', 'product__categories.category_id', '=', 'categories.id')
            ->where('categories.id', $category_id)
            ->count();

        // Возвращаем страницу MoonShine с результатами запроса
        return Query5::make('Запрос 5', 'query5')
            ->setContentView('queries/query5', ['orders' => $orders, 'total_orders' => $total_orders])
            ->setBreadcrumbs(['#' => 'Запрос 5']);
    }

    /**
     * Get list of all users with total order cost greater than a specified amount
     *
     * @param int $minTotalCost
     * @return \Illuminate\Support\Collection
     */
    public function query6($minTotalCost)
    {
        return User::whereHas('orders', function ($query) use ($minTotalCost) {
            $query->where('total_cost', '>', $minTotalCost);
        })->get();
    }

    /**
     * Get list of all products with release year greater than a specified year
     *
     * @param int $year
     * @return \Illuminate\Support\Collection
     */
    public function query7($year)
    {
        return Product::whereYear('created_at', '>', $year)->get();
    }

    /**
     * Get list of all orders with delivery date within a specified range
     *
     * @param string $startDate
     * @param string $endDate
     * @return \Illuminate\Support\Collection
     */
    public function query8($startDate, $endDate)
    {
        return Order::whereBetween('delivery_date', [$startDate, $endDate])->get();
    }

    /**
     * Get list of all products grouped by material and total products
     *
     * @return \Illuminate\Support\Collection
     */
    public function query9()
    {
        return Product::select('materials.name', DB::raw('count(*) as total_products'))
            ->join('product__materials', 'products.id', '=', 'product__materials.product_id')
            ->join('materials', 'product__materials.material_id', '=', 'materials.id')
            ->groupBy('materials.name')
            ->get();
    }

    /**
     * Get list of all masters with a specific specialization
     *
     * @param string $specialization
     * @return \Illuminate\Support\Collection
     */
    public function query10($specialization)
    {
        return Master::where('specialization', $specialization)->get();
    }
}
