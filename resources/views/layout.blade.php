<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Anh Tuan's App</title>
      <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> -->
      <!-- This is to add jQuery -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
      <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <meta name="csrf-token" content="{{ csrf_token() }}">
   </head>
   <body>
         <!-- Modal to show live form to add works -->
         <div class="modal fade" id="myModal">
            <div class="modal-dialog">
               <div class="modal-content">
               
               <!-- Modal Header -->
               <div class="modal-header">
                  <h4 class="modal-title">Add your work directly</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               
               <!-- Modal body -->
               <div class="modal-body">

               <!-- Throw errors if any field is ivalid -->
               <div class="alert alert-danger">
               
               </div><br />

               <!-- Add information about your work -->
               <form method="post" action="{{ route('works.store') }}" enctype="multipart/form-data">
                  <div class="card-header">
                     Work 1
                  </div>
                  <div class="form-group">
                        @csrf
                        <label for="title[]">Title</label>
                        <input type="text" class="form-control" name="title[]" placeholder="describe your task"/>
                  </div>
                  <div class="form-group">
                        <label for="image[]">Upload your image</label>
                        <input type="file" class="form-control" name="image[]"/>
                  </div>
                  <div class="form-group">
                        <label for="collaborator[]">Collaborator</label>
                        <input type="text" class="form-control" name="collaborator[]" value="default"/>
                  </div>
                  <div class="form-group">
                        <label for="deadline[]">Deadline</label>
                        <input type="text" class="form-control" name="deadline[]" placeholder="dd-mm-yyyy"/>
                  </div>
                  <div class="form-group">
                        <label for="workdone[]">Work done (%)</label>
                        <input type="number" class="form-control" name="workdone[]" placeholder="amount of work done"/>
                  </div>
               <button type="submit" class="btn btn-block btn-danger">Submit</button>
               </form>

               <!-- <button id = "btn1" class="btn btn-primary btn-sm" style="text-align:right;">Add another work!!</button> -->
               </div>
               
               <!-- Modal footer -->
               <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
               </div>
               
               </div>
            </div>
         </div>

      <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
      <ul class="navbar-nav">
         <li class="nav-item active">
            <a class="nav-link" href="{{ route('works.index')}}">Home</a>
         </li>
         <li class="nav-item active">
            <a class="nav-link" href="{{ route('works.create')}}">Add Work</a>
         </li>
         <li class="nav-item active">
            <a class="nav-link" href="{{ route('livesearch') }}">Go to Live Search</a>
         </li>
         <li class="nav-item active">
            <a href="#" class="nav-link" data-toggle="modal" data-target="#myModal">Live add works</a>
         </li>
         <li style="nav-item active">
            <form class="form-inline my-2 my-lg-0" action="{{ route('search')}}" method="get">
                  @csrf
                  <input class="form-control" type="text" name="search" maxlength="100" style="width:60%" placeholder="Search any thing..." required/>
                  <button class="btn btn-success" type="submit">Search</button>
            </form>
         </li>
      </ul>
      </nav>



      @if(session()->get('email')=="")
      <div style="margin:10px;text-align:right;">
      <a href="{{ route('logins')}}" class="btn btn-primary btn-sm"">Login</a>
      <a href="{{ route('signup')}}" class="btn btn-primary btn-sm"" style="display: inline-block">Signup</a>
      </div>
      @endif

      @if(!(session()->get('email')==""))
      <div style="margin:10px;text-align:right;">
      <p><strong>Welcome</strong> <i>{{ session()->get('email') }}</i></p>
      <a href="{{ route('logout') }}" class="btn btn-primary btn-sm"" style="display: inline-block">Logout</a>
      </div>
      @endif
      

      <div class="container-fluid">
         @yield('content')
      </div>


      <!-- Add javascript -->
      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" type="text/js"></script>
   </body>
</html>
