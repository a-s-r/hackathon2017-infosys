@extends('layouts.qmlayout')
@section('content')
<div class="col-md-12">
	<div class="card">
		<div class="card-header" data-background-color="purple">
			<h4 class="title">Patient Registration</h4>
			<p class="category">Add Patient Registration</p>
		</div>
		<div class="card-content">
			<form>
				<div class="row">
					<div class="col-md-5">
						<div class="form-group label-floating">
							<label class="control-label">Patient Name</label>
							<input type="text" class="form-control">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group label-floating">
							<label class="control-label">Contact Number</label>
							<input type="text" class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group label-floating">
							<label class="control-label">Email address</label>
							<input type="email" class="form-control">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group label-floating">
							<label class="control-label">Adress</label>
							<input type="text" class="form-control">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group label-floating">
							<label class="control-label">City</label>
							<input type="text" class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group label-floating">
							<label class="control-label">Country</label>
							<input type="text" class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group label-floating">
							<label class="control-label">Postal Code</label>
							<input type="text" class="form-control">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group label-floating">
							<label class="control-label">Department</label>
							<select name="selecteddd" class="form-control">
								<option value=""></otpion>
								<option value="Emergency">Emergency</otpion>
								<option value="Anaesthetics">Anaesthetics</otpion>
								<option value="Cardiology">Cardiology</otpion>
								<option value="Chaplaincy">Chaplaincy</otpion>
								<option value="Critical care">Critical care</otpion>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group label-floating">
							<label class="control-label">Room No</label>
							<select name="selecteddd" class="form-control">
								<option value=""></otpion>
								<option value="Room 1">Room 1</otpion>
								<option value="Room 2">Room 2</otpion>
								<option value="Room 3">Room 3</otpion>
								<option value="Room 4">Room 4</otpion>
								<option value="Room 5">Room 5</otpion>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group label-floating">
							<label class="control-label">Country</label>
							<input type="text" class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group label-floating">
							<label class="control-label">Postal Code</label>
							<input type="text" class="form-control">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>About Me</label>
							<div class="form-group label-floating">
								<label class="control-label"> Lamborghini Mercy, Your chick she so thirsty, I'm in that two seat Lambo.</label>
								<textarea class="form-control" rows="5"></textarea>
							</div>
						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-primary pull-right">Update Profile</button>
				<div class="clearfix"></div>
			</form>
		</div>
	</div>
</div>
@endsection