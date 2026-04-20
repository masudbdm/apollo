@extends('admin::layouts.adminMaster')
@section('title')
    | Products Edit
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product Edit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Product Edit</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card ">
          <div class="card-header bg-info">
              <h4 class="card-title">Edit Product</h4>
            <div class="card-tools">
                <a class="btn btn-primary btn-xs" href="{{ route('admin.productsAll') }}"> Back</a>
            </div>
          </div>

          <form action="{{ route('admin.productUpdate',$product->id)}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="card-body" style="background-color: rgba(128, 128, 128, 0.37)">
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-sm-7">
                        <div class="card card-default" style="margin-bottom: 5px;">
                            <div class="card-body">
                                  <div class="form-group">
                                      <label for="name">Product Name</label>
                                    <input type="text" name="name" value="{{old('name') ? : $product->name }}" class="form-control" placeholder="Enter name">
                                      @error('name')
                                      <span style="color:red">{{ $message }}</span>
                                      @enderror
                                  </div>

                                  <div class="form-group">
                                    <label for="price">Product Price</label>
                                    <input type="number" name="price" value="{{old('price') ? : $product->price}}" class="form-control" placeholder="Enter price">
                                      @error('price')
                                      <span style="color:red">{{ $message }}</span>
                                      @enderror
                                  </div>

                                  <div class="form-group">
                                    <label for="">Excerpt</label>
                                    <textarea name="excerpt" id="excerpt" class="form-control" rows="3" placeholder="Enter Excerpt">{{old('excerpt') ? : $product->excerpt }}</textarea>
                                  </div>

                                   <div class="form-group">
                                            <label for="">Description</label>
                                            <textarea name="description"
                                            @if($product->editor)
                                                id="summernote"
                                                @else
                                                id="summernote-"
                                                @endif
                                                class="form-control" rows="5">{{ $product->description }}</textarea>
                                    </div>


                

                                <div class="form-group">
                                  <label class="mr-3"><input type="checkbox"  name="active" value="1" {{ $product->active == 1 ? 'checked' : '' }}> Active</label>
                                </div>

                                <div class="form-group">
                                  <div class="checkbox">
                                  <label>
                                      <input type="checkbox"  name="editor" value="1" {{ $product->editor == 1 ? 'checked' : '' }}> Editor
                                      </label>
                                  </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="card card-default" style="margin-bottom: 20px;">
                            <div class="card-header">
                                <h3 class="card-title">Add Featured Image</h3>
                            </div>
                              <div class="card-body">
                                <div class="form-group row">
                                    <label for="feature_image" class="col-sm-4 col-form-label">Featured Image</label>
                                    <div class="col-sm-6">
                                        <input type="file" class="form-control-file" id="feature_image" name="featured_image">
                                    </div>
                                     <br>
                                    <img  src="{{ route('imagecache', ['template' => 'ppsm', 'filename' => $product->fi()]) }}" alt="Category Image">
                                </div>
                            </div>
                        </div>

                        {{-- <div class="card card-widget" style="margin-bottom: 5px; max-height:600px;">
                            <div class="card-header">
                                <h3 class="card-title mt-2">Media Gallery</h3>

                                <div class="card-tools">
                                    <a href="{{ route('medias.index') }}" class="btn btn-secondary mr-2"><i class="fa fa-image mr-2"></i>Upload Image</a>
                                </div>
                            </div>
                            <div class="card-body showMedia" style="height: 400px; overflow: scroll">
                                <div class="p-3" style="background-color: rgba(128, 128, 128, 0.37)">
                                @foreach ($medias as $media)
                                <div class="card card-default" style="margin-bottom: 5px;">
                                        <div class="card-body">
                                            <div class="media">
                                                <div class="w3-display-container">
                                                    <img src="{{ route('imagecache', ['template' => 'original', 'filename' => $media->file_name]) }}" alt="John Doe" class="mr-1 rounded" style="width:100px;">
                                                </div>
                                                <div class="media-body" style=" word-wrap: break-word;word-break: break-all;">
                                                    <p>
                                                        Orig.Name: {{ $media->file_name }} <br>
                                                        Size: {{ $media->size }},
                                                        Width: {{ $media->width }}px,
                                                        Height: {{ $media->height }}px <br>
                                                        <small>
                                                              {{ asset('/storage/media_images/'.$media->file_name) }}
                                                        </small>
                                                        <br>
                                                        <button class="copyboard btn btn-primary btn-xs" data-text="{{ asset('/storage/media_images/'.$media->file_name) }}">Copy URL</button>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div> --}}
                        @includeIf('media::admin.medias.mediaContainer')

                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-7">
                        <div class="card card-default" style="margin-bottom: 20px;">
                            <div class="card-header">
                                <h3 class="card-title">Product Files</h3>
                            </div>
                              <div class="card-body">
                                <div class="form-group">
                                    <label for="Post_files">Product Files</label>
                                    <input type="file" name="product_files[]" multiple>
                                </div>

                                  @if ($product->files)
                                <ol>
                                    @foreach ($product->files as $file)
                                        <li>
                                            <a href="{{ asset('storage/product_files/' . $file->file_name) }}"
                                                download>{{ $file->file_original_name }}

                                            </a> &nbsp;
                                            <a href="{{ route('admin.productFileDelete',$file->id)}}" class="fas fa-trash text-danger" onclick="return confirm('Do you really want to delete?');" >
                                            </a>
                                            </li>
                                            {{-- {{ route('postFileDelete',$file->id) }} --}}
                                    @endforeach

                                </ol>
                               @endif
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-default" style="margin-bottom: 5px;">

                            <div class="card-header">
                                <h3 class="card-title">Add Category & SubCategory</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    @foreach ($categories as $cat)
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="form-check">
                                            <input class="form-check-input" type="checkbox" data-id="{{ $cat->id }}" id="cat-{{ $cat->id }}" name="categories[]" value="{{ $cat->id }}"
                                             {{ in_array($cat->id,$product->productCategories()->pluck('product_category_id')->toArray()) ? 'checked': " "}}>
                                            <label class="form-check-label" for="cat-{{ $cat->id }}">{{ $cat->name }}</label>
                                            </div>
                                            @foreach($cat->productSubcategories as $subcat)
                                            <div class="form-check">
                                                &nbsp;&nbsp;&nbsp;<input class="form-check-input" type="checkbox" data-category-id="{{ $cat->id }}" id="subcat-{{ $subcat->id }}" name="subcategories[]" value="{{ $subcat->id }}"
                                                 {{ in_array($subcat->id,$product->productSubcategories()->pluck('product_subcategory_id')->toArray()) ? 'checked' : " "}}>
                                                <label class="form-check-label" for="subcat-{{ $subcat->id }}">{{ $subcat->name }}</label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endforeach
                                  </div>
                            </div>
                        </div>
                    </div>

                </div>


              </div>

              <div class="card-footer text-right">
                    <input type="submit" class="btn btn-primary" value="Save">
              </div>

          </form>
      </div>

    </section>
    <!-- /.content -->

@endsection


