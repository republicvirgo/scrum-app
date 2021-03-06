@extends('layouts.app')

@section('title', 'Ubah Member')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/users') }}">Data Member</a></li>
				<li class="active">Ubah Data Member</li>
			</ul>

			<div class="panel panel-default">

				<div class="panel-heading">
					<h2 class="panel panel-title">Ubah Data Member</h2>
				</div>

				<div class="panel-body">
					{!!Form::model($user, ['url' => route('users.update', $user->id), 'method'=>'put', 'class'=>'form-horizontal'])!!}
					@include('users._form')
					{!! Form::close() !!}
				</div>

			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
	$(document).ready(function () {
		$('.js-selectize-multi-edit').selectize({
			sortField: 'text',
			delimiter: ',',
			maxItems: null,
			items: [<?php echo $data_team ?>]
		});
	});
</script>
@endsection
