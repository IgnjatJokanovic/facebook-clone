<?php

namespace App\Http\Controllers;

use App\Models\Emotion;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
    public function index()
    {
        $emotions = Emotion::all();
        return response()->json($emotions, 200);
    }

    public function create()
    {
        # code...
    }

    public function update()
    {
        # code...
    }

    public function delete()
    {
        # code...
    }
}
