@extends('layout.main')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Kategori
        <a class="btn btn-primary mb-2 float-end" href="{{ route('kategori.create') }}" role="button">Create New</a>
        </h1>
    </div>
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <table class="table table-bordered display" id="example" style="width:100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    
                        <tbody>
                            @foreach ($kategori as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>
                                        <a href="{{ route('kategori.edit', ['id' => $item->id]) }}" role="button" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('kategori.destroy', $item->id) }}" method="post" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" name="delete" value="" class="btn btn-danger btn-sm">Hapus</button>
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
