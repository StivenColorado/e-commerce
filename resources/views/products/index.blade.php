<x-app title="productos">
    <section class="container">
        <div class="d-flex justify-content-center my-4">
            <h1>Listado de productos</h1>
        </div>
        <the-product-list :products="{{ $products }}" />
    </section>
</x-app>
