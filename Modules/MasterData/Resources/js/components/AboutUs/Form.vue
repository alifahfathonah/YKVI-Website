<script type="text/javascript">
	import { ValidationObserver, ValidationProvider, extend, localize } from 'vee-validate';
	import { required } from 'vee-validate/dist/rules'
	import id from 'vee-validate/dist/locale/id.json'

	extend('required', required)
    localize('id', id);

	export default {
		components: {
		    ValidationObserver,
		    ValidationProvider
		},
		props: {
			actionForm: {
				type: String,
			},
			redirectUri: {
				type: String,
				required: true
			},
			dataUri: {
				type: String,
				default: ''
			},
			slugUri: {
				type: String,
				default: ''
			},
			deleteUri: {
	            type: String,
	            default: "about-us.delete-image"
	        },
	        deleteUriParameter: {
	            type: String,
	            default: "slug"
	        },
		},
		data: () => ({
			search_kategori: null,
			form_data: {
				title: '',
				description: '',
				title_en: '',
				description_en: '',
				about_us_image: '',
			},
			field_state: false,
			form_alert_state: false,
			form_alert_color: '',
			form_alert_text: '',
			prompt_delete: false,
            delete_loader: false,
		}),
		mounted() {
            this.getFormData();
        },
		methods: {
    		getFormData() {
    			if (this.dataUri) {
    				this.field_state = true

    		        axios
    		            .get(this.dataUri)
    		            .then(response => {
    		            	if (response.data.success) {
    		            		let data = response.data.data
					            console.log(data)
    		            		this.form_data = {
    		            			title: data.title,
    		            			description: data.description,
    		            			title_en: data.title_en,
    		            			description_en: data.description_en,
    		            			about_us_image: data.about_us_image,
    		            			url_about_us_image: data.url_about_us_image,
    		            		}

    			                this.field_state = false
    		            	} else {
    		            		this.form_alert_state = true
		    		            this.form_alert_color = 'error'
		    		            this.form_alert_text = response.data.message
			    		        this.field_state = false
    		            	}
    		            })
    		            .catch(error => {
		            		this.form_alert_state = true
	    		            this.form_alert_color = 'error'
	    		            this.form_alert_text = response.data.message
		    		        this.field_state = false
    		            });
    			}
    		},
			clearForm() {
				this.form_data = {
					title: '',
					description: '',
					title_en: '',
					description_en: '',
					about_us_image: '',
				}
				this.$refs.observer.reset()
			},
	    	submitForm() {
				this.$refs.observer.validate().then((success) => {
					if (!success) {
			          	return;
			        }

			        this.field_state = true

			        this.postFormData()
				});
	    	},
		    postFormData() {
	    		const form_data = new FormData(this.$refs['post-form']);
	    		
	    		if (this.dataUri) {
	    		    form_data.append("_method", "put");
	    		}

	    		axios.post(this.actionForm, form_data)
	    		    .then((response) => {
	    		        if (response.data.success) {
	    		            this.form_alert_state = true
	    		            this.form_alert_color = 'success'
	    		            this.form_alert_text = response.data.message

	    		            setTimeout(() => {
			                    this.goto(this.redirectUri);
			                }, 6000);
	    		        } else {
		    		        this.field_state = false

	    		            this.form_alert_state = true
	    		            this.form_alert_color = 'error'
	    		            this.form_alert_text = response.data.message
	    		        }
	    		    })
	    		    .catch((error) => {
	    		        this.field_state = false
	    		        this.form_alert_state = true
	    		        this.form_alert_color = 'error'
	                    this.form_alert_text = 'Oops, something went wrong. Please try again later.'
	    		    });
		    },
		    promptDeleteItem(item) {
	            this.prompt_delete = true
	            this.selected = item
	        },
		    deleteItem() {
	            this.delete_loader = true
	            axios.put(this.ziggy(this.deleteUri, [this.slugUri]).url())
	                .then((response) => {
	                    if (response.data.success) {
	    		            this.form_alert_state = true
	    		            this.form_alert_color = 'success'
	    		            this.form_alert_text = response.data.message

	    		            setTimeout(() => {
			                    location.reload();
			                }, 2000);
	    		        } else {
		    		        this.field_state = false

	    		            this.form_alert_state = true
	    		            this.form_alert_color = 'error'
	    		            this.form_alert_text = response.data.message
	    		        }
	                    this.delete_loader = false
	                    this.prompt_delete = false
	                })
	                .catch((error) => {
	                    this.form_alert = true
	                    this.form_alert_state = 'error'
	                    this.form_alert_text = 'Oops, something went wrong. Please try again later.'

	                    this.delete_loader = false
	                    this.prompt_delete = false
	                });
	        },
		}
	}
</script>