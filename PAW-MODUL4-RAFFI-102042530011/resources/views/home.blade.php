@extends('layouts.app')

@section('content')
<div class="container py-4">
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="text-center mb-4">
        <h2 class="fw-bold">Katalog Koleksi Buku</h2>
        <p class="text-muted">Temukan dan pinjam buku referensi perkuliahan terbaikmu</p>
    </div>

    <form action="{{ route('home') }}" method="GET" class="card p-3 shadow-sm mb-4">
        <div class="row g-2">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Cari judul, penulis..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="penerbit" class="form-select">
                    <option value="">Semua Penerbit</option>
                    @foreach($daftarPenerbit ?? [] as $p)
                        <option value="{{ $p }}" {{ request('penerbit') == $p ? 'selected' : '' }}>{{ $p }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="habis" {{ request('status') == 'habis' ? 'selected' : '' }}>Stok Habis</option>
                </select>
            </div>
            <div class="col-md-2">
                <select name="sort" class="form-select">
                    <option value="">Urutkan: Terbaru</option>
                    <option value="judul" {{ request('sort') == 'judul' ? 'selected' : '' }}>Judul (A-Z)</option>
                    <option value="tahun" {{ request('sort') == 'tahun' ? 'selected' : '' }}>Tahun Terbit</option>
                    <option value="stok" {{ request('sort') == 'stok' ? 'selected' : '' }}>Stok Terbanyak</option>
                </select>
            </div>
            <div class="col-md-1 d-grid">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <div class="row">
        @forelse($buku as $item)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($item->cover)
                        <img src="{{ asset('storage/' . $item->cover) }}" class="card-img-top" style="height: 240px; object-fit: cover;" alt="{{ $item->judul }}">
                    @else
                        <div class="d-flex align-items-center justify-content-center bg-light text-muted" style="height: 240px;">
                            Tidak Ada Sampul
                        </div>
                    @endif
                    <div class="card-body">
                        <h6 class="fw-bold">{{ $item->judul }}</h6>
                        <p class="text-muted small mb-2">{{ $item->penulis }}</p>
                        <span class="badge {{ $item->stok > 0 ? 'bg-success' : 'bg-danger' }}">
                            {{ $item->stok > 0 ? 'Tersedia (' . $item->stok . ')' : 'Stok Habis' }}
                        </span>
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        <a href="{{ route('buku.publik.show', $item->id) }}" class="btn btn-outline-primary btn-sm w-100">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center text-muted py-5">Buku tidak ditemukan.</p>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $buku->links() }}
    </div>
</div>
@endsection