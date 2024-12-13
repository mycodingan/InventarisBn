@extends('dashboard')
@section('content')
<div class="container mt-4">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Tambah Peminjaman</button>

    <!-- Tabel Peminjaman -->
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nama Peminjam</th>
                <th>Barang</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjaman as $item)
            <tr>
                <td>{{ $item->nama_peminjam }}</td>
                <td>{{ $item->barang->name }}</td>
                <td>{{ $item->borrow_date }}</td>
                <td>{{ $item->return_date ?? 'Belum Kembali' }}</td>
                <td>{{ $item->status }}</td>
                <td>
                    <!-- Edit Button -->
                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal"
                        data-id="{{ $item->id }}" data-nama_peminjam="{{ $item->nama_peminjam }}"
                        data-barang_id="{{ $item->barang_id }}" data-borrow_date="{{ $item->borrow_date }}"
                        data-return_date="{{ $item->return_date }}" data-status="{{ $item->status }}"
                        data-notes="{{ $item->notes }}">
                        Edit
                    </button>
                    <!-- Delete Button -->
                    <form action="{{ route('peminjaman.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('peminjaman.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah Peminjaman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_peminjam">Nama Peminjam</label>
                        <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam" required>
                    </div>
                    <div class="form-group">
                        <label for="barang_id">Barang</label>
                        <select class="form-control" id="barang_id" name="barang_id" required>
                            @foreach($barangs as $barang)
                            <option value="{{ $barang->id }}">{{ $barang->name   }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="borrow_date">Tanggal Pinjam</label>
                        <input type="date" class="form-control" id="borrow_date" name="borrow_date" required>
                    </div>
                    <div class="form-group">
                        <label for="return_date">Tanggal Kembali</label>
                        <input type="date" class="form-control" id="return_date" name="return_date">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" class="form-control" id="status" name="status" required>
                    </div>
                    <div class="form-group">
                        <label for="notes">Catatan</label>
                        <textarea class="form-control" id="notes" name="notes"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="POST" id="editForm">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Peminjaman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_nama_peminjam">Nama Peminjam</label>
                        <input type="text" class="form-control" id="edit_nama_peminjam" name="nama_peminjam" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_barang_id">Barang</label>
                        <select class="form-control" id="edit_barang_id" name="barang_id" required>
                            @foreach($barangs as $barang)
                            <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_borrow_date">Tanggal Pinjam</label>
                        <input type="date" class="form-control" id="edit_borrow_date" name="borrow_date" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_return_date">Tanggal Kembali</label>
                        <input type="date" class="form-control" id="edit_return_date" name="return_date">
                    </div>
                    <div class="form-group">
                        <label for="edit_status">Status</label>
                        <input type="text" class="form-control" id="edit_status" name="status" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_notes">Catatan</label>
                        <textarea class="form-control" id="edit_notes" name="notes"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var id = button.data('id');
            var nama_peminjam = button.data('nama_peminjam');
            var barang_id = button.data('barang_id');
            var borrow_date = button.data('borrow_date');
            var return_date = button.data('return_date');
            var status = button.data('status');
            var notes = button.data('notes');

            var modal = $(this);
            modal.find('#editForm').attr('action', '/peminjaman/' + id);
            modal.find('#edit_nama_peminjam').val(nama_peminjam);
            modal.find('#edit_barang_id').val(barang_id);
            modal.find('#edit_borrow_date').val(borrow_date);
            modal.find('#edit_return_date').val(return_date);
            modal.find('#edit_status').val(status);
            modal.find('#edit_notes').val(notes);
        });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection