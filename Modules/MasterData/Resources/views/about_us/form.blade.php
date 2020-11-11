<validation-observer v-slot="{ validate, reset }" ref="observer">
    <form method="post" enctype="multipart/form-data" ref="post-form">
        <validation-provider rules="required" name="Judul" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.title"
                label="Judul"
                name="title"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider v-slot="{ errors }" name="Deskripsi" rules="required">
            <v-textarea 
                class="my-4"
                v-model="form_data.description"
                name="description"
                label="Deskripsi"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-textarea>
        </validation-provider>
        
        <div class="my-4">
            <v-file-input
                small-chips
                accept="image/*"
                name="about_us_image"
                clear-icon="mdi-eraser-variant"
                label="Gambar"
                prepend-icon="mdi-camera"
                :disabled="field_state"
            >
            </v-file-input>
            <a :href="form_data.url_about_us_image" target="_blank" v-if="form_data.about_us_image">
                <small>Click here to view full image</small>
            </a>
        </div>

        <v-btn
        	class="mr-4 mt-5"
          	:loading="field_state"
          	:disabled="field_state"
            color="primary"
            @click="submitForm"
        >
            simpan
            <template v-slot:loader>
                <span class="custom-loader">
                  	<v-icon light>mdi-cached</v-icon>
                </span>
            </template>
        </v-btn>
        <v-btn
            class="mt-5"
	        type="button"
	        @click="clearForm"
	        :disabled="field_state"
	    >
            hapus
        </v-btn>
    </form>

    <v-snackbar
        v-model="form_alert_state"
        top
        multi-line
        :color="form_alert_color"
        elevation="5"
        timeout="6000"
    >
    	@{{ form_alert_text }}
    </v-snackbar>
    <v-overlay
        :absolute="true"
        opacity="0"
        :value="field_state"
    ></v-overlay>
</validation-observer>