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
      @php
        $u = auth()->user();
        $canEditProduct = $u && $u->hasAnyPermission(['product-edit']);
      @endphp
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
                                            @if($canEditProduct)
                                              <a href="{{ route('admin.productFileDelete',$file->id)}}" class="fas fa-trash text-danger" onclick="return confirm('Do you really want to delete?');" >
                                              </a>
                                            @endif
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
                    @if($canEditProduct)
                      <input type="submit" class="btn btn-primary" value="Save">
                    @endif
              </div>

          </form>
      </div>

      <div class="card card-outline card-success mt-3">
          <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title mb-0">Extra product images</h3>
              <a href="{{ route('admin.productImagesAll', $product->id) }}" class="btn btn-sm btn-outline-secondary">
                  <i class="fa fa-external-link-alt"></i> Open full images page
              </a>
          </div>
          <div class="card-body" style="background-color: rgba(128, 128, 128, 0.15);">
              <p class="text-muted small mb-3">Gallery images for the product detail page (carousel). Upload one or more files — same as the dedicated images screen.</p>

              @if($canEditProduct)
              <form method="post" action="{{ route('admin.productImageStore') }}" enctype="multipart/form-data" class="mb-4">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $product->id }}">
                  <div class="form-row align-items-end">
                      <div class="form-group col-md-8 mb-2 mb-md-0">
                          <label for="product_images_edit">Add images</label>
                          <input type="file" name="product_images[]" id="product_images_edit" class="form-control-file" multiple accept="image/*">
                          @if($errors->has('product_images'))
                              <span class="text-danger d-block"><strong>{{ $errors->first('product_images') }}</strong></span>
                          @endif
                      </div>
                      <div class="form-group col-md-4 mb-0">
                          <button type="submit" class="btn btn-success"><i class="fa fa-upload"></i> Upload</button>
                      </div>
                  </div>
              </form>
              @endif

              @if($product->productImages->count() > 0)
                  <div class="table-responsive">
                      <table class="table table-bordered table-sm bg-white mb-0">
                          <thead class="thead-light">
                              <tr>
                                  <th style="width:40px;">#</th>
                                  <th>Preview</th>
                                  <th style="width:140px;">Active</th>
                                  <th style="width:160px;" class="text-center">Replace</th>
                                  <th style="width:100px;" class="text-center">Delete</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($product->productImages as $image)
                                  <tr>
                                      <td>{{ $loop->iteration }}</td>
                                      <td>
                                          <img src="{{ route('imagecache', ['template' => 'ppsm', 'filename' => $image->fi()]) }}" alt="" class="img-thumbnail" style="max-height: 80px;">
                                      </td>
                                      <td>
                                          @if($canEditProduct)
                                            <input type="checkbox" name="toogle" data-url="{{ route('admin.productImageActive') }}" value="{{ $image->id }}" data-toggle="toggle" data-size="sm" {{ $image->active == 1 ? 'checked' : '' }} data-on="On" data-off="Off" data-onstyle="success" data-offstyle="danger">
                                          @else
                                            {{ $image->active == 1 ? 'On' : 'Off' }}
                                          @endif
                                      </td>
                                      <td class="text-center">
                                          @if($canEditProduct)
                                            <a href="{{ route('admin.productImageEdit', $image->id) }}" class="btn btn-sm btn-outline-secondary" title="Replace image file">
                                                <i class="fa fa-edit"></i> Replace
                                            </a>
                                          @endif
                                      </td>
                                      <td class="text-center">
                                          @if($canEditProduct)
                                            <a href="{{ route('admin.productImageDelete', $image->id) }}"
                                              class="btn btn-sm btn-danger"
                                              title="Delete this image"
                                              onclick="return confirm('Permanently delete this extra image?');">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                          @endif
                                      </td>
                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
              @else
                  <p class="text-muted mb-0"><em>No extra images yet. Upload above.</em></p>
              @endif
          </div>
      </div>

    </section>
    <!-- /.content -->

@endsection

@push('js')
<script>
    $(document).ready(function () {
        $('input[name=toogle]').change(function () {
            var that = $(this);
            var url = that.attr('data-url');
            var id = that.val();
            var mode = that.prop('checked');
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    mode: mode,
                    id: id,
                },
                success: function (response) {
                    if (response.status) {
                        alert(response.msg);
                    } else {
                        alert('Please try again');
                    }
                }
            });
        });
    });
</script>
@endpush


