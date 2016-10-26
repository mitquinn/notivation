Vue.component('notes', {
    template: '#notes-template',

    data() {
    	return {
    		notes: []
    	};
    },

    ready() {
        this.getNotes();
    },

    events: {
        'notesRefresh': function() {
            this.getNotes();
        }
    },

    methods: {
        getNotes: function() { 
           	this.$http.get('api/v1/notes').then((response) => {
				this.notes = response.body.data;
			}, (response) => {
				console.log("There was an error getting the notes.");
			});
        },
    	deleteNote: function(note) {
    		var note_id = note.id;

    		this.$http.delete('api/v1/notes/'+note_id).then((response) => {
			    this.notes.$remove(note);
			  }, (response) => {
			   	console.log("error deleting note.");
			  });
    	},
    }
});