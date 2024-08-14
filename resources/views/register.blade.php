@extends('layouts.basic')
@section('title', 'Register Page')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-10 col-md-8 col-lg-5 mx-auto border rounded-3 my-5 px-0">
				<p class="bg-dark text-white rounded-top p-3">
					Register Here
				</p>
				@if(session()->has('error'))
					<div class="alert alert-danger">
						{{session('error')}}
					</div>
				@endif
				<form action="{{route('insertUser')}}" method="POST" class="py-3 px-4">
					@csrf
					<div class="form-floating mb-3">
					  <input type="text" class="form-control @error('name') {{ 'border-danger' }} @enderror" placeholder="Name" name="name" value="{{ old('name')}}" required>
					  <p class="text-danger mt-2">
						  @error('name')
						  	{{$message}}
						  @enderror
					  </p>
					  <label for="floatingInput">Name</label>
					</div>

					<div class="form-floating mb-3">
					  <input type="email" id="email" class="form-control @error('email') {{'border-danger'}} @enderror" placeholder="email" name="email" value="{{ old('email')}}" required>
					  <label for="floatingInput">Email</label>
					  <p class="text-danger mt-2 laravelEmail">
						  @error('email')
						  	{{$message}}
						  @enderror
					  </p>
						<i class="bi bi-exclamation-triangle fs-4 text-danger d-none e-ex"></i>
						<div class="spinner-border spinner-border-sm d-none e-spinner" role="status"></div>
						<i class="bi bi-check fs-3 text-success d-none e-check"></i>
					</div>

					<div class="form-floating mb-3">
					  <input type="text" class="form-control @error('userName') {{'border-danger'}} @enderror" placeholder="User Name" id="userName" name="userName" value="{{ old('userName')}}" required>
					  <label for="floatingInput">User Name</label>
					  <p class="text-danger mt-2 laravelUserName">
						  @error('userName')
						  	{{$message}}
						  @enderror
					  </p>
						<i class="bi bi-exclamation-triangle fs-4 text-danger d-none u-ex"></i>
						<div class="spinner-border spinner-border-sm d-none u-spinner" role="status"></div>
						<i class="bi bi-check fs-3 text-success d-none u-check"></i>
					</div>

					<div class="form-floating mb-3">
					  <input type="password" class="form-control @error('password') {{'border-danger'}} @enderror" placeholder="Password" name="password" required>
					  <label for="floatingPassword">Password</label>
					  <p class="text-danger mt-2">
						  @error('password')
						  	{{$message}}
						  @enderror
					  </p>
					</div>

					<div class="form-floating mb-3">
					  <input type="password" class="form-control" placeholder="Password" name="password_confirmation" required>
					  <label for="floatingPassword">Confirm password</label>
					</div>

					<input type="submit" class="btn btn-success" value="Sign Up">
				</form>
				<a href="{{route('loginPage')}}" class="btn btn-outline-primary mb-3 d-inline-block ms-4">Login page</a>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script>
		$(document).ready(function(){
			$("#email").focusout(function(){
				thisEmail = $(this);
				eCheck(thisEmail);
			});

			$("#userName").focusout(function(){
				thisUserName = $(this);
				uCheck(thisUserName);
			});
		});

		function eCheck(thisEmail){
			length = thisEmail.val().length;
			if(length >= 7)
			{
				$('.e-spinner').removeClass('d-none');
				thisEmail.focus(function(){
					$('.e-spinner').addClass('d-none');
					$('.e-ex').addClass('d-none');
					$('.e-check').addClass('d-none');
					thisEmail.removeClass('border-danger');
				});
				email = thisEmail.val();
				url = '/checkEmail/' + email;
				$.get(url, {}, function(data){
					if(data)
					{
						$('.e-spinner').addClass('d-none');
						$('.e-ex').addClass('d-none');
						$('.e-check').removeClass('d-none');
						thisEmail.removeClass('border-danger');
						thisEmail.addClass('border-success');
						$('.laravelEmail').remove();
					}
					else
					{
						$('.e-spinner').addClass('d-none');
						$('.e-ex').removeClass('d-none');
						thisEmail.addClass('border-danger');
					}
				});
			}
		}



		function uCheck(thisUserName) {
			length = thisUserName.val().length;
			if(length >= 3)
			{
				$('.u-spinner').removeClass('d-none');
				thisUserName.focus(function(){
					$('.u-spinner').addClass('d-none');
					$('.u-ex').addClass('d-none');
					$('.u-check').addClass('d-none');
					thisUserName.removeClass('border-danger');
				});
				username = thisUserName.val();
				url = '/checkUserName/' + username;
				$.get(url, {}, function(data){
					if(data)
					{
						$('.u-spinner').addClass('d-none');
						$('.u-ex').addClass('d-none');
						$('.u-check').removeClass('d-none');
						thisUserName.removeClass('border-danger');
						thisUserName.addClass('border-success');
						$('.laravelUserName').remove();
					}
					else
					{
						$('.u-spinner').addClass('d-none');
						$('.u-ex').removeClass('d-none');
						thisUserName.addClass('border-danger');
					}
				});
			}
		}
	</script>
@endsection