@extends('admin::layouts.adminMaster')
@section('title')
    |  Product Image Edit
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product Image Edit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Product Image Edit</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card shadow">
        <div class="card-body bg-info">
          Product Image Edit
        </div>
    </div>
   

     

      <div class="card card-widget">
        <div class="card-header text-center">
            <form class="form-inline" method="post" action="{{ route('admin.productImageUpdate',$image->id)}}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="product_image">Product Image</label>
                    <input type="file" name="product_image"  class="form-control ml-1" id="product_image" style="padding-bottom: 32px;">  
                </div>
                <button type="submit" class="w3-btn w3-blue w3-round w3-border w3-border-white ml-1">Add Image</button>
                &nbsp;&nbsp;&nbsp;
              {{-- error message start --}}
                @if ($errors->any())
                    <span style="color:red">
                        @foreach ($errors->all() as $error)
                        {{ $error }}
                        @endforeach
                    </span>
                @endif
              {{-- error message End --}}
            </form>
        </div>  

        <div class="card-body">
            <img  src="{{ route('imagecache', ['template' => 'ppsm', 'filename' => $image->fi()]) }}" alt="Product Image">
        </div>
        
    </div>

    </section>
    <!-- /.content -->

@endsection




