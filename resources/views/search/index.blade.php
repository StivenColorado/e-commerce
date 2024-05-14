<x-app>
    <h1 class="w-100 text-center">Resultados para "{{ $query }}"</h1>

    @if (count($results))
        <section class="my-3">
            <div class="d-flex flex-wrap justify-content-center w-100">
                @foreach ($results as $product)
                    <x-cartitem :image="$product->file->route" :formattedPrice="$product->formatted_price" :title="$product->title" :categoryName="$product->category->name" :stock="$product->stock"
                        :productId="$product->id" />
                @endforeach

            </div>
        </section>
    @else
        <p class="w-100 text-center">No se encontraron resultados.</p>
    @endif
</x-app>
