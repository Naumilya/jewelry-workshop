@section('content')

    <x-moonshine::table>

        <x-slot:thead class="text-left">
            <th colspan="2">Список изделий с годом выпуска позднее заданного значения</th>
        </x-slot:thead>

        <x-slot:tbody>
            <tr>
                <th class="bgc-green">ID</th>
                <th class="bgc-green">Название изделия</th>
                <th class="bgc-green">Год выпуска</th>
            </tr>

            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->order_date }}</td>
                </tr>
            @endforeach

        </x-slot:tbody>

    </x-moonshine::table>

@endsection
