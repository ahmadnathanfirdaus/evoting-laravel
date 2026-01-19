<?php

namespace App\Http\Controllers;

use App\Http\Requests\CandidateRequest;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CandidateController extends Controller
{
    public function index()
    {
        $data = [
            'candidates' => Candidate::orderBy('id')->get()
        ];
        return Inertia::render('Candidate', $data);
    }

    public function create()
    {
        return Inertia::render('FormCandidate');
    }

    public function store(CandidateRequest $request)
    {
        $validated = $request->validated();

        $file = null;
        if ($request->has('photo')) {
            $file = $request->file('photo');
        }

        if ($validated) {
            $validated['photo'] = $file->store();
            Candidate::create($validated);
        }
        return redirect()->route('calon.index')->with(['success' => 'Berhasil tambah calon']);
    }

    public function edit(Candidate $calon)
    {
        $data = [
            'candidate' => $calon,
        ];
        return Inertia::render('FormCandidate', $data);
    }

    public function update(CandidateRequest $request, Candidate $calon)
    {
        $validated = $request->validated();

        if ($validated) {

            $calon->update($validated);
        }
        return redirect()->route('calon.index')->with(['success' => 'Berhasil update calon']);
    }

    public function destroy(Candidate $calon)
    {
        $calon->delete();
        return redirect()->route('calon.index')->with(['success'  => 'Berhasil hapus calon']);
    }

    public function reset()
    {
        Candidate::query()->delete();
        return back();
    }
}
