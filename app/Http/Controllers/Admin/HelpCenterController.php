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
            $query->where('pertanyaan', 'like', '%' . $request->search . '%')
                  ->orWhere('jawaban', 'like', '%' . $request->search . '%');
        }

        $faqs = $query->latest()->get();
        return view('admin.pages.pusat_bantuan.index', compact('faqs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required',
            'jawaban' => 'required',
            'kategori' => 'required'
        ]);

        HelpCenter::create($request->all());
        return back()->with('success', 'FAQ Berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $faq = HelpCenter::findOrFail($id);
        $faq->update($request->all());
        return back()->with('success', 'FAQ Berhasil diperbarui!');
    }

    public function destroy($id)
    {
        HelpCenter::destroy($id);
        return back()->with('success', 'FAQ Berhasil dihapus!');
    }
}

