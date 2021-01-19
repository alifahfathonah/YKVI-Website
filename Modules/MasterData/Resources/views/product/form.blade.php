<validation-observer v-slot="{ validate, reset }" ref="observer">
    <form method="post" enctype="multipart/form-data" ref="post-form">
        <validation-provider rules="required" name="{{ __('Product Category') }}" v-slot="{ errors }">
            <v-autocomplete
                class="my-4"
                v-model="form_data.category_id" 
                :items="filterProductCategory"
                label="{{ __('Product Category') }}"
                name="category_id"
                hint="* {{ __('required') }}"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-autocomplete>
        </validation-provider>

        <validation-provider rules="required" name="{{ __('Product Name') }} (ID)" v-slot="{ errors }">
            <v-text-field
            	class="my-4"
                v-model="form_data.name"
                label="{{ __('Product Name') }} (ID)"
    			name="name"
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
                <validation-provider v-slot="{ errors }" name="{{ __('Product Description') }} (ID)" rules="required">
                    <h4 class="font-weight-medium">{{ __('Product Description') }} (ID)</h4>
                    <wysiwyg 
                        class="mt-1"
                        v-model="form_data.description"
                        name="description"
                        label="{{ __('Product Description') }} (ID)"
                        :error-messages="errors"
                        :disabled="field_state"
                    ></wysiwyg>
                    <h5 class="mb-2 font-weight-medium">* {{ __('required') }}</h5>
                </validation-provider>
            </v-col>
        </v-row>

        <v-row>
            <v-col cols="12">
                <validation-provider v-slot="{ errors }" name="{{ __('Product Detail') }} (ID)" rules="required">
                    <h4 class="font-weight-medium">{{ __('Product Detail') }} (ID)</h4>
                    <wysiwyg 
                        class="mt-1"
                        v-model="form_data.detail"
                        name="detail"
                        label="{{ __('Product Detail') }} (ID)"
                        :error-messages="errors"
                        :disabled="field_state"
                    ></wysiwyg>
                    <h5 class="mb-2 font-weight-medium">* {{ __('required') }}</h5>
                </validation-provider>
            </v-col>
        </v-row>

        <validation-provider rules="required" name="{{ __('Product Name') }} (EN)" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.name_en"
                label="{{ __('Product Name') }} (EN)"
                name="name_en"
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
                <validation-provider v-slot="{ errors }" name="{{ __('Product Description') }} (EN)" rules="required">
                    <h4 class="font-weight-medium">{{ __('Product Description') }} (EN)</h4>
                    <wysiwyg 
                        class="mt-1"
                        v-model="form_data.description_en"
                        name="description_en"
                        label="{{ __('Product Description') }} (EN)"
                        :error-messages="errors"
                        :disabled="field_state"
                    ></wysiwyg>
                    <h5 class="mb-2 font-weight-medium">* {{ __('required') }}</h5>
                </validation-provider>
            </v-col>
        </v-row>

        <v-row>
            <v-col cols="12">
                <validation-provider v-slot="{ errors }" name="{{ __('Product Detail') }} (EN)" rules="required">
                    <h4 class="font-weight-medium">{{ __('Product Detail') }} (EN)</h4>
                    <wysiwyg 
                        class="mt-1"
                        v-model="form_data.detail_en"
                        name="detail_en"
                        label="{{ __('Product Detail') }} (EN)"
                        :error-messages="errors"
                        :disabled="field_state"
                    ></wysiwyg>
                    <h5 class="mb-2 font-weight-medium">* {{ __('required') }}</h5>
                </validation-provider>
            </v-col>
        </v-row>
        
        <v-file-input
            multiple
            counter
            small-chips
            accept="image/*"
            name="product_image[]"
            label="{{ __('Product Images') }}"
            prepend-icon="mdi-camera"
            clearable
            clear-icon="mdi-eraser-variant"
            :disabled="field_state"
        >
        </v-file-input>

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

    <br>
    <v-card class="my-5" v-if="form_data.product_details && form_data.product_details != 0">
        <v-card-title>{{ __('List Product Images') }}</v-card-title>
        <v-card-text>
            <v-row>
                <v-col
                    v-for="el in form_data.product_details"
                    cols="12"
                    md="3"
                >
                    <v-card
                        class="mx-auto"
                        min-height="150"
                        max-height="175"
                        max-width="250"
                        tile
                    >
                        <v-img
                            max-height="160"
                            max-width="250"
                            :src="el.url_product_image"
                        >
                            <v-btn
                                @click.stop="promptDeleteItem(el)"
                                class="d-flex ml-auto my-1 mx-1"
                                fab
                                dark
                                x-small
                                color="pink"
                            >
                                <v-icon dark>
                                    mdi-minus
                                </v-icon>
                            </v-btn>
                        </v-img>
                    </v-card>
                    <a :href="el.url_product_image" target="_blank">
                        <center>
                            <small>@{{ el.product_image }}</small>
                        </center>                        
                    </a>
                </v-col>
            </v-row>
        </v-card-text>
    </v-card>

    <v-dialog
        v-model="prompt_delete"
        persistent
        max-width="500px"
    >
        <v-card>
            <v-card-title>
                <span class="headline"></span>
            </v-card-title>
            <v-card-text>
                <v-row
                    align="center"
                    justify="center"
                >
                    <v-icon size="100" color="yellow darken-2">mdi-alert-rhombus</v-icon>
                    <p class="text-md-h6 text-xs-h6 black--text my-5">
                        {{ __('Are you sure you want to delete this data ?') }}
                    </p>
                </v-row>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn text :disabled="delete_loader" @click="prompt_delete = false">{{ __('Cancel') }}</v-btn>
                <v-btn
                    class="white--text"
                    elevation="5"
                    color="red"
                    :disabled="delete_loader"
                    :loading="delete_loader"
                    @click="deleteItem()"
                    >
                    <v-icon>mdi-trash-can-outline</v-icon>
                    <span class="hidden-xs-only ml-2">{{ __('Delete') }}</span>
                    <template v-slot:loader>
                        <span class="custom-loader">
                            <v-icon color="white">mdi-trash-can-outline</v-icon>
                        </span>
                    </template>
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>

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

