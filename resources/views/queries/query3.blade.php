@section('content')
    <x-moonshine::table>
        <x-slot:thead class="text-left">
            <th colspan="5">Список заказов определенного клиента</th>
        </x-slot:thead>
        <x-slot:tbody>
        <tr>
            <th class="bgc-green">ID Заказа</th>
            <th class="bgc-green">Имя Клиента</th>
            <th class="bgc-green">Название Изделия</th>
            <th class="bgc-green">Общая Стоимость</th>
            <th class="bgc-green">Дата Заказа</th>
        </tr>
        @foreach($queries as $query)
        <tr>
            <th>{{ $query->order_id }}</th>
            <th>{{ $query->user_name }}</th>
            <th>{{ $query->product_name }}</th>
            <th>{{ $query->total_cost }}</th>
            <th>{{ $query->order_date }}</th>
        </tr>
        @endforeach
        </x-slot:tbody>
    </x-moonshine::table>
@endsection
