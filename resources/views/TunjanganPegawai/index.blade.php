@extends('layouts.app')

@section('content')

<div class="container">
	<div class="panel panel-info">
		<div class="panel-heading">Tunjangan Pegawai</div>
		<div class="panel-body">
		<a class="btn btn-primary" href="{{url('tunja/create')}}">Tambah Data</a><br><br>
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr class="bg-primary">
						<th>No</th>
						<th>Kode Tunjangan</th>
						<th>Pegawai NIP</th>
						<th colspan="3">Pilihan</th>
					</tr>
				</thead>

				<?php $no=1; ?>
				@foreach ($tunjanganpegawai as $tunjas)
				<tbody>
					<tr> 
						<td> {{$no++}} </td>
						<td> {{$tunjas->Tunjangan->kode_tunjangan}} </td>
						<td> {{$tunjas->Pegawai->nip}} </td>
						<td>
							<a class="btn btn-xs btn-info" href=" {{route('tunja.edit', $tunjas->id)}} ">Ubah</a>
						</td>
						<td>
							<form method="POST" action=" {{route('tunja.destroy', $tunjas->id)}} ">
								{{csrf_field()}}
								<input type="hidden" name="_method" value="DELETE">
								<input class="btn btn-xs btn-danger" onclick="return confirm('Apakah yakin ingin menghapus data ?');" type="submit" value="Hapus">
							</form>
						</td>
					</tr>
				</tbody>
				@endforeach
			</table>
		</div>
	</div>
</div>

@endsection