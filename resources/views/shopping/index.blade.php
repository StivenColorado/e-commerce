<x-app title="Carrito de compras">
    <div>
        <h1 class="w-100 text-white text-center">Carrito de Compras</h1>
        @if (count($combinedData) > 0)
            <table id="cartTable" class="w-75 bg-table" style="position:relative;left: 12%">
                <thead>
                    <tr>
                        <th>Preview</th>
                        <th>ID</th>
                        <th>ID de Usuario</th>
                        <th>Producto</th>
                        <th>Stock Disponible</th>
                        <th>Cantidad</th>
                        <th>sub total</th>
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
                                <form action="{{ route('shoppingCart.update', ['product' => $item['product']['id']]) }}"
                                    method="POST">
                                    @csrf
                                    <input class="bg-input disbled-style rounded" type="number" min="1"
                                        max="{{ $item['product']['stock'] }}" name="quantity"
                                        value="{{ $item['quantity'] }}">
                                    <button class="text-green bg-input disbled-style" title="Actualizar stock">
                                        <x-icons.updateicon />
                                    </button>
                                </form>
                            </td>
                            <td>
                                {{ $item['subtotal'] }}
                            </td>
                            <td>
                                <form id="delete-form-{{ $item['id'] }}"
                                    action="{{ route('shoppingCart.destroy', ['product' => $item['id']]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red" style="background: transparent;border:none;"
                                        title="Eliminar item del carrito">
                                        <x-icons.deleteicon />
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <p class="w-75 m-3 d-flex justify-content-end" style="left: 12%">
                Total del carrito de compras: {{ $totalCart }}
            </p>
        @else
            <p class=" m-3 text-center">
                No hay productos agregados al carrito
            </p>
        @endif
    </div>
</x-app>
