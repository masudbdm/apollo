@extends('admin::layouts.adminMaster')
@section('title')
    | Asign Role
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Asign Role</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Asign Role</li>
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
            <h4 class="card-title">Asign Role</h4>
            <div class="card-tools">
                <a class="btn btn-primary btn-xs" href="{{ route('admin.usersAll') }}"> Back</a>
            </div>
        </div>
        <form action="{{ route('admin.assignRoleStore')}}" method="post">
          @csrf
          <div class="card-body">
            <div class="card-body">
                <div class="row">
                  <div class="form-group col-md-6">
                        <label for="user_id">User Name
                        </label>
                        <select class="form-control" name="user_id" id="select2">
                            <option value="">Choose Name</option>  
                            @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') ==  $user->id ? 'selected' : ' '}}>
                              {{ $user->name }}, {{ $user->email }} </option>  
                            @endforeach
                        </select>   

                        @error('user_id')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                
                  <div class="form-group col-md-6">
                      <label for="role">Role Name
                      </label>
                      <select name="role_id" id="role_id" class="form-control">
                         <option value="">Choose Role</option>
                         @foreach($roles as $role)
                          <option value="{{ $role->name }}"{{ old('role')==  $role->name ? 'selected' : ' '}}>
                            {{ $role->name }}
                           </option>
                         @endforeach
                      </select>
                      @error('role')
                      <span style="color: red">{{ $message }}</span>
                      @enderror
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
