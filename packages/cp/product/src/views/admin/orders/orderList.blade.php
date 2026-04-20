@extends('admin::layouts.adminMaster')
@section('title')
    | Order List
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Order List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Order List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">orders</h3>

          <div class="card-tools">

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
                      <th>Id</th>
                      <th>Date</th>
                      <th>Order Status</th>
                      <th>Amount</th>
                      <th>Payment Status</th>
                      <th>Product Items</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = (($orders->currentPage() - 1) * $orders->perPage() + 1); ?>
                    @foreach($orders as $order)
                    <tr>
                      <td style="width: 10px">{{$i++}}</td>
                      <td style="width: 80px">
                          <div class="dropdown show">
                            <a class="btn btn-primary btn-xs dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Action
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a href="{{ route('admin.orderDeatils',$order->id)}}" class="dropdown-item"><i class="fa fa-eye"></i> Details</a>

                                <form action="{{ route('admin.orderDelete',$order->id)}}" method="post" onclick="return confirm('Are you sure to delete?')">
                                  @csrf
                                  <button type="submit" class="dropdown-item"><i class="fa fa-trash"></i> Delete</button>
                                </form>
                            </div>
                      </td>
                      <td>{{$order->id}}</td>
                      <td>{{$order->created_at->format('d/m/Y')}}</td>
                      <td>{{$order->order_status}}</td>
                      <td>{{$order->total_amount}}</td>
                      <td>{{$order->payment_status}}</td>
                      <td>{{$order->orderItems()->count()}}</td>
                    </tr>  
                    @endforeach
                  </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{ $orders->render()}}
        </div>
      </div>
    </section>
@endsection




