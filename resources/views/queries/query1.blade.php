@section('content')
    <x-moonshine::table>
        <x-slot:thead class="text-left">
            <th colspan="3">Список изделий, выполненных определенным мастером</th>
        </x-slot:thead>
        <x-slot:tbody>
        <tr>
            <th class="bgc-green">ID</th>
            <th class="bgc-green">Название изделия</th>
            <th class="bgc-green">Мастер</th>
        </tr>
        @foreach($queries as $query)
        <tr>
            <th>{{ $query->product_id }}</th>
            <th>{{ $query->product_name }}</th>
            <th>{{ $query->master_name }}</th>
        </tr>
        @endforeach
        </x-slot:tbody>
    </x-moonshine::table>
@endsection
