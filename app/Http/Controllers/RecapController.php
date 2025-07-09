<?php

namespace App\Http\Controllers;

use App\Models\Recap;
use Illuminate\Http\Request;

class RecapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Recap::query();

        // Filter berdasarkan company_id jika ada
        if ($request->filled('company_id')) {
            $query->where('company_id', 'like', '%' . $request->company_id . '%');
        }

        // Filter berdasarkan nama perusahaan jika ada
        if ($request->filled('nama_perusahaan')) {
            $query->where('nama_perusahaan', 'like', '%' . $request->nama_perusahaan . '%');
        }

        // Filter berdasarkan cabang jika ada
        if ($request->filled('cabang')) {
            $query->where('cabang', $request->cabang);
        }

        // Filter berdasarkan sales jika ada
        if ($request->filled('sales')) {
            $query->where('sales', $request->sales);
        }

        $recaps = $query->latest()->paginate(10);

        return view('recaps.index', compact('recaps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('recaps.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required|string|max:255',
            'nama_perusahaan' => 'required|string|max:255',
            'cabang' => 'required|string|max:255',
            'sales' => 'required|string|max:255',
            'keterangan' => 'nullable|string'
        ]);

        Recap::create($request->all());

        return redirect()->route('recaps.index')
            ->with('success', 'Recap berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recap $recap)
    {
        return view('recaps.show', compact('recap'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recap $recap)
    {
        return view('recaps.edit', compact('recap'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recap $recap)
    {
        $request->validate([
            'company_id' => 'required|string|max:255',
            'nama_perusahaan' => 'required|string|max:255',
            'cabang' => 'required|string|max:255',
            'sales' => 'required|string|max:255',
            'keterangan' => 'nullable|string'
        ]);

        $recap->update($request->all());

        return redirect()->route('recaps.index')
            ->with('success', 'Recap berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recap $recap)
    {
        $recap->delete();

        return redirect()->route('recaps.index')
            ->with('success', 'Recap berhasil dihapus!');
    }
}