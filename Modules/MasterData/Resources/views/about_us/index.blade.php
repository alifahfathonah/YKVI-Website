@extends('core::layouts.master')

@section('content')
    <about-us-form
        @if ($data)
        slug-uri="{{ $data->slug }}"
        @endif
        redirect-uri="{{ route('about-us.index') }}" 
        inline-template
    >
        <div>
            <v-row
                class="px-md-4 px-sm-2">
                <v-col cols="12">
                    <v-card>
                        <v-card-title>
                            {{ __('About Us') }}
                        </v-card-title> 
                        <v-divider></v-divider> 
                        <v-card-text>
                            @if ($data)
                                <v-list-item>
                                    <v-list-item-content>
                                        <h4 class="my-2">{{ __('Title') }}</h4>
                                        <v-list-item-title>{{ $data->title ?? '-' }}</v-list-item-title>
                                    </v-list-tem-content>
                                    <v-list-item-content>
                                        <h4 class="my-2">{{ __('Images') }}</h4>
                                        @if($data->about_us_image)
                                            <v-img
                                                max-height="160"
                                                max-width="250"
                                                src="{{ $data->url_about_us_image }}"
                                            >
                                                <v-btn
                                                    @click.stop="promptDeleteItem()"
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
                                        @else
                                            <span>-</span>
                                        @endif
                                    </v-list-item-content>
                                    <v-list-item-content>
                                        <h4 class="my-2">{{ __('Description') }}</h4>
                                        <p>{!! $data->description ?? '-' !!}</p>
                                    </v-list-item-content>
                                </v-list-item>
                            @else
                                <span class="ml-3">{{ __('Data Not Found') }}</span>
                            @endif
                        </v-card-text>
                        <v-card-actions>
                            @if ($data)
                                <v-btn
                                    class="mx-5 my-3"
                                    type="button"
                                    color="primary"
                                    href="{{ route('about-us.edit',[$data->slug ?? '']) }}"
                                >
                                    {{ __('Edit Data') }}
                                </v-btn>
                            @else
                                <v-btn
                                    class="mx-5 my-3"
                                    type="button"
                                    color="primary"
                                    href="{{ route('about-us.create') }}"
                                >
                                    {{ __('Add New Data') }}
                                </v-btn>
                            @endif
                        </v-card-actions>
                    </v-card>
                </v-col>
            </v-row>
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
                v-if="form_alert_text"
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
        </div>
    </about-us-form>
@endsection