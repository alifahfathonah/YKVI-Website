<validation-observer v-slot="{ validate, reset }" ref="observer">
    <form method="post" enctype="multipart/form-data" ref="post-form">
        <validation-provider rules="required" name="Nama Halaman" v-slot="{ errors }">
            <v-select
                class="my-4"
                v-model="form_data.page_name" 
                :items="['Home', 'E-Learning', 'Product', 'Contact Us']"
                label="Menu"
                name="page_name"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-select>
        </validation-provider>

        <validation-provider rules="required" name="Judul Banner" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.banner_title"
                label="Judul Banner"
                name="banner_title"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <div class="mb-4">
            <v-file-input
                small-chips
                multiple
                accept="image/*"
                name="banner_image"
                clear-icon="mdi-eraser-variant"
                label="Gambar Banner"
                prepend-icon="mdi-camera"
                :disabled="field_state"
            >
            </v-file-input>
            <a :href="form_data.url_banner_image" target="_blank">
                <small>@{{ form_data.url_banner_image }}</small>
            </a>
        </div>

        <v-switch
            class="my-4"
            v-model="form_data.publish_status"
            name="publish_status"
            label="Publish Status"
            :true-value="1"
            :false-value="0"
            inset
            :disabled="field_state"
        ></v-switch>

        <v-btn
        	class="mr-4"
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
</validation-observer>