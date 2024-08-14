@extends('layouts.basic')
@section('title', 'Change Password')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-10 col-md-8 col-lg-5 mx-auto border rounded-3 mt-5 px-0">
				<p class="bg-dark text-white rounded-top p-3">
					Change Your Password
				</p>
				@if(session()->has('error'))
					<div class="alert alert-danger mx-3">
						{{session('error')}}
					</div>
				@endif
				<form action="{{route('changedPassword')}}" method="POST" class="py-3 px-2 mx-3">
					@csrf
					
					<input type="hidden" name="token" value="{{$token}}">

					<div class="form-floating mb-3">
					  <input type="password" class="form-control @error('password') {{'border-danger'}} @enderror" placeholder="Password" name="password" required>
					  <label for="floatingPassword">Password</label>
					</div>
					@error('password')
						<div class="alert alert-danger">
							{{$message}}
						</div>
					@enderror

					<div class="form-floating mb-3">
					  <input type="password" class="form-control" placeholder="Password Again" name="password_confirmation" required>
					  <label for="floatingPassword">Re-enter Password</label>
					</div>

					<input type="submit" class="btn btn-outline-success me-2" value="Change Password">
				</form>
			</div>
		</div>
	</div>
@endsection