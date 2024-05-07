<x-app>
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{ $product->file->route  }}" alt="..." /></div>
                <div class="col-md-6">
                    <div class="small mb-1">${{ $product->created_at }}</div>
                    <h1 class="display-5 fw-bolder">${{ $product->title }}</h1>
                    <div class="fs-5 mb-5">
                        <span class="text-decoration-line-through"><small class="text-red fs-6">${{ $product->formatted_price }}</small></span>
                        <span class="m-2">{{$product->formatted_price}}</span>
                    </div>
                    <p class="lead">
                        {{ $product->description }}
                    </p>
                    <div class="d-flex">
                        <input type="number" class="form-control text-center me-3" id="inputQuantity" min="1" max="{{ $product->stock }}" type="num" value="1" style="max-width: 3rem" />
                        <button class="btn btn-custom flex-shrink-0" type="button">
                            <i class="bi-cart-fill me-1"></i>
                            Add to cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app>
