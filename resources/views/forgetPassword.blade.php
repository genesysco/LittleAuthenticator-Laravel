@extends('layouts.basic')
@section('title', 'Send verfication code')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-10 col-md-8 col-lg-5 mx-auto border rounded-3 mt-5 px-0">
				<p class="bg-dark text-white rounded-top p-3">
					Send verfication code
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
				<form action="{{route('sendVerfication')}}" method="POST" class="py-3 px-2 mx-3">
					@csrf
					<div class="form-floating mb-3">
					  <input type="email" class="form-control" placeholder="Email" name="email" required>
					  <label for="floatingEmail">Email</label>
					</div>
					@error('email')
						<div class="alert alert-danger">
							{{$message}}
						</div>
					@enderror
					<input type="submit" class="btn btn-outline-warning" value="Send verfication code to Email !">
				</form>
			</div>
		</div>
	</div>
@endsection