@extends('layouts.app')
@section('title', 'List Properti')

@section('sidebar')
sidebar
@endsection

@section('navbar')
navbar
@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="/assets/vendor/datatables/css/dataTables.bootstrap4.min.css"/>
<link rel="stylesheet" type="text/css" href="/assets/vendor/datatables/css/responsive.bootstrap4.min.css"/>
<style type="text/css">
	.dataTables_wrapper{
		font-size:.875rem
	}
	table.dataTable{
		margin-bottom:1.25rem!important;border-bottom:1px solid #e9ecef
	}
	table.dataTable tbody>tr.selected{
		background-color:#5e72e4
	}
	.dataTables_info,.dataTables_length,.dt-buttons{
		padding-left:1.5rem
	}
	.dataTables_length .form-control{
		margin:0 .375rem
	}
	.dataTables_filter{
		display:inline-block;float:right;padding-right:1.5rem
	}
	.dataTables_paginate{
		padding-right:1.5rem
	}
</style>
@endpush

@section('content')
<div class="header bg-primary pb-6">
	<div class="container-fluid">
		<div class="header-body">
			<!--  -->
		</div>
	</div>
</div>
<div class="container-fluid mt--6">
	<div class="row">
		<div class="col">
			<div class="card">
                <div class="card-header border-0">
                    @include('components.alert')
					<h3 class="mb-0">List Properti</h3>
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <a href="javascript:;" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">+ Tambah Properti</a>
                        </div>
                    </div>
				</div>
				<!-- Card header -->
				<!-- Light table -->
				<div class="col-12">
					<div class="table-responsive">
						<table class="table align-items-center table-flush" id="category" style="width:100%">
							<thead class="thead-light">
								<tr>
									<th>No</th>
                                    <th>Nama</th>
									<th>Lokasi</th>
                                    <th>Harga</th>
									<th>Aksi</th>
								</tr>
							</thead>
                            @php $no = 1; @endphp
                            @foreach ($properties as $property)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $property['name'] }}</td>
                                <td>{{ $property['location'] }}</td>
                                <td>{{ $property['price'] }}</td>
                                <th>
                                    <button data-id="{{ $property['id'] }}" data-name="{{ $property['name'] }}" data-location="{{ $property['location'] }}" data-price="{{ $property['price'] }}" class="btn btn-sm btn-primary edit">Ubah</button>
                                    <a href="{{ route('property-dashboard.destroy', $property['id']) }}" class="btn btn-danger btn-sm" data-dismiss="modal">Hapus</a>
                                </th>
                            </tr>
                            @endforeach

						</table>
					</div>
				</div>
				<!-- Card footer -->
				<div class="card-footer py-4">
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<form action="{{ route('property-dashboard.store') }}" method="post" id="formSave" enctype="multipart/form-data">
		@csrf
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Properti</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
                <div class="form-group">
					<label for="example-text-input" class="form-control-label">Nama</label>
					<input name="name" class="form-control" type="text" id="example-text-input" required>
				</div>
                <div class="form-group">
					<label for="example-text-input" class="form-control-label">Lokasi</label>
					<textarea name="location" class="form-control" cols="30" rows="3"></textarea>
				</div>
                <div class="form-group">
					<label for="example-text-input" class="form-control-label">Harga</label>
					<input name="price" class="form-control" type="text" id="example-text-input" required>
				</div>
				</div>
					<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" id="save" type="button" class="btn btn-primary">Simpan</a>
				</div>
			</div>
		</div>
	</form>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<form action="{{ route('property-dashboard.update') }}" method="post" id="formSave" enctype="multipart/form-data">
		@csrf
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Ubah Properti</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
                <input name="id" class="form-control" type="hidden" id="edit-id" required>
                <div class="form-group">
					<label for="example-text-input" class="form-control-label">Nama</label>
					<input name="name" class="form-control" type="text" id="edit-name" required>
				</div>
                <div class="form-group">
					<label for="example-text-input" class="form-control-label">Lokasi</label>
					<textarea name="location" class="form-control" cols="30" rows="3" id="edit-location"></textarea>
				</div>
                <div class="form-group">
					<label for="example-text-input" class="form-control-label">Harga</label>
					<input name="price" class="form-control" type="text" id="edit-price" required>
				</div>
				</div>
					<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" id="save" type="button" class="btn btn-primary">Simpan</a>
				</div>
			</div>
		</div>
	</form>
</div>
@endsection

@push('scripts')
<script type="text/javascript" src="/assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="/assets/vendor/datatables/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="/assets/vendor/datatables/js/responsive.bootstrap4.min.js"></script>

@push('scripts')
<script type="text/javascript" src="/assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="/assets/vendor/datatables/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="/assets/vendor/datatables/js/responsive.bootstrap4.min.js"></script>
<script type="text/javascript">
	$('body').on('click', '.edit', function(e){
	    $('#modalEdit').modal('show');
	    $('#edit-id').val($(this).data('id'));
	    $('#edit-name').val($(this).data('name'));
        $('#edit-location').val($(this).data('location'));
        $('#edit-price').val($(this).data('price'));
	})
</script>
@endpush
@endpush
