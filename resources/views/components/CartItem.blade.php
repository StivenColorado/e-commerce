<a href="{{ route('show.index', ['id' => $productId]) }}"
    class="text-decoration-none card card_size hover-card bg-table text-white z-10 m-1">
    <div>
        <img src="{{ $image }}" class="card-img-top position-relative w-100" alt="Portada producto">

        <div class="card-body">
            <span class="mt-2 w-100 fs-3">
                <strong class="text-green">$</strong> {{ $formattedPrice }}
            </span>
            <h5 class="card-title fs-6">{{ $title }}</h5>
            {{-- <p class="card-text">{{ $product->format_description }}</p> --}}
            <div class="d-flex flex-wrap">
                <span class="w-100">
                </span>
                <span class="mt-2">
                    <strong>Categoria: </strong> {{ $categoryName }}
                </span>

            </div>
        </div>
        {{-- botones para agregar funcionalidad --}}
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="card-footer">
            <form action="{{ route('shoppingCart.store', ['product_id' => $productId]) }}" class="d-grid gap-2"
                method="POST">
                @csrf
                <input type="hidden" name="quantity" value="1">
                <input type="hidden" name="id_user" value="{{ Auth::id() }}">
                <button class="btn btn-outline-success" type="submit">
                    <x-icons.carticon />
                    Agregar al carrito
                </button>
            </form>

            <div class="d-grid gap-2 mt-2">
                <button class="btn btn-outline-warning" type="button">
                    <x-icons.carticon />
                    comprar
                </button>
            </div>
        </div>
    </div>
</a>
