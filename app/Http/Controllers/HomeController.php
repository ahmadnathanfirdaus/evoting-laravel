<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Home');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['token' => 'required']);
        if ($validated) {
            $inputToken = $request->token;
            $validToken = Token::where('token', $inputToken)->first();
            if ($validToken) {
                $validToken = $validToken->token;
                return redirect('/vote/' . $validToken);
            }
            return back()->with(['invalidToken' => 'Token tidak valid']);
        }
    }

    public function indexVote(Token $token)
    {
        $data = [
            'candidates' => Candidate::orderBy('id')->get(),
            'token' => $token
        ];
        return Inertia::render('Vote', $data);
    }

    public function storeVote(Request $request, Token $token)
    {
        $candidates = $request->candidates;
        foreach ($candidates as $c) {
            $candidate = Candidate::find($c);
            $candidate->update(['vote_count' => $candidate['vote_count'] + 1]);
        }
        $token->delete();
        return Inertia::render('VoteDone');
    }
}
