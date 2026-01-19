<?php

namespace App\Http\Controllers;

use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class TokenController extends Controller
{
    public function index()
    {
        $tokens = Token::all();
        $data = [
            'tokens' => $tokens,
        ];
        return Inertia::render('Token', $data);
    }

    public function store(Request $request)
    {
        $amount = intval($request->amount);
        for ($i = 0; $i < $amount; $i++) {
            $token = strtolower(Str::random(6));
            Token::create(['token' => $token]);
        }
        return back()->with(['success' => 'Berhasil generate token']);
    }

    public function reset()
    {
        Token::query()->delete();
        return back();
    }
}
