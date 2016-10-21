Vue.component('home', {
    props: ['user'],

    ready() {
        this.$http.get('api/v1/notes/1')
        	.then(response => {
        		console.log(response.data);
        	});
    }


});
