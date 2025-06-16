<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BukuTamu;
use App\Models\Bidang;
use App\Models\Rekomendasi;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;


class BukuTamuController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'nik' => 'required|string',
            'phone' => 'required|string',
            'pekerjaan' => 'required|string',
            'keperluan' => 'required|string',
            'alamat' => 'required|string',
            'gender' => 'required|string',
            'identitas' => 'required|string',
            'bidang' => 'required|exists:bidangs,id',
            'rekomendasi' => 'nullable|exists:rekomendasi,id',
            'foto' => 'required|string',
        ]);

        try {
            $image = $request->foto;
            $image_parts = explode(";base64,", $image);
            $image_base64 = base64_decode($image_parts[1]);

            $image_name = uniqid() . '.png';

            Storage::disk('public')->put('identitas/' . $image_name, $image_base64);

            BukuTamu::create([
                'name' => $request->name,
                'nik' => $request->nik,
                'phone' => $request->phone,
                'pekerjaan' => $request->pekerjaan,
                'keperluan' => $request->keperluan,
                'alamat' => $request->alamat,
                'gender' => $request->gender,
                'identitas' => $request->identitas,
                'bidang_id' => $request->bidang,
                'rekomendasi_id' => $request->rekomendasi,
                'foto' => 'identitas/' . $image_name,
            ]);

            return redirect()->route('surveywelcome')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
        
    }
 
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'nik' => 'required|string',
            'phone' => 'required|string',
            'pekerjaan' => 'required|string',
            'keperluan' => 'required|string',
            'alamat' => 'required|string',
            'gender' => 'required|string|in:L,P',
            'identitas' => 'nullable|string',
            'bidang' => 'required|exists:bidangs,id',
            'rekomendasi' => 'nullable|exists:rekomendasi,id',
            'foto' => 'nullable|string',
        ]);

        $guest = BukuTamu::findOrFail($id);

        try {
            $fotoPath = $guest->foto;
            if ($request->has('foto') && $request->foto) {
                $image = $request->foto;
                $image_parts = explode(";base64,", $image);
                $image_base64 = base64_decode($image_parts[1]);

                $image_name = uniqid() . '.png';

                if ($fotoPath && Storage::disk('public')->exists($fotoPath)) {
                    Storage::disk('public')->delete($fotoPath);
                }

                Storage::disk('public')->put('identitas/' . $image_name, $image_base64);
                $fotoPath = 'identitas/' . $image_name;
            }

            $guest->update([
                'name' => $request->name,
                'nik' => $request->nik,
                'phone' => $request->phone,
                'pekerjaan' => $request->pekerjaan,
                'keperluan' => $request->keperluan,
                'alamat' => $request->alamat,
                'gender' => $request->gender,
                'identitas' => $request->identitas,
                'bidang_id' => $request->bidang,
                'rekomendasi_id' => $request->rekomendasi,
                'foto' => $fotoPath,
            ]);

            return redirect()->route('bukutamu.index')->with('success', 'Data berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $guest = BukuTamu::findOrFail($id);

            if ($guest->foto && Storage::disk('public')->exists($guest->foto)) {
                Storage::disk('public')->delete($guest->foto);
            }

            $guest->delete();

            return redirect()->route('bukutamu.index')->with('success', 'Data tamu berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function index(Request $request)
    {
        $query = BukuTamu::query();

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('nik', 'like', '%' . $request->search . '%')
                    ->orWhere('pekerjaan', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('month')) {
            $query->whereMonth('created_at', $request->month);
        }
        
        if ($request->filled('year')) {
            $query->whereYear('created_at', $request->year);
        }
        

    // Mengurutkan data dari terbaru ke terlama berdasarkan created_at
    $guests = $query->orderBy('created_at', 'desc')->paginate(10);

    return view('admin.bukutamu.index', compact('guests'));
}

    public function create()
    {
    $bidangs = Bidang::all();
    $rekomendasi = Rekomendasi::all();

    return view('admin.bukutamu.create', compact('bidangs', 'rekomendasi'));
    }

    public function edit($id)
    {
        $guest = BukuTamu::findOrFail($id);

        return view('admin.bukutamu.edit', [
            'guest' => $guest,
            'bidangs' => Bidang::all(),
            'rekomendasi' => Rekomendasi::all(),
        ]);
    }

    public function show($id)
    {
        $guest = BukuTamu::findOrFail($id);
        return view('admin.bukutamu.show', compact('guest'));
    }

   public function export(Request $request)
    {
        $query = BukuTamu::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('nik', 'like', '%' . $request->search . '%')
                  ->orWhere('pekerjaan', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('month')) {
            $query->whereMonth('created_at', $request->month);
        }

        if ($request->filled('year')) {
            $query->whereYear('created_at', $request->year);
        }

        $guests = $query->orderBy('created_at', 'desc')->get();

        $filterInfo = [
            'search' => $request->search,
            'month' => $request->month,
            'year' => $request->year,
        ];

        $tanggalCetak = Carbon::now()->format('d-m-Y H:i');

        return Pdf::loadView('admin.bukutamu.export', compact('guests', 'filterInfo', 'tanggalCetak'))
                  ->setPaper('a4', 'landscape')
                  ->download('buku_tamu_' . now()->format('Y_m_d_His') . '.pdf');
    }

    private function handleFotoBase64($base64)
    {
        $image_parts = explode(';base64,', $base64);
        if (count($image_parts) !== 2) {
            throw new \Exception("Format foto tidak valid.");
        }

        $image_base64 = base64_decode($image_parts[1]);
        $image_name = uniqid() . '.png';

        Storage::disk('public')->put('identitas/' . $image_name, $image_base64);

        return 'identitas/' . $image_name;
    }
}