<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HelpCenter;
use Illuminate\Http\Request;

class HelpCenterController extends Controller
{
    public function index(Request $request)
    {
        $query = HelpCenter::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('pertanyaan', 'like', '%' . $search . '%')
                  ->orWhere('jawaban', 'like', '%' . $search . '%')
                  ->orWhere('kategori', 'like', '%' . $search . '%');
            });
        }

        $faqs = $query->latest()->paginate(10);
        return view('admin.pages.pusat_bantuan.index', compact('faqs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'required|string',
            'kategori' => 'required|string|max:100'
        ]);

        HelpCenter::create([
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $request->jawaban,
            'kategori' => $request->kategori
        ]);

        return redirect()->route('pusat-bantuan.index')
                         ->with('success', 'FAQ berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'required|string',
            'kategori' => 'required|string|max:100'
        ]);

        $faq = HelpCenter::findOrFail($id);
        
        $faq->update([
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $request->jawaban,
            'kategori' => $request->kategori
        ]);

        return redirect()->route('pusat-bantuan.index')
                         ->with('success', 'FAQ berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $faq = HelpCenter::findOrFail($id);
        $faq->delete();

        return redirect()->route('pusat-bantuan.index')
                         ->with('success', 'FAQ berhasil dihapus!');
    }

    // Tambahkan method edit jika diperlukan untuk debugging
    public function edit($id)
    {
        $faq = HelpCenter::findOrFail($id);
        return view('admin.pages.pusat_bantuan.edit', compact('faq'));
    }
}