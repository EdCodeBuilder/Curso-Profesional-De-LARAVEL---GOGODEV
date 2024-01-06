<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Http\Requests\NoteRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\NoteResource;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteController extends Controller
{
    public function index():JsonResource
    {
        // return response()->json(Note::all(), 200);
        return NoteResource::collection(Note::all()); // uso del NoteResource para la manipulacion de la colleccion.
    }

    public function store(NoteRequest $request):JsonResponse
    {
        $note = Note::create($request->all());
        return response()->json([
            'success' => true,
            // 'data' => $note
            'data'=> new NoteResource($note)
        ], 201);
    }

    // public function show($id):JsonResponse
    public function show($id):JsonResource
    {
        // return response()->json(Note::find($id), 200);
        return new NoteResource(Note::find($id));
    }

    public function update(NoteRequest $request, $id):JsonResponse
    {
        $note = Note::find($id);
        $note->title = $request->title;
        $note->content = $request->content;
        $note->save();

        return response()->json([
            'success' => true,
            // 'data' => $note
            'data' => new NoteResource($note)
        ], 200);
        // End of sixth episode
    }

    public function destroy($id):JsonResponse
    {
        Note::find($id)->delete();
        return response()->json([
            'success' => true
        ], 200);
    }
}
