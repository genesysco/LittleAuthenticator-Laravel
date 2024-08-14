<p class="bg-dark text-white rounded-top p-3">
	Verification email
</p>
<p class="text-secondary">
	Click on this button to redirect to change password page !
</p>
<a href="{{ route('repairPassword', compact('token')) }}">Reset Password</a>