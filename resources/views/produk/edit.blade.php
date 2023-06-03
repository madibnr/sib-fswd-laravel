@extends('layout.main')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="my-4">Create Product</h1>

            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('produk.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Category</label>
                            <select class="form-select" aria-label="kategori" id="kategori" name="kategori">
                                <option selected disabled>- Choose Category -</option>
                                @foreach ($kategori as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Name</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="caption" class="form-label">Caption</label>
                            <input type="text" class="form-control" id="caption" name="caption" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Price</label>
                            <input type="text" class="form-control" id="harga" name="harga" required>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection