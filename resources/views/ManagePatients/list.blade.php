@extends('layouts.qmlayout')
@section('content')
<div class="col-md-12">
	<div class="card">
		<div class="card-content">
			<div class="card-header" data-background-color="purple">
				<h4 class="title">Manage Patients</h4>
				<p class="category">Patients List</p>
			</div>
			<div class="card-content table-responsive">
				<table class="table">
					<thead class="text-primary">
						<th>Name</th>
						<th>Country</th>
						<th>City</th>
						<th>Salary</th>
						<th>Action</th>
					</thead>
					<tbody>
						<tr>
							<td>Dakota Rice</td>
							<td>Niger</td>
							<td>Oud-Turnhout</td>
							<td class="text-primary">$36,738</td>
							<td class="text-primary">
								<a href=""><i class="fa fa-pencil" aria-hidden="true"></i></a>
								&nbsp; &nbsp;<a href=""><i class="fa fa-trash-o" aria-hidden="true"></i></a>
							</td>
						</tr>
						<tr>
							<td>Minerva Hooper</td>
							<td>Curaçao</td>
							<td>Sinaai-Waas</td>
							<td class="text-primary">$23,789</td>
							<td class="text-primary">
								<a href=""><i class="fa fa-pencil" aria-hidden="true"></i></a>
								&nbsp; &nbsp;<a href=""><i class="fa fa-trash-o" aria-hidden="true"></i></a>
							</td>
						</tr>
						<tr>
							<td>Sage Rodriguez</td>
							<td>Netherlands</td>
							<td>Baileux</td>
							<td class="text-primary">$56,142</td>
							<td class="text-primary">
								<a href=""><i class="fa fa-pencil" aria-hidden="true"></i></a>
								&nbsp; &nbsp;<a href=""><i class="fa fa-trash-o" aria-hidden="true"></i></a>
							</td>
						</tr>
						<tr>
							<td>Philip Chaney</td>
							<td>Korea, South</td>
							<td>Overland Park</td>
							<td class="text-primary">$38,735</td>
							<td class="text-primary">
								<a href=""><i class="fa fa-pencil" aria-hidden="true"></i></a>
								&nbsp; &nbsp;<a href=""><i class="fa fa-trash-o" aria-hidden="true"></i></a>
							</td>
						</tr>
						<tr>
							<td>Doris Greene</td>
							<td>Malawi</td>
							<td>Feldkirchen in Kärnten</td>
							<td class="text-primary">$63,542</td>
							<td class="text-primary">
								<a href=""><i class="fa fa-pencil" aria-hidden="true"></i></a>
								&nbsp; &nbsp;<a href=""><i class="fa fa-trash-o" aria-hidden="true"></i></a>
							</td>
						</tr>
						<tr>
							<td>Mason Porter</td>
							<td>Chile</td>
							<td>Gloucester</td>
							<td class="text-primary">$78,615</td>
							<td class="text-primary">
								<a href=""><i class="fa fa-pencil" aria-hidden="true"></i></a>
								&nbsp; &nbsp; <a href=""><i class="fa fa-trash-o" aria-hidden="true"></i></a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection