<nav class="navbar navbar-expand-md navbar-dark shadow-sm">
    <div class="container">

        <a class="navbar-brand" href="{{ url('/') }}">{{ env('APP_NAME') }}</a>
        <form class="d-flex" role="search" class="bg-input">
            <input class="form-control text-white bg-input me-2" style="background:rgb(58, 58, 58);" type="search"
                placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">
                <x-icons.searchicon />
            </button>
        </form>

        {{-- Haburguesa --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse navbar-dark" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto ">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <x-icons.loginicon />
                                Inicio de sesión
                            </a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <x-icons.registericon />
                                Registro
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('shopping.index') }}">
                            <x-icons.carticon />
                            Carrito
                        </a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->full_name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end bg-dark" aria-labelledby="navbarDropdown">

                            @role('admin')
                                {{-- User --}}
                                <a class="dropdown-item text-white item-menu" href="{{ route('users.index') }}">
                                    <x-icons.profileIcon />
                                    Usuarios
                                </a>
                            @endrole
                            @role('admin|librarian')
                                {{-- Product --}}
                                <a class="dropdown-item text-white" href="{{ route('products.index') }}">
                                    <x-icons.saveIcon />
                                    productos
                                </a>
                            @endrole
                            @can('categories.index')
                                {{-- Category --}}
                                <a class="dropdown-item text-white" href="{{ route('categories.index') }}">
                                    <x-icons.categoryIcon />
                                    Categorias
                                </a>
                            @endcan
                            {{-- Logout --}}
                            <a class="dropdown-item text-white" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <x-icons.exitIcon />
                                Cerrar sesión
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('shopping.index') }}">
                            <x-icons.carticon />
                            Carrito
                        </a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
