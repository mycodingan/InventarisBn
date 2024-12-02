<!-- resources/views/barang/index.blade.php -->
@extends('dashboard')

@section('content')
    <div class="container">
        <h1>Daftar Barang</h1>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Tambah Barang</button>
        
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barangs as $barang)
                    <tr>
                        <td>{{ $barang->name }}</td>
                        <td>{{ $barang->category }}</td>
                        <td>{{ $barang->status }}</td>
                        <td>
                            <!-- Tombol Edit -->
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $barang->id }}">Edit</button>

                            <!-- Form Delete -->
                            <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Create Barang -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('barang.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Tambah Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Kategori Barang</label>
                            <input type="text" class="form-control" id="category" name="category" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Jumlah Barang</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" required>
                        </div>
                        <div class="mb-3">
                            <label for="condition" class="form-label">Kondisi</label>
                            <input type="text" class="form-control" id="condition" name="condition" required>
                        </div>
                        <div class="mb-3">
                            <label for="date_received" class="form-label">Tanggal Diterima</label>
                            <input type="date" class="form-control" id="date_received" name="date_received" required>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Lokasi Barang</label>
                            <input type="text" class="form-control" id="location" name="location">
                        </div>
                        <div class="mb-3">
                            <label for="unit_price" class="form-label">Harga Satuan</label>
                            <input type="number" class="form-control" id="unit_price" name="unit_price">
                        </div>
                        <div class="mb-3">
                            <label for="inventory_code" class="form-label">Kode Inventaris</label>
                            <input type="text" class="form-control" id="inventory_code" name="inventory_code" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="Tersedia">Tersedia</option>
                                <option value="Dipinjam">Dipinjam</option>
                                <option value="Rusak">Rusak</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Barang -->
    @foreach($barangs as $barang)
        <div class="modal fade" id="editModal{{ $barang->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $barang->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('barang.update', $barang->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel{{ $barang->id }}">Edit Barang</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $barang->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Kategori Barang</label>
                                <input type="text" class="form-control" id="category" name="category" value="{{ $barang->category }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="description" name="description">{{ $barang->description }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Jumlah Barang</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $barang->quantity }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="condition" class="form-label">Kondisi</label>
                                <input type="text" class="form-control" id="condition" name="condition" value="{{ $barang->condition }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="date_received" class="form-label">Tanggal Diterima</label>
                                <input type="date" class="form-control" id="date_received" name="date_received" value="{{ $barang->date_received->format('Y-m-d') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="location" class="form-label">Lokasi Barang</label>
                                <input type="text" class="form-control" id="location" name="location" value="{{ $barang->location }}">
                            </div>
                            <div class="mb-3">
                                <label for="unit_price" class="form-label">Harga Satuan</label>
                                <input type="number" class="form-control" id="unit_price" name="unit_price" value="{{ $barang->unit_price }}">
                            </div>
                            <div class="mb-3">
                                <label for="inventory_code" class="form-label">Kode Inventaris</label>
                                <input type="text" class="form-control" id="inventory_code" name="inventory_code" value="{{ $barang->inventory_code }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="Tersedia" {{ $barang->status == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                                    <option value="Dipinjam" {{ $barang->status == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                                    <option value="Rusak" {{ $barang->status == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
@endsection
