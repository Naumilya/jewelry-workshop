@section('content')
    <x-moonshine::table>
        <x-slot:thead class="text-left">
            <th colspan="3">Список клиентов с суммой заказов больше заданной</th>
        </x-slot:thead>
        <x-slot:tbody>
            <tr>
                <th class="bgc-green">ID</th>
                <th class="bgc-green">Имя клиента</th>
                <th class="bgc-green">Сумма заказов</th>
            </tr>
            @foreach($clients as $client)
                <tr>
                    <td>{{ $client->id }}</td>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->total_amount }}</td>
                </tr>
            @endforeach
        </x-slot:tbody>
    </x-moonshine::table>
@endsection
