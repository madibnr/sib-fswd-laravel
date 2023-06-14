@extends('layout.main')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="my-4">Edit Produk</h1>

            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-select" aria-label="kategori" id="kategori" name="kategori">
                                <option selected disabled>- Pilih Kategori -</option>
                                @foreach ($kategori as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $produk->name }}">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="caption" class="form-label">Caption</label>
                            <input type="text" class="form-control" id="caption" name="caption" value="{{ $produk->caption }}">
                            @error('caption')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="text" class="form-control" id="harga" name="harga" value="{{ $produk->harga }}">
                            @error('harga')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @if (Auth::user()->role->name !== 'Staff')
                        <div class="col-md-6">
                            <label for="level" class="form-label">Status</label>
                            <select name="status" class="form-control">
                                <option value="{{ $produk->status }}">{{ $produk->status }}</option>
                                <option value="approve">Approve</option>
                                <option value="pending">Pending</option>
                                <option value="reject">Reject</option>
                            </select>
                        </div>
                        @else
                            <input type="hidden" name="status" value="{{ $produk->status }}">
                        @endif
                        <div class="mb-3">
                            <label for="image" class="form-label">Slider Image</label>
                            <input class="form-control" type="file" name="image" id="image" accept=".jpg, .jpeg, .png., .webp">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection