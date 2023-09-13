@extends('layouts.backend')
@section('content')

@if(session('success'))

  <div class="alert alert-success" id="successMessage">
    {{session('success')}}
  </div>
@endif

@if(session('failed'))
<div class="alert alert-danger" id="failedMessage">
  {{session('failed')}}
</div>
@endif
<script>

  setTimeout(
    function(){
      $("#successMessage").delay(3000).fadeOut('fast');
    },1000
  );
  
  setTimeout(
    function(){
      $("#failedMessage").delay(3000).fadeOut('fast');
    },1000

  );
</script>

<div class="row">
          <div class="col-md-12">
            <div class="card card-primary collapsed-card">
              <div class="card-header">
                <h3 class="card-title">TRAINERS</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <div class="row">
                      <div class="col-12">
                          <div class="card">
                              <div class="card-header">
                                  @if(!empty($total))
                                  <h3>{{$total}}Records</h3>
                                  @else
                                  <h3>No Records</h3>
                                  @endif
                                  
                                  
                                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                                    <i class="fa fa-plus"></i>Add
                                  </button>
                                  
                              </div>

                              <!--CARD HEADER-->
                              <div class="card-body table-responsive p-0">
                                  <table class="table table-hover text-nowrap">
                                      <thead>
                                          <tr>
                                              <th>ID</th>
                                              <th>Name</th>
                                              <th>Email</th>
                                              <th>Phone Number</th>
                                              <th>Action</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($images as $image)
                                          
                                          <tr>
                                              <td>{{$image->id}}</td>
                                              <td>{{$image->name}}</td>
                                              <td>{{$image->email}}</td>
                                              <td>{{$image->phone}}</td>
                                              <td>
                                                  <img src="{{asset('images/'.$image->image)}}" class="img-circle" style="width:40px; height:30px">
                                              </td>
                                              <td>
                                                  <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#editModal{{$image->id}}">
                                                      <i class="fa fa-edit"></i>Edit
                                                  </button>
                                                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{$image->id}}">
                                                      <i class="fa fa-trash"></i>Delete
                                                  </button>
                                              </td>
                                          </tr>

                                          

                                          <!--EDIT MODAL-->
                                          <div class="modal fade" id="editModal{{$image->id}}">
                                              <div class="modal-dialog">
                                                  <div class="modal-content">
                                                      <div class="modal-header">
                                                          <h4 class="modal-title">Update: {{$image->name}}</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                      </div>

                                                      <form method="POST" action="{{ route('admin.updateTrainers')}}" enctype="multipart/form-data">
                                                          @csrf
                                                          <div class="modal-body">
                                                              <div class="row">
                                                                  <input type="text" name="id" value="{{$image->id}}" hidden="true">
                                                                  <div class="col-md-12">
                                                                      <div class="form-group">
                                                                          <label>Name</label>
                                                                          <input type="text" class="form-control @error('name') is-invalid @enderror " name="name" value="{{$image->name}}">
                                                                          @error('name')
                                                                            <div class="alert alert-danger">{{$message}}</div>
                                                                            @enderror
                                                                      </div>
                                                                  </div>

                                                                  <div class="col-md-12">
                                                                      <div class="form-group">
                                                                          <label>Email</label>
                                                                          <input type="text" class="form-control @error('email') is-invalid @enderror " name="email" value="{{$image->email}}">
                                                                          @error('email')
                                                                        <div class="alert alert-danger">{{$message}}</div>
                                                                        @enderror
                                                                      </div>
                                                                  </div>

                                                                  <div class="col-md-12">
                                                                      <div class="form-group">
                                                                        <label>Phone Number</label>
                                                                    
                                                                        <input type="phone" class="form-control @error('phone') is-invalid @enderror " name="phone" value="{{$image->phone}}">
                                                                        @error('phone')
                                                                        <div class="alert alert-danger">{{$message}}</div>
                                                                        @enderror
                                                                      </div>
                                                                  </div>

                                                                  <div class="col-md-12">
                                                                      <img src="{{asset('images/'.$image->image)}}" width="100px" height="90px">
                                                                  </div>

                                                                  <div class="col-md-12">
                                                                        <label>Image</label>
                                                                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                                                                        @error('image')
                                                                        <div class="alert alert-danger">{{$message}}</div>
                                                                        @enderror
                                                                    </div>
                                                              </div>
                                                          </div>

                                                          <div class="modal-footer justify-content-between">
                                                              <button class="btn btn-danger" data-dismiss="modal">Close</button>
                                                              <button type="submit" class="btn btn-success">Save</button>
                                                          </div>
                                                      </form>
                                                  </div>
                                              </div>
                                          </div>
                                          <!--END OF EDIT MODAL-->

                                          
                                          <!--DELETE MODAL-->
                                          <div class="modal fade" id="deleteModal{{$image->id}}">
                                              <div class="modal-dialog">
                                                  <div class="modal-content">
                                                      <div class="modal-header">
                                                          <h4 class="modal-title">Delete: {{$image->name}}</h4>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                          </button>
                                                      </div>

                                                      <form method="POST" action="{{ route('admin.deleteTrainers') }}">

                                                          @csrf
                                                          <div class="modal-body">
                                                              <div class="row">
                                                              <input type="text" name="id" value="{{$image->id}}" hidden>
                                                                  <div class="col-md-12">
                                                                      <p>Are you sure you want to delete this record ?</p>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                          <div class="modal-footer justify-content-between">
                                                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                              <button type="submit" class="btn btn-success">Delete</button>
                                                          </div>

                                                      </form>
                                                  </div>
                                              </div>
                                          </div>
                                          <!--END OF DELETE MODAL-->

                                        @endforeach
                                          

                                          

                                      </tbody>
                                  </table>
                                  
                                  
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          
          <!--ADD STAFF IMAGES MODAL-->
          <div class="modal fade" id="modal-default">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4 class="modal-title">Add Trainer</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>

                      <form method="POST" action="{{ route('admin.trainers')}}" enctype="multipart/form-data">
                          @csrf
                          <div class="modal-body">
                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <label>Name</label>
                                          <input type="text" class="form-control @error('name') is-invalid @enderror" name="name">
                                          @error('name')
                                          <div class="alert alert-danger">{{$message}}</div>
                                          @enderror

                                      </div>
                                  </div>

                                  <div class="col-md-12">
                                        <label>Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror " name="email" value="">
                                        @error('email')
                                        <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label>Phone Number</label>
                                        <input type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="">
                                        @error('phone')
                                        <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label>Image</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                                        @error('image')
                                        <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                              </div>

                              
                          </div>
                          <div class="modal-footer justify-content-between">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-success">Save</button>
                          </div>
                      </form>


                  </div>
              </div>
          </div>
          <!--END OF ADD STAFF IMAGES MODAL-->
         
         
</div>
<!-- /.row -->


@endsection