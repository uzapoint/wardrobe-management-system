@extends('layouts.app')
@section('title')
<title>Edit Clothes Details</title>
@endsection
@section('content')

<div class="container mx-auto px-3 mt-3">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Edit</h4>
        </div>
        <div class="col-sm-12">
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
        @endif
    </div>
    <form action="{{ route('clothes.update', $clothes->id) }}" enctype="multipart/form-data" method="POST">
    @csrf

    <div class="card-box">
        <h3 class="card-title">Clothe details</h3>
        <div class="row">
            <div class="col-md-12">
                <!-- Display validation errors if any -->
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-focus select-focus">
                            <label class="focus-label">Name</label>
                            <input type="text" class="form-control floating" value="{{ $clothes->name }}" name="name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-focus select-focus">
                            <label class="focus-label">Category</label>
                            <input type="text" class="form-control floating" value="{{ $clothes->category }}" name="category">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-focus select-focus">
                            <label class="focus-label">Size</label>
                            <input type="text" class="form-control floating" value="{{ $clothes->size }}" name="size">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-focus select-focus">
                            <label class="focus-label">Image</label>
                            <input type="file" class="form-control floating" name="image">
                        </div>

                        <!-- Display current image if available -->
                        @if ($clothes->image)
                            <img src="{{ asset('storage/' . $clothes->image) }}" alt="Current Image" width="100">
                        @endif
                    </div>
                </div><br>
            </div>
        </div>
    </div>

    <div class="text-center m-t-20">
        <button class="btn btn-primary submit-btn" type="submit">Update</button><br><br>
        <a class="btn btn-secondary submit-btn" href="{{ route('clothes.index') }}">Cancel</a>
    </div>
</form>
</div>
</div>
@endsection
