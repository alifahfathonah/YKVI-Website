<validation-observer v-slot="{ validate, reset }" ref="observer">
    <form method="post" enctype="multipart/form-data" ref="post-form">
        <validation-provider rules="required" name="{{ __('CME Type') }}" v-slot="{ errors }">
            <v-select
                class="mt-4"
                v-model="form_data.type" 
                :items="['Webinar', 'Live course', 'Live teaching']"
                label="{{ __('CME Type') }}"
                name="type"
                hint="* {{ __('required') }}"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-select>
        </validation-provider>
        
        <v-row>
            <v-col md="6">
                <validation-provider rules="required" name="{{ __('Title') }} (ID)" v-slot="{ errors }">
                    <v-text-field
                        v-model="form_data.title"
                        label="{{ __('Title') }} (ID)"
                        name="title"
                        clearable
                        clear-icon="mdi-eraser-variant"
                        hint="* {{ __('required') }}"
                        :persistent-hint="true"
                        :error-messages="errors"
                        :disabled="field_state"
                    ></v-text-field>
                </validation-provider>
            </v-col>
            <v-col md="6">
                <validation-provider rules="required" name="{{ __('Title') }} (EN)" v-slot="{ errors }">
                    <v-text-field
                        v-model="form_data.title_en"
                        label="{{ __('Title') }} (EN)"
                        name="title_en"
                        clearable
                        clear-icon="mdi-eraser-variant"
                        hint="* {{ __('required') }}"
                        :persistent-hint="true"
                        :error-messages="errors"
                        :disabled="field_state"
                    ></v-text-field>
                </validation-provider>
            </v-col>
        </v-row>
        
        <validation-provider rules="required" name="Link Embed Youtube" v-slot="{ errors }">
            <v-text-field
                class="mb-4"
                v-model="form_data.link_embed_youtube"
                label="Link Embed Youtube"
                name="link_embed_youtube"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* {{ __('required') }}"
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
                hint="* {{ __('required') }}"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <v-switch
            class="my-4"
            v-model="form_data.is_home"
            name="is_home"
            label="{{ __('Featured Video') }}"
            :true-value="1"
            :false-value="0"
            inset
            :disabled="field_state"
        ></v-switch>

        <v-btn
        	class="mr-4 mt-5"
          	:loading="field_state"
          	:disabled="field_state"
            color="primary"
            @click="submitForm"
        >
            {{ __('save') }}
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
            {{ __('clear') }}
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