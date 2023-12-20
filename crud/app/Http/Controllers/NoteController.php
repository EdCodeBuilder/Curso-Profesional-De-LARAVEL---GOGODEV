<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NoteController extends Controller
{
    public function index(): View // Tipado de datos ": View"
    {
        $notes = Note::all();
        return view('note.index', compact('notes'));
    }

    public function create(): View
    {
        return view('note.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Note::create($request->all()); // Atajo mayor.

        /* Note::create([
            'title' => $request->title,
            'description' => $request->description
        ]); // Atajo. */

        /* $note = new Note;
        $note->title = $request->title;
        $note->description = $request->description;
        $note->save(); */

        return redirect()->route('note.index');
    }

    public function edit(Note $note): View
    {
        // $myNote = Note::find($note);
        return view('note.edit', compact('note'));
    }

    public function update(Request $request, Note $note): RedirectResponse
    // public function update(Request $request, $note)
    {
        $note->update($request->all());
        /* $note = Note::find($note);
        $note->title = $request->title;
        $note->description = $request->description;
        $note->save(); */
        return redirect()->route('note.index');
    }

    public function show(Note $note): View
    {
        return view('note.show', compact('note'));
    }

    public function destroy(Note $note): RedirectResponse
    {
        $note->delete();
        return redirect()->route('note.index');
    }
}
