<?php
namespace App\Http\Controllers;

use App\Models\JournalEntry;
use Illuminate\Http\Request;

class JournalEntryController extends Controller
{
    public function index()
    {
        // $entries = JournalEntry::orderBy('date', 'desc')->get();
        // return view('journal.index', compact('entries'));
         $journals = JournalEntry::orderBy('date', 'desc')->get();
    return view('journal.index', compact('journals'));
    }

    public function create()
    {
        return view('journal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'description' => 'required',
            'account' => 'required',
            'debit' => 'required|numeric',
            'credit' => 'required|numeric',
        ]);

        JournalEntry::create($request->all());
        return redirect()->route('journal.index')->with('success', 'Jurnal berhasil ditambahkan');
    }
}