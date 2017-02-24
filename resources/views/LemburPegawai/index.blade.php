@extends('layouts.app')

@section('content')

<div class="container">
	<div class="panel panel-primary">
		<div class="panel-heading">Lembur Pegawai</div>
		<div class="panel-body">
		<a class="btn btn-success" href="{{url('lembur/create')}}">Tambah Data</a><br><br>
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr class="bg-info">
						<th>No</th>
						<th>Kode Lembur </th>
						<th>Pegawai NIP</th>
						<th>Jumlah Jam</th>
						
						<th colspan="3">Pilihan</th>
					</tr>
				</thead>

				<?php $no=1; ?>
				@foreach ($lembur as $lpegawais)
				<tbody>
					<tr> 
						<td> {{$no++}} </td>
						<td> {{$lpegawais->KategoryLembur->kode_lembur}} </td>
						<td> {{$lpegawais->Pegawai->nip}} </td>
						<td> {{$lpegawais->jumlah_jam}} </td>
						
						<td>
							<a class="btn btn-xs btn-warning" href=" {{route('lembur.edit', $lpegawais->id)}} ">Ubah</a>
						</td>
						<td>
							<form method="POST" action=" {{route('lembur.destroy', $lpegawais->id)}} ">
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