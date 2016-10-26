Vue.component('edit_note', {
    template: '#edit-note-template',

    props: ['note_title', 'note_body', 'error_message', 'note_id'],

    methods: {
    	editNote: function(e) {
    		if(!this.note_title)
    			{
    				this.error_message = "You must set a note title.";
    				return; 
    			}
    		if(!this.note_body)
    			{
    				this.error_message = "You must set a note body.";
    				return;
    			}
    		this.error_message = null;
    		this.$http.put('api/v1/notes/'+this.note_id, {title: this.note_title, body: this.note_body})
    			.then((response) => {
    				$('#edit_modal').modal('toggle');
					this.error_message = null;
					this.note_title = null;
					this.note_body = null;
					this.$dispatch('updateNotes');
    			}, (response) => {
    				this.error_message = "Unable to edit note.";
    			});

    			
    	},

    }
});