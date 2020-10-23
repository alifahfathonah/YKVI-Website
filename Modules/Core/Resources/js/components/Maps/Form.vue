<script type="text/javascript">
	export default {
		components: {
		   
		},
		props: {
			latitudeValue: {
				type: String,
				default: ''
			},
			longitudeValue: {
				type: String,
				default: ''
			},
			latitudeInputName: {
				type: String,
				default: ''
			},
			longitudeInputName: {
				type: String,
				default: ''
			},
			disabled: {
				type: Boolean,
				default: function() {
					return false
				}
			}
		},
		data: () => ({
	    	longitude: '',
	    	latitude: '',
			field_state: false,
		}),
		mounted() {
            this.checkGoogleInit();
        },
		methods: {
		    checkGoogleInit() {
				var self = this;
				setTimeout(function() {
		            if(typeof google === 'undefined') {
		                self.checkGoogleInit();
		            } else {
		                self.GMapsInit();
		            }
		        }, 500);
        	},
        	GMapsInit() {
        		this.latitude = this.latitudeValue;
        		this.longitude = this.longitudeValue;

        		if (this.latitude && this.longitude) {
	                var map = new google.maps.Map(document.getElementById('view-map'), {
			          	center: {lat: parseFloat(this.latitude), lng: parseFloat(this.longitude)},
			          	zoom: 14
			        });

                    var marker = new google.maps.Marker({
    	                position: {lat: parseFloat(this.latitude), lng: parseFloat(this.longitude)},
    	                map: map
    	            });
    	            map.panTo({lat: parseFloat(this.latitude), lng: parseFloat(this.longitude)});
        		} else {
	                var map = new google.maps.Map(document.getElementById('view-map'), {
			          	center: {lat: -6.1767287, lng: 106.829541},
			          	zoom: 14
			        });

			        var marker
        		}

		        map.addListener('click', (mapsMouseEvent) => {
		            this.latitude = mapsMouseEvent.latLng.lat()
		            this.longitude = mapsMouseEvent.latLng.lng()
		            if (marker) {
			            marker.setMap(null)
		            }
		            marker = new google.maps.Marker({
		                position: mapsMouseEvent.latLng,
		                map: map
		            });
		            map.panTo(mapsMouseEvent.latLng);
		        });
        	},


		}
	}
</script>
<style>
#view-map {
	min-height: 400px;
	height: 100%;
}
</style>