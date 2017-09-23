@extends('layouts.qmlayout')
@section('content')
<div class="col-md-12">
	<div class="card">
		<div class="card-header" data-background-color="purple">
			<h4 class="title">Patient Registration</h4>
			<p class="category">Add Patient Registration</p>
		</div>
		<div class="card-content">
			<form name="addPatientForm" method="post" action="/manage-patient/save">
				<div class="row">
					{{ csrf_field() }}
					<div class="col-md-5">
						<div class="form-group label-floating">
							<label class="control-label">Patient Name</label>
							<input type="text" name="name" value="{{ old('name') }}" class="form-control">
							<span class="has-error">{{ $errors->patient->first('name') }}</span>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group label-floating">
							<label class="control-label">Contact Number</label>
							<input type="text" name="phone" value="{{ old('phone') }}" class="form-control">
							<span class="has-error">{{ $errors->patient->first('phone') }}</span>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group label-floating">
							<label class="control-label">Email address</label>
							<input type="email" name="email" value="{{ old('email') }}" class="form-control">
							<span class="has-error">{{ $errors->patient->first('email') }}</span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group label-floating">
							<label class="control-label">Hall</label>
							<select name="hall" value="{{ old('hall') }}" class="form-control">
								<option value=""></option>
								<option value=""></option>
							</select>
							<span class="has-error">{{ $errors->patient->first('hall') }}</span>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group label-floating">
							<label class="control-label">Department</label>
							<select name="department" value="{{ old('department') }}" class="form-control">
								<option value=""></option>
								<option value=""></option>
							</select>
							<span class="has-error">{{ $errors->patient->first('department') }}</span>
						</div>
					</div>
				</div>
				<div class="row">
				</div>
				<button type="submit" class="btn btn-primary pull-right">Add Patient</button>
				<div class="clearfix"></div>
			</form>
		</div>
	</div>
</div>
@endsection