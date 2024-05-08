<x-app title="Carrito de compras">
    <div>
        <h1 class="w-100 text-white text-center">Carrito de Compras</h1>
        <table id="cartTable" class="w-75 bg-table" style="position:relative;left: 12%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID de Usuario</th>
                    <th>Producto</th>
                    <th>Stock Disponible</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($combinedData as $item)
                    <tr>
                        <td>{{ $item['id'] }}</td>
                        <td>{{ $item['id_user'] }}</td>
                        <td>{{ $item['product']['title'] }}</td>
                        <td>{{ $item['product']['stock'] }}</td>
                        <td>
                            <input type="number" max="{{ $item['product']['stock'] }}" value="{{ $item['quantity'] }}">
                            <button>Actualizar</button>
                        </td>
                        <td>
                            <button>Eliminar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app>
