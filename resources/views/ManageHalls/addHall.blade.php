@extends('layouts.qmlayout')
@section('content')
<style>
	.addnew{float:right;color:#fff;font-size:25px;}
	.text{float:right;font-size:20px;}
</style>
<div class="col-md-12">
	<div class="card">		
		<div class="card-header" data-background-color="purple">
			<div class="row">
				<div class="col-md-8">
					<h4 class="title">Manage Halls</h4>
					<p class="category">Add Hall Capacity</p>
				</div>
				<div class="col-md-4">
					<div class=""><a href="/manage-hall"><span class="text">Manage List <i class="fa fa-angle-left"></i></span></a></div>
				</div>
			</div>
		</div>
		<div class="card-content">
			<form name="managehall" method="post" action="/manage-hall/save">
				{{csrf_field()}}
				<div class="row">
					<div class="col-md-5">
						<div class="form-group label-floating">
							<label class="control-label">Hall Name</label>
							<input type="text" name="hall_name" value="{{ old('hall_name') }}" class="form-control" />
							<span class="has-error">{{ $errors->addHall->first('hall_name') }}</span>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group label-floating">
							<label class="control-label">Capacity</label>
							<input type="text" name="capacity" value="{{ old('capacity') }}" class="form-control">
							<span class="has-error">{{ $errors->addHall->first('capacity') }}</span>
						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-primary pull-right">Save</button>
				<div class="clearfix"></div>
			</form>
		</div>
	</div>
</div>
@endsection