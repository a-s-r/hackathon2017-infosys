@extends('layouts.qmlayout')
@section('content')
<div class="col-md-12">
	<div class="card">
		<div class="card-header" data-background-color="purple">
			<h4 class="title">Manage Hall</h4>
			<p class="category">Add Hall Capacity</p>
		</div>
		<div class="card-content">
			<form name="managehall" method="post" action="/manage-hall/update">
				{{csrf_field()}}
				<div class="row">
					<input type="text" name="id" value="{{$hall->id}}" />
					<div class="col-md-5">
						<div class="form-group label-floating">
							<label class="control-label">Hall Name</label>
							<input type="text" name="hall_name" value="{{ old('hall_name', $hall->name) }}" class="form-control">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group label-floating">
							<label class="control-label">Capacity</label>
							<input type="text" name="capacity" value="{{ old('capacity', $hall->capacity) }}" class="form-control">
						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-primary pull-right">Update</button>
				<div class="clearfix"></div>
			</form>
		</div>
	</div>
</div>
@endsection