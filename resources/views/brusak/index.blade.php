@extends('dashboard')

@section('content')
<div class="container mt-4">
    <h3>Laporan Barang Rusak</h3>

    <!-- Menampilkan pesan sukses -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filter Form -->
    <form action="{{ route('brusak.index') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-3">
                <label for="tanggal_rusak">Tanggal Rusak</label>
                <input type="date" name="tanggal_rusak" class="form-control" value="{{ request('tanggal_rusak') }}">
            </div>
            <div class="col-md-3">
                <label for="status">Status</label>
                <select name="status" class="form-control">
                    <option value="">Semua Status</option>
                    <option value="Rusak" {{ request('status') == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                    <option value="Diperbaiki" {{ request('status') == 'Diperbaiki' ? 'selected' : '' }}>Diperbaiki</option>
                    <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary mt-4">Filter</button>
            </div>
        </div>
    </form>

    <!-- Tabel Laporan -->
    <table class="table">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Tanggal Rusak</th>
                <th>Deskripsi Kerusakan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($brusaks as $brusak)
            <tr>
                <td>{{ $brusak->barang->name }}</td>
                <td>{{ $brusak->tanggal_rusak }}</td>
                <td>{{ $brusak->deskripsi_kerusakan }}</td>
                <td>{{ $brusak->status }}</td>
                <td>
                    <!-- Tombol Edit untuk membuka modal edit -->
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalForm" onclick="editBrusak({{ $brusak->id }})">Edit</button>

                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tombol Tambah Barang Rusak -->
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalForm" onclick="clearForm()">Tambah Barang Rusak</button>

    <!-- Modal Form -->
    <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="brusakForm" method="POST" action="{{ route('brusak.save', 0) }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalFormLabel">Form Barang Rusak</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="barang_id">Barang</label>
                            <select name="barang_id" id="barang_id" class="form-control">
                                @foreach($barangs as $barang)
                                    <option value="{{ $barang->id }}">{{ $barang->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="tanggal_rusak">Tanggal Rusak</label>
                            <input type="date" name="tanggal_rusak" id="tanggal_rusak" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="deskripsi_kerusakan">Deskripsi Kerusakan</label>
                            <textarea name="deskripsi_kerusakan" id="deskripsi_kerusakan" class="form-control"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="Rusak">Rusak</option>
                                <option value="Diperbaiki">Diperbaiki</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk mengisi form edit -->
<script>
    function editBrusak(id) {
        fetch('/brusak/' + id + '/edit')
            .then(response => response.json())
            .then(data => {
                document.getElementById('barang_id').value = data.barang_id;
                document.getElementById('tanggal_rusak').value = data.tanggal_rusak;
                document.getElementById('deskripsi_kerusakan').value = data.deskripsi_kerusakan;
                document.getElementById('status').value = data.status;
                document.getElementById('brusakForm').action = '/brusak/' + id;
            });
    }

    function clearForm() {
        document.getElementById('brusakForm').reset();
        document.getElementById('brusakForm').action = '/brusak/save/0';
    }
</script>
@endsection
