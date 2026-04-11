<div class="container">


    <form action="{{ route('store.index') }}" method="GET">


        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search" name="search" value="{{ old('search') }}">
            <div class="input-group-append">
                <button class="btn btn-success" type="submit">Search</button>
            </div>
        </div>




    </form>
</div>
