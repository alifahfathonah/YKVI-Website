<validation-observer v-slot="{ validate, reset }" ref="observer">
    <form method="post" enctype="multipart/form-data" ref="post-form">
        <validation-provider rules="required|email" name="{{ __('Email Address') }}" v-slot="{ errors }">
            <v-text-field
                class="my-4"
            	v-model="form_data.email"
                label="{{ __('Email Address') }}"
                name="email"
                hint="* {{ __('required') }}"
                :persistent-hint="true"
                :error-messages="errors"
                :readonly="true"
            ></v-text-field>
        </validation-provider>

        <validation-provider rules="required|min:8" vid="password_confirmation" name="{{ __('New Password') }}" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.password"
                :append-icon="show_password ? 'mdi-eye' : 'mdi-eye-off'"
                :type="show_password ? 'text' : 'password'"
                @click:append="show_password = !show_password"
                label="{{ __('New Password') }}"
                hint="* {{ __('required') }}"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider rules="required|confirmed:password_confirmation" name="{{ __('New Password Confirmation') }}" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.password_confirmation"
                :append-icon="show_password ? 'mdi-eye' : 'mdi-eye-off'"
                :type="show_password ? 'text' : 'password'"
                @click:append="show_password = !show_password"
                label="{{ __('New Password Confirmation') }}"
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
            class="my-4"
	        type="button"
	        @click="clearFormChange"
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