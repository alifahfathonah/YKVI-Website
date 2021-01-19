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
				required: true
			},
			redirectUri: {
				type: String,
				required: true
			},
			dataUri: {
				type: String,
				default: ''
			},
			deleteUri: {
	            type: String,
	            default: "product-details.destroy"
	        },
	        deleteUriParameter: {
	            type: String,
	            default: "slug"
	        },
	        filterProductCategory: {
			    type: Array,
			    default: function () {
			        return []
			    }
			},
		},
		data: () => ({
			search_kategori: null,
			form_data: {
				name: '',
				name_en: '',
				description: '',
				description_en: '',
				detail: '',
				detail_en: '',
				category_id: '',
		    	product_image: [],
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
    			console.log(this);
    			if (this.dataUri) {
    				this.field_state = true

    		        axios
    		            .get(this.dataUri)
    		            .then(response => {
    		            	if (response.data.success) {
    		            		let data = response.data.data
    		            			console.log(data)
    		            		this.form_data = {
    		            			category_id: data.category_id,
    		            			name: data.name,
    		            			name_en: data.name_en,
    		            			description: data.description,
    		            			description_en: data.description_en,
    		            			detail: data.detail,
    		            			detail_en: data.detail_en,
    		            			publish_status: data.publish_status,
    		            			product_details: data.product_details,
	            			    	url_product_image: data.url_product_image,
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
					name: '',
					name_en: '',
					description: '',
					description_en: '',
					detail: '',
					detail_en: '',
					category_id: '',
			    	product_image: [],
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
	    		    form_data.append("description", this.form_data.description)
	    		    form_data.append("description_en", this.form_data.description_en)
	    		    form_data.append("detail", this.form_data.detail)
	    		    form_data.append("detail_en", this.form_data.detail_en)
	    		}
	    		form_data.append("description", this.form_data.description)
	    		form_data.append("description_en", this.form_data.description_en)
	    		form_data.append("detail", this.form_data.detail)
    		    form_data.append("detail_en", this.form_data.detail_en)

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
	            axios.delete(this.ziggy(this.deleteUri, [this.selected[this.deleteUriParameter]]).url())
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