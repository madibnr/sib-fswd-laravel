@extends('layout.main')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="my-4">Edit Slider</h1>

            <div class="card mb-4">
                <div class="card-body">

                    <form action="{{ route('slider.update', $slider->id) }}"  method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="title" name="title" required value="{{ $slider->title }}">
                        </div>

                        <div class="mb-3">
                            <label for="caption" class="form-label">Caption</label>
                            <input type="text" class="form-control" id="caption" name="caption" required value="{{ $slider->caption }}">
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Slider Image</label>
                            <input class="form-control" type="file" name="image" id="image" accept=".jpg, .jpeg, .png., .webp" value="{{ $slider->image }}">
                        </div>
                        @if (Auth::user()->role->name !== 'Staff')
                            <div class="col-md-6">
                                <label for="level" class="form-label">Status</label>
                                <select name="status" class="form-control">
                                    <option value="{{ $slider->status }}">{{ $slider->status }}</option>
                                    <option value="active">Active</option>
                                    <option value="pending">Pending</option>
                                    <option value="expired">Expired</option>
                                </select>
                            </div>
                        @else
                            <input type="hidden" name="status" value="{{ $slider->status }}">
                        @endif
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('slider.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>

                </div>
            </div>
        </div>
    </main>
@endsection