<div class="map-form">
    <div class="form-group row">
        <div class="col-md-12">
            <div id="view-map"></div>
        </div>
    </div>
    <h4>Klik lokasi pada map untuk mendapatkan latitude dan longitude</h4>

    <v-row>
        <v-col cols="12" md="6">
            <v-text-field
                class="my-4"
                v-model="latitude"
                label="Latitude"
                :name="latitudeInputName"
                :disabled="disabled"
                :readonly="!field_state"
            ></v-text-field>
        </v-col>
        <v-col cols="12" md="6">
            <v-text-field
                class="my-4"
                v-model="longitude"
                label="Longitude"
                :name="longitudeInputName"
                :persistent-hint="true"
                :disabled="disabled"
                :readonly="!field_state"
            ></v-text-field>
        </v-col>
    </v-row>
</div>
@section('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDbEzICmcP-W38WP-1GQpAZ7ZVPAakGYr0" async defer></script>
@endsection