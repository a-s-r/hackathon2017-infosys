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
				<h4 class="title">Manage Halls</h4>
				<p class="category">Halls List</p>
			</div>
			<div class="card-content table-responsive">
				<table class="table">
					<thead class="text-primary">
						<th>Hall Name</th>
						<th>Capacity</th>
						<th>Created Date</th>
						<th>Action</th>
					</thead>
					<tbody>
						@foreach($halls as $hall)
							<tr>
								<td>{{ ucwords($hall->name) }}</td>
								<td>{{ $hall->capacity }}</td>
								<td>{{ date('d-M-y',strtotime($hall->created_at))}}</td>
								<td class="text-primary">
									<a href="/manage-hall/edit/{{$hall->id}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
									&nbsp; &nbsp;<a onclick="return confirm('Are you sure want to delete?')" href="/manage-hall/delete/{{$hall->id}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				{!! $halls->render() !!}
			</div>
		</div>
	</div>
</div>
@endsection