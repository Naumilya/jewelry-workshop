@section('content')
    <x-moonshine::table>
        <x-slot:thead class="text-left">
            <th colspan="3">Список изделий, у которых стоимость превышает заданную сумму</th>
        </x-slot:thead>
        <x-slot:tbody>
        <tr>
            <th class="bgc-green">ID</th>
            <th class="bgc-green">Название изделия</th>
            <th class="bgc-green">Стоимость</th>
        </tr>
        @foreach($queries as $query)
        <tr>
            <th>{{ $query->id }}</th>
            <th>{{ $query->name }}</th>
            <th>{{ $query->cost }}</th>
        </tr>
        @endforeach
        </x-slot:tbody>
    </x-moonshine::table>
@endsection
