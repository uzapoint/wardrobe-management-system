@extends('layouts.app')

@section('title')
<title>All Clothes</title>
@endsection

@section('content')
<div class="container mx-auto px-3 mt-3">
    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">My clothes</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4 col-3 mr">
            <a href="{{route('clothes.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add new clothes</a>
        </div>



    </div>

</div>
<div class="row mx-auto px-3 mt-3">
    @if (session('success'))
    <div class="col-md-12">
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    </div>
    @endif
    <div class="col-md-12">
        <div class="table-responsive">
            <div class="table-responsive">
                <table id="example" class="table table-border table-striped custom-table mb-0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Size</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clothes as $item)
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>{{$item->category}}</td>
                            <td>{{$item->size}}</td>
                            <td><img src="{{ asset('/storage/' . $item->image) }}" width="100" height="100"></td>

                            <td>
                            <a href="{{route('clothes.edit',$item->id)}}" > Edit</a>
                        <a href="{{ route('clothes.destroy', $item->id) }}" onclick="event.preventDefault(); document.getElementById('delete-clothes-form').submit();">Delete</a>
                        <form id="delete-clothes-form" action="{{ route('clothes.destroy', $item->id) }}" method="POST" style="display: none;">
                            @method('delete')
                            @csrf
                        </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>

    </div>
</div>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script type="text/css" src="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-css/1.4.6/select2-bootstrap.min.css"></script>

<script>
    $('#example').dataTable({
        searching: true,
        paging: true,
        ordering: true,
        info: true,
        lengthChange: true,

        
    });

    function validateForm() {
        var fileInput = document.getElementById('file');
        var fileError = document.getElementById('file-error');

        if (fileInput.value === '') {
            fileError.textContent = 'Please choose a file.';
            return false;
        }

        fileError.textContent = '';
        return true;
    }
</script>
@endsection