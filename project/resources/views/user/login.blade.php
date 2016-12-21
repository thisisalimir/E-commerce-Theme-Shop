@extends('layouts.master')

@section('content')
<div class="row">
     <div class="col-md-4 col-md-offset-4">
        <h1>LogIn</h1>
        @if(count($errors) > 0)
        <div class="alert alert-danger">
          @foreach($errors->all() as  $error)
           <p>{{$error}}</p><br>
           @endforeach
        </div>
        @endif
          <form action="{{route('user.login')}}" method="post">
             <div class="form-group">
                <label for="email">E-Mail</label>
                <input class="form-control" type="text" name="email" id="email" value="">
             </div><br>
              <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" id="password" value="">
              </div>
               <button type="submit" class="btn btn-primary">LogIn</button>
               {{csrf_field()}}
          </form>
     </div>
</div>
@stop
