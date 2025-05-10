<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualanModel;
use App\Models\PenjualanModel;
use App\Models\BarangModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class DetailPenjualanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Detail Penjualan',
            'list' => ['Home', 'Detail Penjualan']
        ];

        $page = (object) [
            'title' => 'Daftar detail penjualan yang terdaftar dalam sistem'
        ];

        $activeMenu = 'detail_penjualan';

        $detail_penjualan = DetailPenjualanModel::all();
        $penjualan = PenjualanModel::all();
        $barang = BarangModel::all();
        return view('detail_penjualan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'penjualan' => $penjualan, 'detail_penjualan' => $detail_penjualan, 'barang' => $barang]);
    }

    public function list(Request $request)
{
    // Ambil data dari DetailPenjualanModel dengan relasi barang dan penjualan
    $detail = DetailPenjualanModel::with(['barang', 'penjualan']);

    if ($request->penjualan_id) {
        $detail->where('penjualan_id', $request->penjualan_id);
    }

    if ($request->barang_id) {
        $detail->where('barang_id', $request->barang_id);
    }

    return DataTables::of($detail)
        ->addIndexColumn()
        ->addColumn('penjualan_kode', function ($row) {
            return $row->penjualan->penjualan_kode ?? '-';
        })
        ->addColumn('barang_nama', function ($row) {
            return $row->barang->barang_nama ?? '-';
        })
        ->addColumn('action', function ($row) {
            $btn  = '<button onclick="modalAction(\'' . url('/detail_penjualan/' . $row->id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/detail_penjualan/' . $row->id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/detail_penjualan/' . $row->id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button>';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
}

public function barang()
{
    return $this->belongsTo(BarangModel::class, 'barang_id');
}

public function penjualan()
{
    return $this->belongsTo(PenjualanModel::class, 'penjualan_id');
}

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Detail Penjualan',
            'list' => ['Home', 'Detail Penjualan', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah data detail penjualan baru'
        ];

        $penjualan = PenjualanModel::all();
        $barang = BarangModel::all();
        $activeMenu = 'detail_penjualan';

        return view('detail_penjualan.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penjualan' => $penjualan, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'penjualan_id' => 'required|integer',
            'barang_id' => 'required|integer',
            'harga' => 'required|int',
            'jumlah' => 'required|int'
        ]);

        PenjualanModel::create($request->all());

        return redirect('/detail_penjualan')->with('success', 'Data detail penjualan berhasil disimpan');
    }

    public function show(string $id)
    {
        $detail_penjualan = DetailPenjualanModel::with(['penjualan', 'barang'])->find($id);

        $breadcrumb = (object) [
            'title' => 'Data Petail Penjualan',
            'list' => ['Home', 'Detail Penjualan', 'Detail']
        ];

        $page = (object) [
            'title' => 'Data detail penjualan'
        ];

        $activeMenu = 'detail_penjualan';

        return view('detail_penjualan.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'detail_penjualan' => $detail_penjualan, 'activeMenu' => $activeMenu]);
    }

    public function edit(String $id)
    {
        $detail_penjualan = DetailPenjualanModel::find($id);
        $penjualan = PenjualanModel::all();
        $barang = BarangModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Detail Penjualan',
            'list' => ['Home', 'Detail Penjualan', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit detail penjualan',
        ];

        $activeMenu = 'detail_penjualan';

        return view('penjualan.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'detail_penjualan' => $detail_penjualan, 'penjualan' => $penjualan, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'penjualan_id' => 'required|integer',
            'barang_id' => 'required|integer',
            'harga' => 'required|int',
            'jumlah' => 'required|int'
        ]);

        DetailPenjualanModel::find($id)->update([
            'penjualan_id' => $request->penjualan_id,
            'barang_id' => $request->barang_id,
            'harga' => $request->harga,
            'jumlah' => $request->jumlah,
        ]);

        return redirect('/detail_penjualan')->with('success', 'Data detail penjualan berhasil diubah');
    }

    public function destroy(String $id)
    {
        $check = DetailPenjualanModel::find($id);
        if (!$check) {
            return redirect('/detail_penjualan')->with('error', 'Data detail penjualan tidak ditemukan');
        }

        try {
            DetailPenjualanModel::destroy($id);
            return redirect('/detail_penjualan')->with('success', 'Data detail penjualan berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/detail_penjualan')->with('error', 'Data detail penjualan gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    public function create_ajax()
    {
        $penjualan = PenjualanModel::all();
        $barang = BarangModel::all();
        return view('detail_penjualan.create_ajax', ['penjualan' => $penjualan, 'barang' => $barang]);
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'penjualan_id' => 'required|integer',
                'barang_id' => 'required|integer',
                'harga' => 'required|int',
                'jumlah' => 'required|int'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            DetailPenjualanModel::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data detail penjualan berhasil disimpan'
            ]);
        }
        return redirect('/');
    }

    public function show_ajax(string $id)
    {
        $detail_penjualan = DetailPenjualanModel::with(['penjualan', 'barang'])->find($id);
        return view('detail_penjualan.show_ajax', compact('detail_penjualan'));
    }

    public function edit_ajax(string $id)
    {
        $detail_penjualan = DetailPenjualanModel::find($id);
        $penjualan = PenjualanModel::all();
        $barang = BarangModel::all();
        return view('penjualan.edit_ajax', ['detail_penjualan' => $detail_penjualan, 'penjualan' => $penjualan, 'barang' => $barang]);
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'penjualan_id' => 'required|integer',
                'barang_id' => 'required|integer',
                'harga' => 'required|int',
                'jumlah' => 'required|int'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            $detail_penjualan = DetailPenjualanModel::find($id);
            if ($detail_penjualan) {
                $detail_penjualan->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
        return redirect('/');
    }

    public function confirm_ajax(string $id)
    {
        $detail_penjualan = DetailPenjualanModel::find($id);
        return view('detail_penjualan.confirm_ajax', ['detail_penjualan' => $detail_penjualan]);
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $detail_penjualan = DetailPenjualanModel::find($id);
            if ($detail_penjualan) {
                try {
                    DetailPenjualanModel::destroy($id);
                    return response()->json([
                        'status' => true,
                        'message' => 'Data berhasil dihapus'
                    ]);
                } catch (\Illuminate\Database\QueryException $e) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Data penjualan gagal dihapus karena masih terkait dengan data lain'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }
}