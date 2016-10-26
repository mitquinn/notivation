@extends('spark::layouts.app')

@section('content')

<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">Welcome to Notivation!</div>
		<div class="panel-body">
			<p>Welcome to Notivation!, Press the + sign on the top right to add a new note.</p>
			<p>You can tag your notes by pressing the edit button in the newly created note panel box.</p>
		</div>
	</div>
	<notes></notes>
</div>


<template id="notes-template">
	<div class="col-md-4" v-for="note in notes">
		<div class="panel panel-default">
			<div class="panel-heading">@{{ note.title }}
				<ul class="list-inline pull-right">
					{{-- <li><a href="#" v-on:click="updateNote(note)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></li> --}}
					<edit_note 
						v-bind:note_id="note.id"
						v-bind:note_title="note.title"
						v-bind:note_body="note.body">
					</edit_note>
					<li><a href="#" v-on:click="deleteNote(note)" ><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
				</ul>
			</div>
			<div class="panel-body">
				<p>@{{ note.body }}</p>
				<tags v-bind:note_id="note.id">
				</tags>

			</div>

		</div>
	</div>
</template>

<template id="new-note-template" >
	<style type="text/css">
		.modal-backdrop {
			z-index: 1;
		}
	</style>
	<li>
		<a href="#new" data-toggle="modal" data-target="#note_modal" class="has-activity-indicator">
			<div class="navbar-icon">
				<i class="icon fa fa-plus-square" aria-hidden="true"></i>
			</div>
		</a>
	</li>
	<!-- Modal -->
	<div id="note_modal" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">New Note</h4>
	      </div>
	      <div class="modal-body">
	      	
			<div v-if="error_message" class="alert alert-warning">
				@{{ error_message }}
			</div>
			<div class="form-group">
				<label for="note_title">Note Title:</label>
				<input type="input" class="form-control" id="note_title" v-model="note_title">
			</div>
			<div class="form-group">
				<label for="note_body">Note Body:</label>
				<textarea class="form-control" rows="5" id="note_body" v-model="note_body"></textarea>
			</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary"  v-on:click="newNote">Save</button>
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	      </div>
	    </div>

	  </div>
	</div>
</template>

<template id="edit-note-template" >
	<style type="text/css">
		.modal-backdrop {
			z-index: 1;
		}
	</style>
	<li>
		<a href="#edit" data-toggle="modal" data-target="#edit_modal" class="has-activity-indicator">
			<div class="navbar-icon">
				<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
			</div>
		</a>
	</li>
	<!-- Modal -->
	<div id="edit_modal" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Edit Note</h4>
	      </div>
	      <div class="modal-body">
	      	
			<div v-if="error_message" class="alert alert-warning">
				@{{ error_message }}
			</div>
			<div class="form-group">
				<label for="note_title">Note Title:</label>
				<input type="input" class="form-control" id="note_title" v-model="note_title">
			</div>
			<div class="form-group">
				<label for="note_body">Note Body:</label>
				<textarea class="form-control" rows="5" id="note_body" v-model="note_body"></textarea>
			</div>
			<add_tag></add_tag>
			<tags></tags>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary"  v-on:click="editNote">Save</button>
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	      </div>
	    </div>
	  </div>
	</div>
</template>

<template id="tag-template">
	<ul class="list-inline">
	  <li v-for="tag in tags">
	  	@{{tag.name}} <a href="#removeTag" v-on:click="removeTag(tag.id)"><i class="fa fa-times" aria-hidden="true"></i></a>
	  </li>
	</ul>
</template>

<template id="add-tag-template">
	<div class="form-group">
		<label for="tag">Add Tag:</label>
		<input placeholder="Press Enter to add a Tag" v-model="name" type="input" class="form-control" id="tag"  @keyup.enter="addTag()">
	</div>
</template>

@endsection
