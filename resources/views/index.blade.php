<x-app title="Inicio">
    <section class="my-3 d-flex justify-content-center">
        <h1>Listado de productos</h1>
    </section>

    <section class="d-flex flex-wrap justify-content-center">
        @foreach ($products as $product)
            <div class="card mx-2 my-3 card_size bg-dark text-white">
                <img src="{{ $product->file->route }}" class="card-img-top position-relative w-75 left-10"
                    style="left:12.5%" alt="Portada producto">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->title }}</h5>
                    <p class="card-text">{{ $product->format_description }}</p>
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
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-success" type="button">
                            <x-icons.carticon />
                            Agregar al carrito
                        </button>
                    </div>
                    <div class="d-grid gap-2 mt-2">
                        <button class="btn btn-outline-warning" type="button">
                            <x-icons.carticon />
                            comprar
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </section>
</x-app>
