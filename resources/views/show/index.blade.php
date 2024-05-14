<x-app>
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{ $product->file->route  }}" alt="..." /></div>
                <div class="col-md-6">
                    <div class="small mb-1">${{ $product->created_at }}</div>
                    <h1 class="display-5 fw-bolder">${{ $product->title }}</h1>
                    <div class="fs-5 mb-5">
                        <span class="text-decoration-line-through"><small class="text-red fs-6">${{ $product->discount }}</small></span>
                        <span class="m-2">{{$product->formatted_price}}</span>
                    </div>
                    <p class="lead">
                        {{ $product->description }}
                    </p>
                    <p class="lead">
                        <p class="{{ $product->stock > 3 ? 'text-green-ligth' : 'text-orange' }}">
                            Disponibles: {{ $product->stock }}
                        </p>
                    </p>

                    <form action="{{ route('shoppingCart.store', ['product_id' => $product->id]) }}"
                        class="d-grid gap-2" method="POST">
                        @csrf
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="id_user" value="{{ Auth::id() }}">
                        <button class="btn btn-outline-success" type="submit">
                            <x-icons.carticon />
                            Agregar al carrito
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-app>
