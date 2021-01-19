<validation-observer v-slot="{ validate, reset }" ref="observer">
    <form method="post" enctype="multipart/form-data" ref="post-form">
        <validation-provider rules="required" name="{{ __('Page Name') }}" v-slot="{ errors }">
            <v-select
                class="mt-4"
                v-model="form_data.page_name"
                :items="['Home', 'E-Learning', 'CME', 'Product', 'SymCard', 'About Us', 'Contact Us']"
                label="{{ __('Page Name') }}"
                name="page_name"
                hint="* {{ __('required') }}"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-select>
        </validation-provider>

        <v-row>
            <v-col md="6">
                <validation-provider rules="required" name="{{ __('Banner Title') }} (ID)" v-slot="{ errors }">
                    <v-text-field
                        v-model="form_data.banner_title"
                        label="{{ __('Banner Title') }} (ID)"
                        name="banner_title"
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
                <validation-provider rules="required" name="{{ __('Banner Title') }} (EN)" v-slot="{ errors }">
                    <v-text-field
                        v-model="form_data.banner_title_en"
                        label="{{ __('Banner Title') }} (EN)"
                        name="banner_title_en"
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


        <div class="mb-4">
            <v-file-input
                small-chips
                multiple
                accept="image/*"
                name="banner_image"
                clear-icon="mdi-eraser-variant"
                label="{{ __('Images') }}"
                prepend-icon="mdi-camera"
                :disabled="field_state"
            >
            </v-file-input>
            <a :href="form_data.url_banner_image" target="_blank" v-if="form_data.url_banner_image">
                <small>{{ __('Click here to view full image') }}</small>
            </a>
        </div>

        <v-switch
            class="my-4"
            v-model="form_data.publish_status"
            name="publish_status"
            label="{{ __('Publish Status') }}"
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
            {{ __('save') }}
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
</validation-observer>