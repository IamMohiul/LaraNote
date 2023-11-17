<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrashedNoteController extends Controller
{
    public function index(){
        $notes = Note::whereBelongsTo(Auth::user())->onlyTrashed()->latest('updated_at')->paginate();
        return view('notes.index')->with('notes', $notes);
    }

    public function show(Note $note){
        if(!$note->user->is(Auth::user())){
            abort(403, "You don't have permission");
        }

        return view('notes.show')->with('note', $note);
    }

    public function restore(Note $note){
        if(!$note->user->is(Auth::user())){
            abort(403, "You don't have permission");
        }

        $note->restore();

        return to_route('notes.show', $note)->with('success', 'Note Restored Successfully');
    }

    public function destroy(Note $note){
        if(!$note->user->is(Auth::user())){
            abort(403, "You don't have permission");
        }
        $note->forceDelete();

        return to_route('trashed.index')->with('success', 'Deleted Forever.');
    }
}
