@extends('admin::layouts.adminMaster')
@section('title')
    | Product Category Edit
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product Category Edit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Product Category Edit</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header bg-info">
            <h4 class="card-title">Edit Product Category</h4>
            <div class="card-tools">
                <a class="btn btn-primary btn-xs" href="{{ route('admin.productCategoriesAll') }}"> Back</a>
            </div>
        </div>
        <form action="{{ route('admin.productCategoryUpdate',$category->id)}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
            <div class="card-body">
                  <div class="form-group">
                    <label for="name">Category name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter Category name" value="{{ old('name') ? : $category->name }}">
                     @error('name')
                        <span style="color:red">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="">Excerpt</label>
                    <textarea name="excerpt" id="excerpt" class="form-control" rows="3" placeholder="Enter Excerpt">{{old('excerpt')? : $category->excerpt }}</textarea>
                  </div>

                   <div class="form-group">
                    <label for="image">Category Image</label>
                    <div class="input-group">
                         <input type="file" name="image">
                    </div>
                    <br>
                    <img  src="{{ route('imagecache', ['template' => 'ppsm', 'filename' => $category->fi()]) }}" alt="Category Image">
                  </div>


                  <div class="form-group">
                    <div class="checkbox">
                    <label><input type="checkbox"  name="active" value="1" {{  $category->active == 1 ? 'checked' : '' }}> Active</label>
                  </div>
                  </div>

            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
          </div>

        </form>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->

@endsection



@push('js')
    <script>
        
    </script>
@endpush
