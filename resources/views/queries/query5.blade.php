@section('content')
    <h3>Общее количество заказов: {{ $total_orders }}</h3>
    <x-moonshine::table>
        <x-slot:thead class="text-left">
            <tr>
                <th>ID заказа</th>
                <th>Название изделия</th>
                <th>Тип изделия</th>
            </tr>
        </x-slot:thead>
        <x-slot:tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{ $order->order_id }}</td>
            <td>{{ $order->product_name }}</td>
            <td>{{ $order->category_name }}</td>
        </tr>
        @endforeach
        </x-slot:tbody>
    </x-moonshine::table>
@endsection
