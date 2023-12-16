<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoteController extends Controller
{
    // public function index($id = 25) // parametro dinamico por defecto 25.
    public function index($id)
    {
        return view('note.index', compact('id'));
    }
}
