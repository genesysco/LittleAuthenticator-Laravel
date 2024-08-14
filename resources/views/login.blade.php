@extends('layouts.basic')
@section('title', 'Login Page !')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-10 col-md-8 col-lg-5 mx-auto border rounded-3 mt-5 px-0">
				<p class="bg-dark text-white rounded-top p-3">
					Login
				</p>
				@if(session()->has('success'))
					<div class="alert alert-success mx-4">
						{{session('success')}}
					</div>
				@endif
				@if(session()->has('error'))
					<div class="alert alert-danger mx-4">
						{{session('error')}}
					</div>
				@endif
				@error('userName')
					<div class="alert alert-danger mx-4">
						Wrong credentials !
					</div>
				@enderror
				@error('password')
					<div class="alert alert-danger mx-4">
						Wrong credentials !
					</div>
				@enderror
				<form action="{{route('userHomePage')}}" method="POST" class="py-3 px-2 mx-3">
					@csrf
					
					<div class="form-floating mb-3">
					  <input type="text" class="form-control" placeholder="User Name" name="userName" value="{{old('userName')}}" required>
					  <label for="floatingInput">User Name</label>
					</div>
					<div class="form-floating mb-3">
					  <input type="password" class="form-control" placeholder="Password" name="password" required>
					  <label for="floatingPassword">Password</label>
					</div>
					<input type="submit" class="btn btn-outline-primary me-2" value="Login">
					<a href="{{route('forgetPage')}}">Forget password !</a>
				</form>
				<a href="/" class="btn btn-warning text-white mb-3 ms-4">Home Page !</a>
				<a href="{{route('registerPage')}}" class="btn btn-outline-success mb-3">Sign Up Page</a>
			</div>
		</div>
	</div>
@endsection