<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Request\CreateNoteRequest;
use App\Http\Requests;
use App\Note;
use App\Tag;
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
		Auth::user()->notes()->create($request->all());
		return $this->respondWithSuccess("The note has been created.");
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$user_id = Auth::user()->id;


		$note = Note::where('id', $id)->where('user_id', $user_id)->first();
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
		$user_id = Auth::user()->id;
		$note = Note::where('id', $id)->where('user_id', $user_id)->first();
		if(!$note)
			{
				return $this->respondNotFound('Unable to find note with that user.');
			}
		$note->title = $request->title;
		$note->body = $request->body;
		$note->save();
		return $this->respondWithSuccess("The note has been updated.");

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$user_id = Auth::user()->id;
		$note = Note::where('id', $id)->where('user_id', $user_id)->first();
		
		if(!$note)
			{
				return $this->respondNotFound('Unable to find note with that user.');
			}

		if($note->delete())
			{
				return $this->respondDeleted('The note has been deleted.');
			}   
	}

	public function gettags($note_id)
	{

		$user_id = Auth::user()->id;
		$note = Note::where('id', $note_id)->where('user_id', $user_id)->first();

		$note_tags = $note->tags;
		if(!$note_tags)
			{
				return $this->respondNotFound('Unable to find any tags for that note.');
			}
		return $this->respond([
				'data' => $note_tags->toArray(),
		]);
	}
	public function addtag(Request $request)
	{
		$user_id = Auth::user()->id;
		//Check if the tag exists
		$tag = Tag::where('name', $request->name)->where('user_id', $user_id)->first();
		if($tag)
			{
				$tag_id = $tag->id;
			}
		else
			{
				$tag = Auth::user()->tags()->create(['name' => $request->name]);
				$tag_id = $tag->id;
			}

		//Attach Note/Tag to Pivot Table
		$note = Note::where('id', $request->note_id)->where('user_id', $user_id)->first();
		$note->tags()->attach($tag_id);
		
		return $this->respondWithSuccess("The tag has been created.");


	}
	public function removetag($tag_id)
	{
		$user_id = Auth::user()->id;
		$tag = Tag::where('id',$tag_id)->where('user_id', $user_id)->first();
		if(!$tag)
			{
				return $this->respondNotFound('Unable to find that tag.');
			}
		if($tag->delete())
			{
				return $this->respondDeleted('The tag has been deleted.');
			}

	}

}
