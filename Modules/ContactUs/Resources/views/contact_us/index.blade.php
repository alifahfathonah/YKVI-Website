@extends('core::layouts.master')

@push('table_slot')
<template v-slot:item.email="{ item }">
    <a :href="'mailto:' + item.email">@{{ item.email }}</a>
</template>
@endpush

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<table-component inline-template
    					table-number
    					with-actions
    					uri="{{ route('contact-us.table') }}"
    					:headers='@json($table_headers)'
    					no-data-text="{{ __('Data Not Found') }}"
    					no-results-text="{{ __('Data Not Found') }}"
    					search-text="{{ __('Search') }}"
    					refresh-text="{{ __('Refresh') }}"
    					items-per-page-all-text="{{ __('All') }}"
    					items-per-page-text="{{ __('Show') }}"
    					page-text-locale="{{ __('en') }}"
    					edit-uri="contact-us.edit"
    					edit-uri-parameter="slug"
                        edit-text="Details"
                        edit-icon="mdi-eye"
    					delete-confirmation-text="{{ __('Are you sure you want to delete this data ?') }}"
    					delete-cancel-text="{{ __('Cancel') }}"
    					>
    					
    					@include('core::components.table')
    				</table-component>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
