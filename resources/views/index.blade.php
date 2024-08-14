@extends('layouts.basic')
@section('title','Home')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-12 mt-5 text-center">
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
				@guest
					<a href="{{route('loginPage')}}" class="btn btn-outline-primary">Login</a> Or
					<a href="{{route('registerPage')}}" class="btn btn-success">Sign Up</a>
				@endguest
				@auth
					<a href="{{route('logOut')}}" class="btn btn-outline-danger">
						Log Out !
					</a>
					Or
					<a href="{{route('loggedIn')}}" class="btn btn-outline-success">
						User's Home Page
					</a>
				@endauth
			</div>
		</div>
	</div>
@endsection