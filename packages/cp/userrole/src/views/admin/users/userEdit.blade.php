@extends('admin::layouts.adminMaster')
@section('title')
    | Users All
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Edit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">User Edit</li>
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
            <h4 class="card-title">Edit User</h4>
            <div class="card-tools">
                <a class="btn btn-primary btn-xs" href="{{ route('admin.usersAll') }}"> Back</a>
            </div>
        </div>
        <form action="{{ route('admin.userUpdate',$user->id)}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
            <div class="card-body">
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" value="{{ old('name') ? : $user->name }}">
                    @error('name')
                        <span style="color:red">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group col-md-6">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username" value="{{ old('username') ? : $user->username}}">
                     @error('username')
                        <span style="color:red">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" value="{{ old('email') ? : $user->email}}">
                     @error('email')
                        <span style="color:red">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group col-md-6">
                    <label for="mobile">Mobile</label>
                    <input type="text" name="mobile" class="form-control" id="mobile" placeholder="Enter Mobile" value="{{ old('mobile') ? : $user->mobile}}">
                  </div>

                  

                  <div class="form-group col-md-6">
                    <label for="image">Image</label>
                    <div class="input-group">
                         <input type="file" name="image">
                    </div>
                    <br>
                    <img  src="{{ route('imagecache', ['template' => 'ppsm', 'filename' => $user->fi()]) }}" alt="post">
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
