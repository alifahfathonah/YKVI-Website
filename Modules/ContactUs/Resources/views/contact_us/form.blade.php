<validation-observer v-slot="{ validate, reset }" ref="observer">
    <form method="post" enctype="multipart/form-data" ref="post-form">
        <validation-provider rules="required" name="Nama Pengirim" v-slot="{ errors }">
            <v-text-field
            	class="my-4"
                v-model="form_data.name"
                label="Nama Pengirim"
    			name="name"
                :readonly="true"
	    		:persistent-hint="true"
	    		:error-messages="errors"
	    		:disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider rules="required" name="Email Pengirim" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.email"
                label="Email Pengirim"
                name="email"
                :readonly="true"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider v-slot="{ errors }" name="Nomor Handphone" rules="required|max:15">
            <v-text-field
                class="my-4"
                v-model="form_data.phone_number"
                label="Nomor Handphone"
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

        <validation-provider rules="required" name="Subject" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.subject"
                label="Subject"
                name="subject"
                :readonly="true"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider v-slot="{ errors }" name="Isi Pesan" rules="required">
            <v-textarea 
                class="my-4"
                v-model="form_data.message"
                name="message"
                label="Isi Pesan"
                :readonly="true"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-textarea>
        </validation-provider>
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