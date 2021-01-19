<validation-observer v-slot="{ validate, reset }" ref="observer">
    <form method="post" enctype="multipart/form-data" ref="post-form">
        <validation-provider rules="required" name="{{ __('Sender Name') }}" v-slot="{ errors }">
            <v-text-field
            	class="my-4"
                v-model="form_data.name"
                label="{{ __('Sender Name') }}"
    			name="name"
                :readonly="true"
	    		:persistent-hint="true"
	    		:error-messages="errors"
	    		:disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider rules="required" name="{{ __('Sender Email') }}" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.email"
                label="{{ __('Sender Email') }}"
                name="email"
                :readonly="true"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider v-slot="{ errors }" name="{{ __('Phone Number') }}" rules="required|max:15">
            <v-text-field
                class="my-4"
                v-model="form_data.phone_number"
                label="{{ __('Phone Number') }}"
                name="phone_number"
                :readonly="true"
                :persistent-hint="true"
                placeholder="+62"
                :counter="16"
                v-mask="'+62############'"
                :error-messages="errors"
                :readonly="field_state">
            </v-text-field>
        </validation-provider>

        <validation-provider rules="required" name="{{ __('Subject') }}" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.subject"
                label="{{ __('Subject') }}"
                name="subject"
                :readonly="true"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider v-slot="{ errors }" name="{{ __('Message') }}" rules="required">
            <v-textarea 
                class="my-4"
                v-model="form_data.message"
                name="message"
                label="{{ __('Message') }}"
                :readonly="true"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-textarea>
        </validation-provider>
        
        <v-btn
            class="mt-4"
            outlined 
            :disabled="field_state"
            :href="redirectUri">
            {{ __('Back') }}
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