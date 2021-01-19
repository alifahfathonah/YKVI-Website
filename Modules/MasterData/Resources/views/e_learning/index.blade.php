@extends('core::layouts.master')

@section('content')
    <v-row
        class="px-md-4 px-sm-2">
        <v-col cols="12">
            <v-card>
                <v-card-title>
                    {{ __('E-Learning') }}
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
                                <h4 class="my-2">Link URL</h4>
                                <a href="{{ $data->link_url_redirect }}" target="_blank">{{ $data->link_url_redirect }}</a>
                            </v-list-tem-content>
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
                            href="{{ route('e-learning.edit',[$data->slug ?? '']) }}"
                        >
                            {{ __('Edit Data') }}
                        </v-btn>
                    @else
                        <v-btn
                            class="mx-5 my-3"
                            type="button"
                            color="primary"
                            href="{{ route('e-learning.create') }}"
                        >
                            {{ __('Add New Data') }}
                        </v-btn>
                    @endif
                </v-card-actions>
            </v-card>
        </v-col>
    </v-row>
@endsection