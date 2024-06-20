@section('content')
    <x-moonshine::table>
        <x-slot:thead class="text-left">
            <th colspan="2">Список изделий, сгруппированных по материалу</th>
        </x-slot:thead>
        <x-slot:tbody>
            <tr>
                <th class="bgc-green">Материал</th>
                <th class="bgc-green">Количество изделий</th>
            </tr>
            @foreach($productsByMaterial as $product)
                <tr>
                    <td>{{ $product->material_name }}</td>
                    <td>{{ $product->total_products }}</td>
                </tr>
            @endforeach
        </x-slot:tbody>
    </x-moonshine::table>
@endsection
