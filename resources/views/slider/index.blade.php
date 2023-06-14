@extends('layout.main')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Slider
                <a class="btn btn-primary mb-2 float-end" href="{{ route('slider.create') }}" role="button">Create New</a>
            </h1>
        </div>
            <div class="container-fluid">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <form method="get" action="{{ route('slider.index') }}" class="mb-3">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label for="status" class="form-label">Filter Status</label>
                                        <select name="status" class="form-control">
                                            <option value="">All Statuses</option>
                                            <option value="active" {{ $status == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="expired" {{ $status == 'expired' ? 'selected' : '' }}>Expired</option>
                                        </select>
                                    </div>
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                        <a href="{{ route('slider.index') }}" class="btn btn-secondary">Reset</a>
                                    </div>
                                </div>
                            </form>
                            <table class="table table-bordered display" id="example" style="width:100%" cellspacing="0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Image</th>
                                        <th>Tittle</th>
                                        <th>Caption</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sliders as $slider)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img style="height: 50px; width: 50px;" src="{{ asset('storage/slider/' . $slider->image) }}" alt="">
                                            </td>
                                            <td>{{ $slider->title }}</td>
                                            <td>{{ $slider->caption }}</td>
                                            <td>{{ $slider->status }}</td>
                                            

                                            <td>
                                                @if (Auth::user()->role->name != 'Staff' || !in_array($slider->status, ['active', 'expired']))
                                                    <form onsubmit="return confirm('Are you sure? ');" action="{{ route('slider.destroy', $slider->id) }}" method="POST">
                                                        <a href="{{ route('slider.edit', $slider->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </main>
@endsection