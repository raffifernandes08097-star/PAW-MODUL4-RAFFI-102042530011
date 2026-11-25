<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $search   = $request->input('search');
        $status   = $request->input('status');
        $penerbit = $request->input('penerbit');
        $sort     = $request->input('sort');

        $daftarPenerbit = Buku::select('penerbit')->distinct()->pluck('penerbit');

        $buku = Buku::when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%")
                      ->orWhere('penulis', 'like', "%{$search}%");
                });
            })
            ->when($penerbit, function ($query, $penerbit) {
                $query->where('penerbit', $penerbit);
            })
            ->when($status, function ($query, $status) {
                if ($status === 'tersedia') {
                    $query->where('stok', '>', 0);
                } elseif ($status === 'habis') {
                    $query->where('stok', '<=', 0);
                }
            })
            ->when($sort, function ($query, $sort) {
                if ($sort === 'judul') {
                    $query->orderBy('judul', 'asc');
                } elseif ($sort === 'tahun') {
                    $query->orderBy('tahun_terbit', 'desc');
                } elseif ($sort === 'stok') {
                    $query->orderBy('stok', 'desc');
                } else {
                    $query->latest();
                }
            }, function ($query) {
                $query->latest();
            })
            ->paginate(5)
            ->withQueryString();

        return view('home', compact('buku', 'search', 'status', 'penerbit', 'sort', 'daftarPenerbit'));
    }

    public function show(Buku $buku)
    {
        return view('home_show', compact('buku'));
    }
}