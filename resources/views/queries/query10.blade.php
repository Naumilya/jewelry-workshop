@section('content')
    <x-moonshine::table>
        <x-slot:thead class="text-left">
            <th colspan="2">Список мастеров, специализирующихся на {{ $specialization }}</th>
        </x-slot:thead>
        <x-slot:tbody>
            <tr>
                <th class="bgc-green">ID</th>
                <th class="bgc-green">Имя мастера</th>
            </tr>
            @foreach($masters as $master)
                <tr>
                    <td>{{ $master->id }}</td>
                    <td>{{ $master->name }}</td>
                </tr>
            @endforeach
        </x-slot:tbody>
    </x-moonshine::table>
@endsection
