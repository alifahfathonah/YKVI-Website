@extends('core::layouts.master')
@push('table_slot')
    <template v-slot:item.banner_image="{ item }">
        <template>
            <img :src="item.banner_image" width="100" class="my-2">
        </template>
    </template>

    <template v-slot:item.publish_status="{ item }">
        <template v-if="item.publish_status == 'Publish'">
            <v-chip color="green" text-color="white">
                {{ __('Publish') }}
            </v-chip>
        </template>
        <template v-if="item.publish_status == 'Unpublish'">
            <v-chip color="warning" text-color="white">
                {{ __('Unpublish') }}
            </v-chip>
        </template>
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
    					uri="{{ route('banner.table') }}"
    					:headers='@json($table_headers)'
    					no-data-text="{{ __('Data Not Found') }}"
    					no-results-text="{{ __('Data Not Found') }}"
    					search-text="{{ __('Search') }}"
    					refresh-text="{{ __('Refresh') }}"
    					items-per-page-all-text="{{ __('All') }}"
    					items-per-page-text="{{ __('Show') }}"
    					page-text-locale="{{ __('en') }}"
    					add-new-uri="{{ route('banner.create') }}"
    					add-new-text="{{ __('Add') }}"
    					add-new-color="light-blue lighten-2"
    					edit-uri="banner.edit"
    					edit-uri-parameter="slug"
    					edit-text="{{ __('Edit') }}"
    					delete-uri="banner.destroy"
    					delete-uri-parameter="slug"
    					delete-text="{{ __('Delete') }}"
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
