@extends('admin::layouts.adminMaster')
@section('title')
    | Product SubCategory Edit
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product SubCategory Edit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Product SubCategory Edit</li>
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
            <h4 class="card-title">Edit SubCategory</h4>
            <div class="card-tools">
                <a class="btn btn-primary btn-xs" href="{{ route('admin.productSubCategoriesAll') }}"> Back</a>
            </div>
        </div>
        <form action="{{ route('admin.productSubCategoryUpdate',$subCategory->id)}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
            <div class="card-body">
                  <div class="form-group">
                    <label for="name">SubCategory name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter SubCategory name" value="{{ old('name') ? : $subCategory->name}}">
                     @error('name')
                        <span style="color:red">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="">Excerpt</label>
                    <textarea name="excerpt" id="excerpt" class="form-control" rows="3" placeholder="Enter Excerpt">{{old('excerpt')? : $subCategory->excerpt }}</textarea>
                  </div>

                   <div class="form-group">
                    <label for="product_category_id">Category Select</label>
                    <select name="product_category_id" id="product_category_id" class="form-control">
                      <option value="">Category Select</option>
                      @foreach($categories as $category)
                           <option value="{{ $category->id }}" {{ $subCategory->product_category_id == $category->id ? "selected" : '' }}>
                            {{$category->name}}</option>
                      @endforeach
                    </select>
                    @error('product_category_id')
                      <span style="color:red">{{ $message }}</span>
                    @enderror
                  </div>



                  <div class="form-group">
                    <label for="image">SubCategory Image</label>
                    <div class="input-group">
                         <input type="file" name="image">
                    </div>
                    <br>
                    <img  src="{{ route('imagecache', ['template' => 'ppsm', 'filename' => $subCategory->fi()]) }}" alt="SubCategory Image">
                  </div>


                  <div class="form-group">
                    <div class="checkbox">
                    <label><input type="checkbox"  name="active" value="1" {{  $subCategory->active == 1 ? 'checked' : '' }}> Active</label>
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
