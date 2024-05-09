<x-app title="Carrito de compras">
    <div>
        <h1 class="w-100 text-white text-center">Carrito de Compras</h1>
        <table id="cartTable" class="w-75 bg-table" style="position:relative;left: 12%">
            <thead>
                <tr>
                    <th>Preview</th>
                    <th>ID</th>
                    <th>ID de Usuario</th>
                    <th>Producto</th>
                    <th>Stock Disponible</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($combinedData as $item)
                    <tr>
                        <td><img style="width:3em;heigth:10vh;" src="{{ $item['product']['file']['route'] }}"
                                alt="" srcset=""></td>
                        <td>{{ $item['id'] }}</td>
                        <td>{{ $item['id_user'] }}</td>
                        {{-- <td>{{ $item['product']['file']['route'] }}</td> --}}
                        <td>{{ $item['product']['title'] }}</td>
                        <td>{{ $item['product']['stock'] }}</td>
                        <td>
                            <input class="bg-input rounded" type="number" min="1" max="{{ $item['product']['stock'] }}"
                                value="{{ $item['quantity'] }}">
                            <button class="text-green bg-input" title="Actualizar stock">
                                <x-icons.updateicon/>
                            </button>
                        </td>
                        <td>
                            <button class="text-red" style="background: transparent;border:none;" title="Eliminar item del carrito">
                                <x-icons.deleteicon/>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app>
