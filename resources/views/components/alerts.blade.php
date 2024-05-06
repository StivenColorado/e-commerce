@if (Session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session::get('success') }}
        <button class="btn-close" type="button" data-bs-dismiss="alert" arial-label="close"></button>
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session::get('error') }}
        <button class="btn-close" type="button" data-bs-dismiss="alert" arial-label="close"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach ($errors->all() as $sms)
                <li>{{ $sms }}</li>
            @endforeach
        </ul>
        <button class="btn-close" type="button" data-bs-dismiss="alert" arial-label="close"></button>
    </div>
@endif
