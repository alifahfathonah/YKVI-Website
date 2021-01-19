<validation-observer v-slot="{ validate, reset }" ref="observer">
    <form method="post" enctype="multipart/form-data" ref="post-form">
        <validation-provider rules="required" name="{{ __('Question') }} (ID)" v-slot="{ errors }">
            <v-text-field
            	class="my-4"
                v-model="form_data.question"
                label="{{ __('Question') }} (ID)"
    			name="question"
    			clearable
    			clear-icon="mdi-eraser-variant"
	    		hint="* {{ __('required') }}"
	    		:persistent-hint="true"
	    		:error-messages="errors"
	    		:disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <v-row>
            <v-col cols="12">
                <validation-provider v-slot="{ errors }" name="{{ __('Answer') }} (ID)" rules="required">
                    <h4 class="font-weight-medium">{{ __('Answer') }}</h4>
                    <wysiwyg 
                        class="mt-1"
                        v-model="form_data.answer"
                        name="answer"
                        label="{{ __('Answer') }} (ID)"
                        :error-messages="errors"
                        :disabled="field_state"
                    ></wysiwyg>
                    <h5 class="mb-2 font-weight-medium">* {{ __('required') }}</h5>
                </validation-provider>
            </v-col>
        </v-row>

        <validation-provider rules="required" name="{{ __('Question') }} (EN)" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.question_en"
                label="{{ __('Question') }} (EN)"
                name="question_en"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* {{ __('required') }}"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>
        
        <v-row>
            <v-col cols="12">
                <validation-provider v-slot="{ errors }" name="{{ __('Answer') }} (EN)" rules="required">
                    <h4 class="font-weight-medium">{{ __('Answer') }} (EN)</h4>
                    <wysiwyg 
                        class="mt-1"
                        v-model="form_data.answer_en"
                        name="answer_en"
                        label="{{ __('Answer') }} (EN)"
                        :error-messages="errors"
                        :disabled="field_state"
                    ></wysiwyg>
                    <h5 class="mb-2 font-weight-medium">* {{ __('required') }}</h5>
                </validation-provider>
            </v-col>
        </v-row>

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
    <v-overlay
        :absolute="true"
        opacity="0"
        :value="field_state"
    ></v-overlay>
</validation-observer>