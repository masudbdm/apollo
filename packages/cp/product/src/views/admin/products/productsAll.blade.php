@extends('admin::layouts.adminMaster')
@section('title')
    | Products All
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Products All</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Products All</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      @php
        $u = auth()->user();
        $canCreate = $u && $u->hasAnyPermission(['product-create']);
        $canShow = $u && $u->hasAnyPermission(['product-show']);
        $canEdit = $u && $u->hasAnyPermission(['product-edit']);
        $canDelete = $u && $u->hasAnyPermission(['product-delete']);
      @endphp

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Products</h3>

          <div class="card-tools">

             @if($canCreate)
               <a class="btn btn-primary btn-xs" href="{{ route('admin.productCreate') }}"> Create New Product</a>
             @endif

            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
      
          </div>
        </div>
        <div class="card-body">
           <div class="table-responsive">
               <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th style="width: 10px">#SL</th>
                    <th>Action</th>
                    <th>Name</th>
                    <th>Categories</th>
                    <th>Price</th>
                    <th>Except</th>
                    <th>Image</th>
                    <th>Active</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = (($products->currentPage() - 1) * $products->perPage() + 1); ?>
                  @foreach($products as $product)
                  <tr>
                    <td style="width: 10px">{{$i++}}</td>
                    <td style="width: 80px">
                      <div class="dropdown show">
                          <a class="btn btn-primary btn-xs dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                          </a>

                          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                              @if($canEdit)
                                <a  href="{{ route('admin.productImagesAll',$product->id)}}" class="dropdown-item"><i class="fas fa-images"></i> Add Images</a>
                              @endif
                              
                              @if($canEdit)
                                <a href="{{ route("admin.productEdit",$product->id)}}" class="dropdown-item"><i class="fa fa-edit"></i> Edit</a>
                              @endif

                              @if($canShow)
                                <a href="{{ route("admin.productShow",$product->id)}}" class="dropdown-item"><i class="fa fa-eye"></i> Details</a>
                              @endif


                              @if($canDelete)
                                <form action="{{route('admin.productDelete',$product->id)}}" method="post" onclick="return confirm('Are you sure to delete?')">
                                  @csrf
                                  <button type="submit" class="dropdown-item"><i class="fa fa-trash"></i> Delete</button>
                                </form>
                              @endif
                            </div>
                        </div>
                    </td>
                    <td>{{$product->name}}</td>
                    <td>{{ $product->productCategories->pluck('name')->implode(', ') ?: '-' }}</td>
                    <td>{{$product->price}}</td>
                    <td>{{ Str::limit($product->excerpt, 70) }}</td>
                    <td>
                        <img  src="{{ route('imagecache', ['template' => 'ppsm', 'filename' => $product->fi()]) }}" alt="Product">
                    </td>

                    <td>
                        @if($canEdit)
                          <input type="checkbox" name="toogle" data-url="{{route('admin.productActive')}}" value="{{$product->id}}" data-toggle="toggle" data-size="sm" {{$product->active==1 ? 'checked' : '' }} data-on="On"  data-off="Off" data-onstyle="success" data-offstyle="danger">
                        @else
                          {{ $product->active == 1 ? 'On' : 'Off' }}
                        @endif
                    </td>
                  </tr>  
                  @endforeach
                </tbody>
              </table>
           </div>
        </div>
        <div class="card-footer">
            {{ $products->render() }}
        </div>
      </div>
    </section>
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
