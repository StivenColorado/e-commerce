<x-app title="Inicio">
    <section class="my-3 d-flex justify-content-center">
        <h1>Listado de Libros</h1>
    </section>

    <section class="d-flex flex-wrap justify-content-center">
        @foreach ($products as $product)
            <div class="card mx-2 my-3 card_size bg-dark text-white">
                <img src="{{ $product->file->route }}" class="card-img-top position-relative w-50 left-10" style="left:25%" alt="Portada Libro">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->title }}</h5>
                    <p class="card-text">{{ $product->format_description }}</p>
                    <div class="d-flex flex-wrap">
                        <span class="w-100">
                            <strong>Autor: </strong> {{ $product->author->name }}
                        </span>
                        <span class="mt-2">
                            <strong>Categoria: </strong> {{ $product->category->name }}
                        </span>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-success" type="button">
                            Solicitar
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </section>
</x-app>
