@extends('layouts.basic')
@section('title', 'Admin Panel')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-8 mt-5 mx-auto">
				<a href="{{route('loggedIn')}}" class="btn btn-outline-warning mb-3">
					Home <i class="bi bi-house-door-fill"></i> Page
				</a>

				<table class="table table-dark table-hover table-bordered text-center">
					<thead>
						<tr>
							<th>Id</th>
							<th>Username</th>
							<th>Email</th>
							<th>Confirmed ?</th>
							<th>Is Admin?</th>
							<th>Operations</th>
						</tr>
					</thead>
					<tbody  class="table-group-divider">
						@foreach($users as $user)
							<tr>
								<td>{{$user->id}}</td>
								<td>{{$user->userName}}</td>
								<td>{{$user->email}}</td>
								<td class="{{$user->userName}}">{{$user->confirmed}}</td>
								<td>{{$user->isAdmin}}</td>
								<td>
									@if(!$user->isAdmin)
										<button class="btn btn-danger remover" data-user="{{$user->userName}}">
											Delete <i class="bi bi-exclamation-triangle text-warning"></i>
										</button>
									@endif
									@if($user->confirmed == 0)
										<button class="btn btn-success promoter" data-user="{{$user->userName}}">
											Promote
										</button>
									@elseif($user->confirmed >= 1)
										<button class="btn btn-outline-danger deposer" data-user="{{$user->userName}}">
											Deposal
										</button>
									@endif
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				{{$users->links()}}
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script>
		$(document).ready(function(){
			$('.promoter').click(function(){
				username = $(this).attr('data-user');
				thisPromoter = $(this);
				promoter(username, thisPromoter);
			});

			$('.deposer').click(function(){
				username = $(this).attr('data-user');
				thisDeposer = $(this);
				deposer(username, thisDeposer);
			});

			$('.remover').click(function() {
				thisRemover = $(this);
				username = $(this).attr('data-user');
				remover(thisRemover, username);
			})
		});

		function promoter(username, thisPromoter)
		{
			url = '/promoter/' + username;
			confirmed = confirm('Are you sure want to Promote user ' + username + ' ?');
			if(confirmed)
			{
				$.get(url, {}, function(data){
					if(data)
					{
						thisPromoter.removeClass('btn-success').addClass('btn-outline-danger');
						thisPromoter.removeClass('promoter').addClass('deposer');
						thisPromoter.text('Deposal');
						$('.' + username).text(1);
						alert("User " + username + " has Promoted !");
					}
					else
					{
						alert('Promotion is not Done!');
					}
				});
			}
		}

		function deposer(username,thisDeposer)
		{
			url = '/deposer/' + username;
			confirmed = confirm('Are you sure want to Depose user ' + username + ' ?');
			if(confirmed)
			{
				$.get(url, {}, function(data){
					if(data)
					{
						thisDeposer.removeClass('btn-outline-danger').addClass('btn-success');
						thisDeposer.removeClass('deposer').addClass('promoter');
						thisDeposer.text('Promote');
						$('.' + username).text(0);
						alert("User " + username + " has Deposed !");
					}
					else
					{
						alert('Depose is not Done!');
					}
				});
			}
		}


		function remover(thisRemover, username)
		{
			confirmed = confirm("Are you sure want to delete user " + username + " ???");
			if(confirmed)
			{
				url = "/deleteUser/" + username;
				$.get(url, {}, function(data){
					if(data)
					{
						alert("User " + username + " has been deleted Successfully !");
						thisRemover.parent().parent().remove();
					}
					else
					{
						alert("User " + username + " has not deleted !");
					}
				});
			}
		}
	</script>
@endsection