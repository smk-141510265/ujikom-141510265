@extends('layouts.app')

@section('content')

<div class="container">
	<div class="panel panel-primary">
		<div class="panel-heading">Tunjangan</div>
		<div class="panel-body">
		<a class="btn btn-success" href="{{url('tunjangan/create')}}">Tambah Data</a><br><br>
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr class="bg-info">
						<th>No</th>
						<th>Kode Tunjangan</th>
						<th>Jabatan</th>
						<th>Golongan</th>
						<th>Status</th>
						<th>Jumlah Anak</th>
						<th>Besaran Uang</th>
						<th colspan="3">Pilihan</th>
					</tr>
				</thead>

				<?php $no=1; ?>
				@foreach ($tunjangan as $tunjangans)
				<tbody>
					<tr> 
						<td> {{$no++}} </td>
						<td> {{$tunjangans->kode_tunjangan}} </td>
						<td> {{$tunjangans->Jabatan->nama_jabatan}} </td>
						<td> {{$tunjangans->Golongan->nama_golongan}} </td>
						<td> {{$tunjangans->status}} </td>
						<td> {{$tunjangans->jumlah_anak}} </td>
						<td> Rp.{{$tunjangans->besaran_uang}} </td>
						<td>
							<a class="btn btn-xs btn-warning" href=" {{route('tunjangan.edit', $tunjangans->id)}} ">Ubah</a>
						</td>
						<td>
							<form method="POST" action=" {{route('tunjangan.destroy', $tunjangans->id)}} ">
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