@extends('layout.main')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="my-4">Produk
                @if (Auth::user()->role->name != 'User')
                    <a class="btn btn-primary mb-2 float-end" href="{{ route('produk.create') }}" role="button">Create New</a>
                @endif
            </h1>
            <div class="card mb-4">
                <div class="card-body">
                    <form method="get" action="{{ route('produk.index') }}" class="mb-3">
                        <div class="row">
                            @if (Auth::user()->role->name != 'User')
                            <div class="col-lg-2">
                                <label for="status" class="form-label">Filter Status</label>
                                <select name="status" class="form-control">
                                    <option value="">All Statuses</option>
                                    <option value="approve" {{ $status == 'approve' ? 'selected' : '' }}>Approve</option>
                                    <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="reject" {{ $status == 'reject' ? 'selected' : '' }}>Reject</option>
                                </select>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('produk.index') }}" class="btn btn-secondary">Reset</a>
                            </div>
                            @endif
                        </div>
                    </form>
                    <table id="dataTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Image</th>
                                <th>Kategori</th>
                                <th>Nama</th>
                                <th>Caption</th>
                                <th>Harga</th>
                                @if (Auth::user()->role->name != 'User')
                                    <th>Status</th>
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produk as $produk)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img style="height: 50px; width: 50px;" src="{{ asset('storage/produk/' . $produk->image) }}" alt="">
                                    </td>
                                    <td>{{ $produk->kategori->nama }}</td>
                                    <td>{{ $produk->name }}</td>
                                    <td>{{ $produk->caption }}</td>
                                    <td>Rp. {{ number_format($produk->harga, 0) }}</td>
                                    @if (Auth::user()->role->name != 'User')
                                        <td>{{ $produk->status }}</td>
                                        <td>
                                            @if (Auth::user()->role->name != 'Staff' || !in_array($produk->status, ['approve', 'reject']))
                                                <form onsubmit="return confirm('Are you sure? ');" action="{{ route('slider.destroy', $produk->id) }}" method="POST">
                                                    <a href="{{ route('slider.edit', $produk->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection