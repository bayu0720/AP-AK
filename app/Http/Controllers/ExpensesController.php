<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expenses;
use App\Models\Categories;

class ExpensesController extends Controller
{
    protected $primaryKey = 'id_expense';

    // Halaman List Pengeluaran
    public function index()
    {
        $expenses = Expenses::getAll();
        $categories = Categories::getAll();
        return view('dashboard.expenses.list', compact('expenses', 'categories'));
    }

    // Halaman Tambah Pengeluaran
    public function addPage()
    {
        $categories = Categories::getAll();
        return view('dashboard.expenses.add', compact('categories'));
    } // <-- Hapus kurung kurawal penutup di sini!
    
    // Halaman Edit Pengeluaran
    public function editPage($id)
    {
        $expense = Expenses::where('id_expense', $id)->first();
        $categories = Categories::getAll();
        if ($expense) {
            return view('dashboard.expenses.edit', compact('expense', 'categories'));
        }
        return redirect()->route('expenses')->with('error', 'Data pengeluaran tidak ditemukan.');
    }

    // Update Pengeluaran
    public function update(Request $request, $id)
    {
        $expense = Expenses::where('id_expense', $id)->first();
        if ($expense) {
            $expense->update([
                'amount'        => $request->amount,
                'description'   => $request->description, 
                'date'          => $request->date,
                'id_category'   => $request->id_category,
                'updated_at'    => date('Y-m-d H:i:s')
            ]);
            return redirect('/expenses')->with(['success' => $request->description . ' Telah diupdate']);
        } else {
            return redirect('/expenses')->with(['error' => 'Terjadi kesalahan']);
        }  
    }       
        
    // Tambah Pengeluaran
    public function insert(Request $request)
    {
        // Insert data ke table
        $expense = Expenses::insert([
            'amount'        => $request->amount,
            'description'   => $request->description,
            'date'          => $request->date,
            'id_category'   => $request->id_category,
            'created_at'    => date('Y-m-d H:i:s')
        ]);

        // Cek jika berhasil
        if ($expense) {
            return redirect('/expenses')->with(['success' => $request->description . 'Telah ditambahkan']);
        } else {
            return redirect('/expenses')->with(['error' => 'Terjadi kesalahan']);
        }    
    }

    public function delete($id)
    {
        $expense = Expenses::where('id_expense', $id)->first();
        if ($expense) {
            $expense->delete();
            return redirect()->route('expenses')->with('success', 'Data pengeluaran berhasil dihapus.');
        }
        return redirect()->route('expenses')->with('error', 'Data pengeluaran tidak ditemukan.');
    }
}
