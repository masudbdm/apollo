@extends('admin::layouts.adminMaster')
@section('title')
    | Menu Details
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Menu Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Menu Details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

     <!-- Default box -->
      <div class="card">
        <div class="card-body">
            <div class="card-header bg-info">
                <h3 class="card-title">Product Details</h3>
                <div class="card-tools">
                    <a class="btn btn-primary btn-xs" href="{{ route('admin.productsAll') }}"> Back</a>
                </div>
            </div>
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Product ID</th>
                    <td>{{$product->id}}</td>
                </tr>
                <tr>
                    <th>product Name</th>
                    <td>{{$product->name}}</td>
                </tr>

                 <tr>
                    <th>product Name</th>
                    <td>{{$product->price}}</td>
                </tr>

                <tr>
                    <th>product Excerpt</th>
                    <td>{{$product->excerpt}}</td>
                </tr>

                <tr>
                    <th>product Description</th>
                    <td>{!! $product->description !!}</td>
                </tr>

                <tr>
                    <th>product Image</th>
                    <td> <img  src="{{ route('imagecache', ['template' => 'cpmd', 'filename' => $product->fi()]) }}" alt="post"></td>
                </tr>

                
                <tr>
                    <th>Active</th>
                    <td>{{$product->active == 1 ? 'On' : 'Off'}}</td>
                </tr>

            </table>
        </div>
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->

@endsection



@push('js')
    <script>
        
    </script>
@endpush
