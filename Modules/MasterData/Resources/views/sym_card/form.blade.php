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

        <v-row>
            <v-col cols="12">
                <validation-provider v-slot="{ errors }" name="Deskripsi" rules="required">
                    <h3 class="font-weight-medium">Deskripsi</h3>
                    <wysiwyg 
                        class="mt-1"
                        v-model="form_data.description"
                        name="description"
                        label="Deskripsi"
                        :error-messages="errors"
                        :disabled="field_state"
                    ></wysiwyg>
                    <h5 class="mb-2 font-weight-medium">* harus diisi</h5>
                </validation-provider>
            </v-col>
        </v-row>

        <div class="my-4">
            <v-file-input
                small-chips
                accept="image/*"
                name="sym_card_image"
                clear-icon="mdi-eraser-variant"
                label="Gambar"
                prepend-icon="mdi-camera"
                :disabled="field_state"
            >
            </v-file-input>
            <a :href="form_data.url_sym_card_image" target="_blank" v-if="form_data.url_sym_card_image">
                <small>Click here to view full image</small>
            </a>
        </div>
        
        <validation-provider name="Link Embed Youtube" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.link_embed_youtube"
                label="Link Embed Youtube"
                name="link_embed_youtube"
                clearable
                clear-icon="mdi-eraser-variant"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

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