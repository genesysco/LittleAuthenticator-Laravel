@extends('layouts.basic')
@section('title','User Home page !')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-12 mt-5 text-center">
				<h2>
					You have Logged in !)
				</h2>
				<p class="text-warning mt-3">
					Congratulations 
					@can('confirmed')
						{{"and You're confirmed by admin "}}
					@endcan
					!
				</p>
				@can('isAdmin')
					<p class="my-3 h3">You're Admin !</p>
					<a href="{{route('adminPanel')}}" class="btn btn-dark">Admin Control Panel</a>
				@endcan
				@can(!'isAdmin')
					<p class="text-secondary mt-5 h3">
						User's Home Page !
					</p>
				@endcan
				<a href="{{route('logOut')}}" class="btn btn-outline-danger">
					Log Out !
				</a>
			</div>
		</div>
	</div>
@endsection