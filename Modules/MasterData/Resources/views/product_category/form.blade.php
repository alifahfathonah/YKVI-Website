<validation-observer v-slot="{ validate, reset }" ref="observer">
    <form method="post" enctype="multipart/form-data" ref="post-form">
        <validation-provider rules="required" name="{{ __('Product Category Name') }} (ID)" v-slot="{ errors }">
            <v-text-field
            	class="my-4"
                v-model="form_data.category_name"
                label="{{ __('Product Category Name') }} (ID)"
    			name="category_name"
    			clearable
    			clear-icon="mdi-eraser-variant"
	    		hint="* {{ __('required') }}"
	    		:persistent-hint="true"
	    		:error-messages="errors"
	    		:disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider rules="required" name="{{ __('Product Category Name') }} (EN)" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.category_name_en"
                label="{{ __('Product Category Name') }} (EN)"
                name="category_name_en"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* {{ __('required') }}"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <v-btn
        	class="mr-4 mt-4"
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
            class="mt-4"
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

