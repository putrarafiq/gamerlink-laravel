<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    // 🧩 Tampilkan semua teman mabar (dengan filter game)
    public function index(Request $request)
    {
        $selectedGame = $request->get('game');

        if ($selectedGame) {
            $players = Player::where('game', $selectedGame)->latest()->get();
        } else {
            $players = Player::latest()->get();
        }

        $games = ['Mobile Legends', 'Free Fire', 'Roblox'];

        return view('players.index', compact('players', 'games', 'selectedGame'));
    }

    // 🧩 Form tambah teman mabar
    public function create()
    {
        return view('players.create');
    }

    // 🧩 Simpan data teman mabar baru
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'game' => 'required',
        'whatsapp_number' => 'required',
        'photo' => 'nullable|image|max:2048',
    ]);

    $path = $request->file('photo') ? $request->file('photo')->store('players', 'public') : null;

    $player = new Player([
        'name' => $request->name,
        'game' => $request->game,
        'whatsapp_number' => $request->whatsapp_number,
        'photo_path' => $path,
    ]);

    // Tambahkan ini biar kolom user_id terisi
    $player->user_id = auth()->id();
    $player->save();

    return redirect()->route('players.index')->with('success', 'Teman mabar berhasil ditambahkan!');
}

    // 🧩 Form edit data
    public function edit($id)
    {
        $player = Player::findOrFail($id);

        // pastikan hanya pemilik data yang bisa edit
        if (session('user_id') != $player->user_id) {
            abort(403, 'Kamu tidak punya akses untuk edit data ini.');
        }

        return view('players.edit', compact('player'));
    }

    // 🧩 Proses update data
    public function update(Request $request, $id)
    {
        $player = Player::findOrFail($id);

        if (session('user_id') != $player->user_id) {
            abort(403);
        }

        $data = $request->validate([
            'name' => 'required',
            'game' => 'required',
            'whatsapp_number' => 'required',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo_path'] = $request->file('photo')->store('players', 'public');
        }

        $player->update($data);

        return redirect()->route('players.index')->with('success', 'Data berhasil diperbarui!');
    }

    // 🧩 Hapus data teman mabar
    public function destroy($id)
    {
        $player = Player::findOrFail($id);

        if (session('user_id') != $player->user_id) {
            abort(403);
        }

        $player->delete();

        return redirect()->route('players.index')->with('success', 'Data berhasil dihapus!');
    }
}
