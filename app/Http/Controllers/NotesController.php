<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Note;
use App\Notivation\Transformers\NoteTransformer;
use Response;
use Auth;

class NotesController extends ApiController
{

    protected $noteTransformer;

    public function __construct(NoteTransformer $noteTransformer)
    {
        $this->noteTransformer = $noteTransformer;
        // $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user_notes = Auth::user()->notes;
        if($user_notes->isEmpty())
            {
                return $this->respondNotFound('No notes found for this user.');
            }
        return $this->respond([
                'data' => $this->noteTransformer->transformCollection($user_notes->toArray())
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = Note::find($id);

        if(!$note)
            {
                return $this->respondNotFound('No notes found for this user.');        
            }

        return $this->respond([
            'data' => $this->noteTransformer->transform($note)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
