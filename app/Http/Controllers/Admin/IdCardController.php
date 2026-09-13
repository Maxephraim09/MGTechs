<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IdCard;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class IdCardController extends Controller
{
    public function index()
    {
        return view('admin.id-cards.index', [
            'cards' => IdCard::with('user')->latest()->paginate(20),
            'users' => User::active()->orderBy('name')->get(['id', 'name', 'role']),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'card_number' => 'nullable|string|max:255|unique:id_cards,card_number',
            'role_label' => 'nullable|string|max:255',
            'expires_at' => 'nullable|date',
            'is_active' => 'nullable|boolean',
        ]);

        IdCard::create($validated + [
            'card_number' => $validated['card_number'] ?? 'ID-'.now()->format('Ymd').'-'.Str::upper(Str::random(6)),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return back()->with('success', 'ID card created.');
    }

    public function update(Request $request, IdCard $idCard)
    {
        $validated = $request->validate([
            'role_label' => 'nullable|string|max:255',
            'expires_at' => 'nullable|date',
            'is_active' => 'nullable|boolean',
        ]);

        $idCard->update($validated + ['is_active' => $request->boolean('is_active')]);

        return back()->with('success', 'ID card updated.');
    }

    public function destroy(IdCard $idCard)
    {
        $idCard->delete();

        return back()->with('success', 'ID card deleted.');
    }
}
