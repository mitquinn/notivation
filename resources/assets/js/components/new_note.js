Vue.component('new_note', {
    props: ['user'],



    ready() {
    	console.log("test");
     //    this.$http.get('api/v1/notes')
     //    	.then(response => {
     //    		console.log(response.data);
     //    	});
    }
});
