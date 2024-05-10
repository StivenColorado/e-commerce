<x-app title="Inicio">
    <section class="my-3 d-flex justify-content-center">
        <h1>Listado de productos</h1>
    </section>
    {{-- {{ dd($productsByCategory) }} --}}
    @foreach ($productsByCategory as $categoryName => $products)
        <section class="my-3">
            <h2 class="w-50 text-start" style="position:relative;left:10%;">{{ $categoryName }}</h2>
            <div class="d-flex flex-wrap justify-content-center w-100">
                @foreach ($products as $product)
                    <x-cartitem :image="$product->file->route" :formattedPrice="$product->formatted_price" :title="$product->title" :categoryName="$product->category->name"
                        :productId="$product->id" />
                @endforeach
            </div>
        </section>
    @endforeach
</x-app>
