<validation-observer v-slot="{ validate, reset }" ref="observer">
    <form method="post" enctype="multipart/form-data" ref="post-form">
        <v-row>
            <v-col md="6">
                <validation-provider rules="required" name="{{ __('Title') }}" v-slot="{ errors }">
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

        <v-row>
            <v-col md="6">
                <validation-provider v-slot="{ errors }" name="{{ __('Description') }} (ID)" rules="required">
                    <v-textarea 
                        v-model="form_data.description"
                        name="description"
                        label="{{ __('Description') }} (ID)"
                        clearable
                        clear-icon="mdi-eraser-variant"
                        hint="* {{ __('required') }}"
                        :persistent-hint="true"
                        :error-messages="errors"
                        :disabled="field_state"
                    ></v-textarea>
                </validation-provider>
            </v-col>
            <v-col md="6">
                <validation-provider v-slot="{ errors }" name="{{ __('Description') }} (EN)" rules="required">
                    <v-textarea 
                        v-model="form_data.description_en"
                        name="description_en"
                        label="{{ __('Description') }} (EN)"
                        clearable
                        clear-icon="mdi-eraser-variant"
                        hint="* {{ __('required') }}"
                        :persistent-hint="true"
                        :error-messages="errors"
                        :disabled="field_state"
                    ></v-textarea>
                </validation-provider>
            </v-col>
        </v-row>
        
        <div class="my-4">
            <v-file-input
                small-chips
                accept="image/*"
                name="about_us_image"
                clear-icon="mdi-eraser-variant"
                label="{{ __('Images') }}"
                prepend-icon="mdi-camera"
                :disabled="field_state"
            >
            </v-file-input>
            <a :href="form_data.url_about_us_image" target="_blank" v-if="form_data.about_us_image">
                <small>{{ __('Click here to view full image') }}</small>
            </a>
        </div>

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