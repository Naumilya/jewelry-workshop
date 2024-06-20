@section('content')
    <x-moonshine::table>
        <x-slot:thead class="text-left">
            <tr>
                <th>ID</th>
                <th>Дата заказа</th>
                <th>Общая стоимость</th>
                <th>Статус</th>
            </tr>
        </x-slot:thead>
        <x-slot:tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->order_date }}</td>
            <td>{{ $order->total_cost }}</td>
            <td>{{ $order->status }}</td>
        </tr>
        @endforeach
        </x-slot:tbody>
    </x-moonshine::table>
@endsection
