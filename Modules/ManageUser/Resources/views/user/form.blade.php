<validation-observer v-slot="{ validate, reset }" ref="observer">
    <form method="post" enctype="multipart/form-data" ref="post-form">
        <validation-provider rules="required" name="{{ __('Full Name') }}" v-slot="{ errors }">
            <v-text-field
            	class="my-4"
                v-model="form_data.nama"
                label="{{ __('Full Name') }}"
    			name="name"
    			clearable
    			clear-icon="mdi-eraser-variant"
	    		hint="* {{ __('required') }}"
	    		:persistent-hint="true"
	    		:error-messages="errors"
	    		:disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider rules="required|email" name="{{ __('Email Address') }}" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.email"
                label="{{ __('Email Address') }}"
                name="email"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* {{ __('required') }}"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider :rules="{ required: true, max: 15, regex: /^\+\d*$/ }" name="{{ __('Phone Number') }}" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.telepon"
                label="{{ __('Phone Number') }}"
                name="telepon"
                clearable
                clear-icon="mdi-eraser-variant"
                v-mask="'+##############'"
                placeholder="+62812411111111"
                hint="* {{ __('required') }}"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider v-if="!dataUri" rules="required|min:8" vid="password_confirmation" name="{{ __('Password') }}" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.password"
                :append-icon="show_password ? 'mdi-eye' : 'mdi-eye-off'"
                :type="show_password ? 'text' : 'password'"
                @click:append="show_password = !show_password"
                label="{{ __('Password') }}"
                hint="* {{ __('required') }}"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider v-if="!dataUri" rules="required|confirmed:password_confirmation" name="{{ __('Password Confirmation') }}" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.password_confirmation"
                :append-icon="show_password ? 'mdi-eye' : 'mdi-eye-off'"
                :type="show_password ? 'text' : 'password'"
                @click:append="show_password = !show_password"
                label="{{ __('Password Confirmation') }}"
                hint="* {{ __('required') }}"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <v-btn
        	class="my-4 mr-4"
          	:loading="field_state"
          	:disabled="field_state"
            type="submit"
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
            class="my-4"
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