Vue.component('add_tag', {
    template: '#add-tag-template',
    
    data() {
        return {
            name: ''
        };
    },

    methods: {
            addTag: function() { 
                var note_id = this.$parent.note_id;
                this.$http.post('api/v1/notes/addtag', {name: this.name, note_id: note_id})
                    .then((response) => {
                        this.name = null;
                        this.$dispatch('updateTags');
                    }, (response) => {
                        this.error_message = "Unable to create create tag.";
                    });
            },
    }
});