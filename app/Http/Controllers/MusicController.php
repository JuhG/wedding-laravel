<?php

namespace App\Http\Controllers;

use App\Music;
use Illuminate\Http\Request;

class MusicController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->validate([
            'name' => 'nullable',
            'list' => 'required|array',
            'list.artist' => 'string',
            'list.track' => 'string',
        ]);

        $name = $data['name'];
        $all = collect($data['list'])->each(function ($item) use ($name) {
            $music = Music::make([
                'name' => $name,
                'artist' => $item['artist'],
                'track' => $item['track'],
            ]);

            return $music->save();
        });

        return [
            'response' => 'success',
            'number' => $all->count(),
        ];
    }
}
