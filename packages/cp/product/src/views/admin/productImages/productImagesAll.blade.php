@extends('admin::layouts.adminMaster')
@section('title')
    |  All Product Images
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Product Images</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">All Product Images</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card shadow">
        <div class="card-body bg-info">
           All Product Images
        </div>
    </div>
   

    

      <div class="card card-widget">
        <div class="card-header text-center">
            <form class="form-inline" method="post" action="{{ route('admin.productImageStore')}}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="form-group {{ $errors->has('product_images') ? ' has-error' : '' }}">
                    <label for="product_images">Product Images:</label>
                    <input type="file" name="product_images[]"  class="form-control ml-1" id="product_images" style="padding-bottom: 32px;" multiple>  
                </div>
                <button type="submit" class="w3-btn w3-blue w3-round w3-border w3-border-white ml-1">Add Image</button>
               {{-- error message start --}}
               &nbsp;&nbsp;&nbsp;
                @if($errors->has('product_images'))
                  <span style="color:red">
                    <strong>{{ $errors->first('product_images') }}</strong>
                  </span>
                @endif
              {{-- error message End --}}
                

            </form>
        </div>
        <div class="card-body" style="background-color: rgba(128, 128, 128, 0.37)">

           @if($product->productImages()->count() > 0)
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-12">
                      <table class="table table-bordered">
                            <tr>
                              <th style="width:30px;">Sl</th>
                                <th style="width:100px;">Action</th>
                              <th>Image Name</th>
                              <th>Status</th>
                            </tr>

                            <tbody>
                              @foreach ($product->productImages as $image)
                                <tr>
                                    <td style="width:30px;">{{ $loop->iteration }}</td>
                                    <td style="width:100px;">
                                    <div class="dropdown show">
                                        <a class="btn btn-primary btn-xs dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Action
                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                                            <a href="{{ route('admin.productImageEdit',$image->id)}}" class="dropdown-item">
                                            <i class="fa fa-edit"></i> Edit
                                            </a>

                                            <a href="{{ route('admin.productImageDelete',$image->id)}}" class="dropdown-item" onclick="return confirm('Do you really want to delete?');">
                                              <i class="fa fa-trash"></i> Delete
                                            </a>


                                          </div>
                                      </div>
                                    </td>
                                    <td>
                                        <img  src="{{ route('imagecache', ['template' => 'ppsm', 'filename' => $image->fi()]) }}" alt="Product Image">
                                    </td>

                                    <td>
                                        <input type="checkbox" name="toogle" data-url="{{route('admin.productImageActive')}}" value="{{$image->id}}" data-toggle="toggle" data-size="sm" {{$image->active==1 ? 'checked' : '' }} data-on="On"  data-off="Off" data-onstyle="success" data-offstyle="danger">
                                    </td>
                                </tr>
                              @endforeach
                            </tbody>
                      </table>
                  </div>
                </div>
              </div>
            </div>
          @endif
           
        </div>
    </div>

    </section>
    <!-- /.content -->

@endsection

@push('js')
    <script>
        $( document ).ready(function() {
            $('input[name=toogle]').change(function(){
                var that = $( this );
                var url  = that.attr('data-url');
                var id   = that.val()
                var mode = that.prop('checked');
                $.ajax({
                    url : url,
                    type: "POST",
                    data:{
                        _token:'{{csrf_token()}}',
                        mode:mode,
                        id:id,
                    },
                    success:function(response){
                        if(response.status){
                            alert(response.msg);
                        }
                        else{
                            alert('please try again');
                        }
                    }
                })
            });
        });


    </script>
@endpush



