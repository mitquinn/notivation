<?php 
namespace App\Notivation\Transformers; 

class NoteTransformer extends Transformer {

	public function transform($note)
		{
			return [
				'id' => $note['id'],
				'title' => $note['title'], 
				'body' => $note['body'],
			];
		}

	public function tagtransform($tag)
		{
			return [
				'id' => $tag['id'],
				'name' => $tag['title'], 
			];
		}

}