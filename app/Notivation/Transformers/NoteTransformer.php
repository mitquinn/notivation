<?php 
namespace App\Notivation\Transformers; 

class NoteTransformer extends Transformer {

	public function transform($note)
		{
			return [
				'title' => $note['title'], 
				'body' => $note['body'],
			];
		}


}