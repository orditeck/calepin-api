<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\DeleteNoteRequest;
use App\Http\Requests\IndexNoteRequest;
use App\Http\Requests\ShowNoteRequest;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Note;
use App\User;
use App\Http\Resources\NoteResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Controllers\Controller;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexNoteRequest $request
     * @return \Illuminate\Http\Resources\Json\ResourceCollection
     */
    public function index(IndexNoteRequest $request): ResourceCollection
    {
        return NoteResource::collection(Note::pimp()->paginate($request->input('limit', 20)));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNoteRequest  $request
     * @return \App\Http\Resources\NoteResource
     */
    public function store(StoreNoteRequest $request): NoteResource
    {
        return new NoteResource(
            User
                ::find($request->input('author_id'))
                ->notes()
                ->create($request->all())
        );
    }

    /**
     * Display the specified resource.
     *
     * @param ShowNoteRequest $request
     * @param Note $note
     * @return \App\Http\Resources\NoteResource
     */
    public function show(ShowNoteRequest $request, Note $note): NoteResource
    {
        return new NoteResource($note->pimp()->findOrFail($note->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateNoteRequest $request
     * @param Note $note
     * @return NoteResource
     */
    public function update(UpdateNoteRequest $request, Note $note): NoteResource
    {
        return new NoteResource(tap($note)->update($request->except(['author_id'])));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteNoteRequest $request
     * @param Note $note
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function delete(DeleteNoteRequest $request, Note $note)
    {
        $note->delete();
        return response()->noContent();
    }
}
