<x-app title="Inicio">
    <section class="my-3 d-flex justify-content-center">
        <h1>Listado de productos</h1>
    </section>

    @foreach ($productsByCategory as $categoryName => $products)
        <section class="my-3">
            <h2 class="w-50 text-start" style="position:relative;left:10%;">{{ $categoryName }}</h2>
            <div class="d-flex flex-wrap justify-content-center w-100">
                @foreach ($products as $product)
                    {{-- <a href="{{ route('show.index', ['id' => $product->id]) }}"
                        class="text-decoration-none card card_size hover-card bg-table text-white z-10 m-1"> --}}
                    <a class="text-decoration-none card card_size hover-card bg-table text-white z-10 m-1">
                        <img src="{{ $product->file->route }}" class="card-img-top position-relative w-100"
                            alt="Portada producto">

                        <div class="card-body">
                            <span class="mt-2 w-100 fs-3">
                                <strong class="text-green">$</strong> {{ $product->formatted_price }}
                            </span>
                            <h5 class="card-title fs-6">{{ $product->title }}</h5>
                            {{-- <p class="card-text">{{ $product->format_description }}</p> --}}
                            <div class="d-flex flex-wrap">
                                <span class="w-100">
                                    <strong>Autor: </strong> {{ $product->supplier->name }}
                                </span>
                                <span class="mt-2">
                                    <strong>Categoria: </strong> {{ $product->category->name }}
                                </span>

                            </div>
                        </div>
                        {{-- botones para agregar funcionalidad --}}
                        <div class="card-footer">
                            <form action="{{ route('shoppingCart.store', ['id_product' => $product->id]) }}" class="d-grid gap-2" method="POST">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
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
                    </a>
                @endforeach
            </div>
        </section>
    @endforeach
</x-app>
