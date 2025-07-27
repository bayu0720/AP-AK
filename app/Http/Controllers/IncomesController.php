<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incomes;
use App\Models\Balance;
use App\Models\Categories;

class IncomesController extends Controller
{
    // Menampilkan Semua Data
    public function index()
    {
        $incomes = Incomes::getAll(); // Ambil semua data pemasukan
        $categories = Categories::getAll(); // Ambil semua data kategori
        return view('dashboard.incomes.list', compact('incomes', 'categories'));
    }

    // Goto Add Data Page
    public function addPage()
    {
        $title = "Tambah Data Pemasukan";
        $categories = Categories::getAll(); // Ambil semua data kategori
        return view('dashboard.incomes.add', compact('title', 'categories'));
    }

    // Insert Data
    public function insert(Request $request)
    {
        
        // Masukkan catatan pendapatan baru ke dalam database.
        $income = Incomes::insert([
            'amount'        => $request->amount,
            'description'   => $request->description,
            'date'          => $request->date,
            'id_category'   => $request->id_category,
            'created_at'    => now(),
        ]);

        // Notifikasi
        if ($income) {
            return redirect()->route('incomes')->with('success', 'Data Berhasil Ditambahkan');
        } else {
            return redirect()->route('incomes')->with('error', 'Data Gagal Ditambahkan');
        }
    }

    // Delete Data
    public function delete($id)
    {
        // Hapus data pendapatan berdasarkan id
        $income = Incomes::deleteData($id);

        // Notifikasi
        if ($income) {
            return redirect()->route('incomes')->with('success', 'Data Berhasil Dihapus');
        } else {
            return redirect()->route('incomes')->with('error', 'Data Gagal Dihapus');
        }
    }

    // Goto Edit Data Page
    public function editPage($id)
    {
        $income = Incomes::where('id_income', $id)->first();
        $categories = Categories::getAll();
        if ($income) {
            return view('dashboard.incomes.edit', compact('income', 'categories'));
        }
        return redirect()->route('incomes')->with('error', 'Data pemasukan tidak ditemukan.');
    }
    public function update(Request $request, $id)
    {
        $income = Incomes::where('id_income', $id)->first();
        if ($income) {
            $income->update([
                'amount'      => $request->amount,
                'description' => $request->description,
                'date'        => $request->date,
                'id_category' => $request->id_category,
                'updated_at'  => now(),
            ]);
            return redirect()->route('incomes')->with('success', 'Data Berhasil Diupdate');
        } else {
            return redirect()->route('incomes')->with('error', 'Data Gagal Diupdate');
        }
    }
}
