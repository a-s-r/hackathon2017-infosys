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
					<div class="col-md-4">
						<div class="form-group label-floating">
							<label class="control-label">Patient Name</label>
							<input type="text" name="name" value="{{ old('name') }}" class="form-control">
							<span class="has-error">{{ $errors->patient->first('name') }}</span>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group label-floating">
							<label class="control-label">Contact Number</label>
							<input type="text" name="phone" value="{{ old('phone') }}" class="form-control">
							<span class="has-error">{{ $errors->patient->first('phone') }}</span>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group label-floating">
							<label class="control-label">Age</label>
							<input type="text" name="age" value="{{ old('age') }}" class="form-control">
							<span class="has-error">{{ $errors->patient->first('age') }}</span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group label-floating">
							<label class="control-label">Address</label>
							<input type="text" name="address" value="{{ old('address') }}" class="form-control">
							<span class="has-error">{{ $errors->patient->first('address') }}</span>
						</div>
					</div>
					<div class="col-md-6">
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
								@foreach($halls as $hall)
									<option value="{{ $hall->id }}">{{ $hall->name }}</option>
								@endforeach
							</select>
							<span class="has-error">{{ $errors->patient->first('hall') }}</span>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group label-floating">
							<label class="control-label">Department</label>
							<select name="department" value="{{ old('department') }}" class="department form-control">
								<option value=""></option>
								@foreach($departments as $department)
									<option value="{{$department->id}}">{{$department->name}}</option>
								@endforeach
							</select>
							<span class="has-error">{{ $errors->patient->first('department') }}</span>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group label-floating">
							<label class="control-label">Select Doctor</label>
							<select name="doctor" value="{{ old('department') }}" class="doctors form-control">
								<option value=""></option>
								
							</select>
							<span class="has-error">{{ $errors->patient->first('doctor') }}</span>
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
@section('script')
<script>
	$(document).ready(function(){
		$('.department').on('change',function(){
			var id = $(this).val();
			getDoctorsByDepartment(id);
		});
	});
	
	function getDoctorsByDepartment(id){
		console.log(id);
		if(id!=""){
			$.ajax({
				type:'GET',
				url:'/manage-patient/get-doctors/'+id,
				success:function(data){
					var obj = jQuery.parseJSON(data);
					//console.log(obj);
					//console.log(obj.status);
					$(".doctors").html("<option value=''></option>");
					if(obj.status==true){
						console.log(obj.data);
						$.each(obj.data,function(i,item){
							console.log(item);
							$(".doctors").append($("<option></option>").val(item.id).html(item.name));
						});
					}
				}
			});
		}
	}
</script>
@endsection