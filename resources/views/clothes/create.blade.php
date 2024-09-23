@extends('layouts.app')

@section('content')

@if (session('success'))
<div class="alert alert-success">

    {{ session('alert') }}

</div>

@endif
<div >
    <div class="container mx-auto px-3 mt-3">

        <div class="row">

            <div class="col-sm-12">

                <h4 class="page-title">Add New Clothes</h4>

            </div>

        </div>

        <form action="{{route('clothes.store')}}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="card-box">

                <h3 class="card-title">Fill in the details</h3>

                <div class="row">

                    <div class="col-md-12">

                        @if ($errors->any())

                        @foreach ($errors->all() as $item)

                        <div class="alert alert-danger">

                            {{$item}}

                        </div>

                        @endforeach

                        @endif

                        <div class="profile-basic">

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group form-focus select-focus">

                                        <label class="focus-label">Name</label>

                                        <input type="text" class="form-control floating" name="name">

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group form-focus select-focus">

                                        <label class="focus-label">Category</label>

                                        <input type="text" class="form-control floating" name="category">

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group form-focus select-focus">

                                        <label class="focus-label">Size</label>

                                        <input type="text" class="form-control floating" name="size">

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group form-focus select-focus">

                                        <label class="focus-label">Image</label>

                                        <input type="file" class="form-control floating" name="image">

                                    </div>

                                </div>


                            </div>


                        </div>

                    </div>
        </form>

        <div class="text-center m-t-20">

            <button class="btn btn-primary submit-btn" type="submit">Submit</button>

        </div>
    </div>

    </form>

</div>

</div>

@endsection