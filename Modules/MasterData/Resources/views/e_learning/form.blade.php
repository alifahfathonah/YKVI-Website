<validation-observer v-slot="{ validate, reset }" ref="observer">
    <form method="post" enctype="multipart/form-data" ref="post-form">
        <v-row>
            <v-col>
                <validation-provider rules="required" name="{{ __('Title') }} (ID)" v-slot="{ errors }">
                    <v-text-field
                        class="my-4"
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
            <v-col>
                <validation-provider rules="required" name="{{ __('Title') }} (EN)" v-slot="{ errors }">
                    <v-text-field
                        class="my-4"
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
            <v-col cols="12">
                <validation-provider v-slot="{ errors }" name="{{ __('Description') }} (ID)" rules="required">
                    <h4 class="font-weight-medium">{{ __('Description') }} (ID)</h4>
                    <wysiwyg 
                        class="mt-1"
                        v-model="form_data.description"
                        name="description"
                        label="{{ __('Description') }} (ID)"
                        :error-messages="errors"
                        :disabled="field_state"
                    ></wysiwyg>
                    <h5 class="mb-2 font-weight-medium">* {{ __('required') }}</h5>
                </validation-provider>
            </v-col>
        </v-row>

        <v-row>
            <v-col cols="12">
                <validation-provider v-slot="{ errors }" name="{{ __('Description') }} (EN)" rules="required">
                    <h4 class="font-weight-medium">{{ __('Description') }} (EN)</h4>
                    <wysiwyg 
                        class="mt-1"
                        v-model="form_data.description_en"
                        name="description_en"
                        label="{{ __('Description') }} (EN)"
                        :error-messages="errors"
                        :disabled="field_state"
                    ></wysiwyg>
                    <h5 class="mb-2 font-weight-medium">* {{ __('required') }}</h5>
                </validation-provider>
            </v-col>
        </v-row>
        
        <validation-provider rules="required" name="Link URL" v-slot="{ errors }">
            <v-text-field
                class="mb-4"
                v-model="form_data.link_url_redirect"
                label="Link URL"
                name="link_url_redirect"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* {{ __('required') }}"
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