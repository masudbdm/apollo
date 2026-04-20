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
            <h1>User Create</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">User Create</li>
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
            <h4 class="card-title">Create New User</h4>
            <div class="card-tools">
                <a class="btn btn-primary btn-xs" href="{{ route('admin.usersAll') }}"> Back</a>
            </div>
        </div>
        <form action="{{ route('admin.userStore')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
            <div class="card-body">
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" value="{{ old('name')}}">
                    @error('name')
                        <span style="color:red">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group col-md-6">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username" value="{{ old('username')}}">
                     @error('username')
                        <span style="color:red">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" value="{{ old('email')}}">
                     @error('email')
                        <span style="color:red">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group col-md-6">
                    <label for="mobile">Mobile</label>
                    <input type="text" name="mobile" class="form-control" id="mobile" placeholder="Enter Mobile" value="{{ old('mobile')}}">
                  </div>

                   <div class="form-group col-md-6">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password" value="{{ old('password')}}">
                     @error('password')
                        <span style="color:red">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group col-md-6">
                    <label for="image">Image</label>
                    <div class="input-group">
                         <input type="file" name="image">
                    </div>
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
