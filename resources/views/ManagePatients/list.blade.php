@extends('layouts.qmlayout')
@section('content')
<div class="col-md-12">
	<div class="card">
		@if(Session::has('alert-success'))
			<div class="alert alert-success">
				{{Session::get('alert-success')}}
			</div>
		@endif
		
		@if(Session::has('alert-failure'))
			<div class="alert alert-danger">
				{{Session::get('alert-failure')}}
			</div>
		@endif
		<div class="card-content">
			<div class="card-header" data-background-color="purple">
				<h4 class="title">Manage Patients</h4>
				<p class="category">Patients List</p>
			</div>
			<div class="card-content table-responsive">
				<table class="table">
					<thead class="text-primary">
						<th>Patient Name</th>
						<th>Phone</th>
						<th>Email</th>
						<th>CR NO.</th>
						<th>Token</th>
						<th>Department <small>(Room,Floor)</small></th>
						<th>Doctor Name</th>
						<th>Doctor Phone No</th>
						<th>Created Date</th>
						<th>Action</th>
					</thead>
					<tbody>
					@foreach($patients as $patient)
						<tr>
							<td>{{ $patient->patient_name }}</td>
							<td>{{ $patient->patient_phone }}</td>
							<td>{{ $patient->patient_email }}</td>
							<td>{{ $patient->crno }}</td>
							<td>{{ $patient->token }}</td>
							<td>{{ $patient->department_name }}, {{$patient->room_no}}, {{$patient->floor}}</td>
							<td>{{ $patient->doctors_name }}</td>
							<td>{{ $patient->doctor_phone }}</td>
							<td>{{ $patient->patient_register_date }}</td>
							<td>
								<a title="Re-Visit" href="/manage-patient/edit/{{ $patient->pid }}"><i class="fa fa-repeat" aria-hidden="true"></i></a>
								&nbsp; &nbsp;<a onclick="return confirm('Are you sure want to delete?');" href="/manage-patient/delete/{{ $patient->pid }}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
				{!! $patients->render() !!}
			</div>
		</div>
	</div>
</div>
@endsection