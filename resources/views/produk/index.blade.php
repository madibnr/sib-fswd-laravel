@extends('layout.main')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="my-4">Product</h1>

            <a class="btn btn-primary mb-2" href="{{ route('produk.create') }}" role="button">Create New</a>

            <div class="card mb-4">
                <div class="card-body">
                    <table id="dataTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th>Nama</th>
                                <th>Caption</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produk as $produk)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $produk->kategori->nama }}</td>
                                    <td>{{ $produk->name }}</td>
                                    <td>{{ $produk->caption }}</td>
                                    <td>Rp. {{ number_format($produk->harga, 0) }}</td>
                                    <td>
                                        <form onsubmit="return confirm('Are you sure? ');" action="{{ route('produk.destroy', $produk->id) }}" method="POST">
                                            <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection