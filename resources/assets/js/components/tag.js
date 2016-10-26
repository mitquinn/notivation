Vue.component('tags', {
    template: '#tag-template',

    props: ['note_id'],
 
    data() {
        return {
            tags: []
        };
    },

    ready() {
        this.getTags();
    },

    events: {
        'tagsRefresh': function() {
            this.getTags();
        }
    },

    methods: {
            getTags: function() { 
                if(!this.note_id)
                    {
                        this.note_id = this.$parent.note_id;                      
                    }

                this.$http.get('api/v1/notes/gettags/'+this.note_id).then((response) => {
                    this.tags = response.body.data;
                }, (response) => {
                    console.log("There was an error getting the notes.");
                });
            },

            removeTag: function(tag_id) {
            	console.log(tag_id);
            	this.$http.delete('api/v1/notes/removetag/'+tag_id).then((response) => {
                    this.getTags(); 
                }, (response) => {
                    console.log("There was an error removing the tag.");
                });

            },
    }
});