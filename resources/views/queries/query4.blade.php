@section('content')
    <x-moonshine::table>
        <x-slot:thead class="text-left">
            <th colspan="6">Список заказов, выполненных определенным мастером</th>
        </x-slot:thead>
        <x-slot:tbody>
        <tr>
            <th class="bgc-green">ID Заказа</th>
            <th class="bgc-green">Имя Клиента</th>
            <th class="bgc-green">Название Изделия</th>
            <th class="bgc-green">Общая Стоимость</th>
            <th class="bgc-green">Дата Заказа</th>
            <th class="bgc-green">Мастер</th>
        </tr>
        @foreach($queries as $query)
        <tr>
            <th>{{ $query->order_id }}</th>
            <th>{{ $query->user_name }}</th>
            <th>{{ $query->product_name }}</th>
            <th>{{ $query->total_cost }}</th>
            <th>{{ $query->order_date }}</th>
            <th>{{ $query->master_name }}</th>
        </tr>
        @endforeach
        </x-slot:tbody>
    </x-moonshine::table>
@endsection
