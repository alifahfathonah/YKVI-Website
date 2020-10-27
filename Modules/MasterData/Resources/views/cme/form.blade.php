<validation-observer v-slot="{ validate, reset }" ref="observer">
    <form method="post" enctype="multipart/form-data" ref="post-form">
        <validation-provider rules="required" name="Tipe CME" v-slot="{ errors }">
            <v-select
                class="my-4"
                v-model="form_data.type" 
                :items="['Webinar', 'Live course', 'Live teaching']"
                label="Tipe CME"
                name="type"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-select>
        </validation-provider>

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
        
        <validation-provider rules="required" name="Link Embed Youtube" v-slot="{ errors }">
            <v-text-field
                class="mb-4"
                v-model="form_data.link_embed_youtube"
                label="Link Embed Youtube"
                name="link_embed_youtube"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider rules="required" name="Link Url Zoom" v-slot="{ errors }">
            <v-text-field
                class="mb-4"
                v-model="form_data.link_url_zoom"
                label="Link Url Zoom"
                name="link_url_zoom"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
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