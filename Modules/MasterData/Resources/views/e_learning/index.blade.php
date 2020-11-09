@extends('core::layouts.master')

@push('table_slot')
<template v-slot:item.link_url_redirect="{ item }">
    <a :href="item.link_url_redirect" target="_blank">@{{ item.link_url_redirect }}</a>
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
    					uri="{{ route('e-learning.table') }}"
    					:headers='@json($table_headers)'
    					no-data-text="Tidak ada data ditemukan."
    					no-results-text="Tidak ada data ditemukan."
    					search-text="Pencarian"
    					refresh-text="Muat Ulang"
    					items-per-page-all-text="Semua"
    					items-per-page-text="Tampilkan"
    					page-text-locale="id"
    					add-new-uri="{{ route('e-learning.create') }}"
    					add-new-text="Tambah"
    					add-new-color="light-blue lighten-2"
    					edit-uri="e-learning.edit"
    					edit-uri-parameter="slug"
    					edit-text="Ubah"
    					delete-uri="e-learning.destroy"
    					delete-uri-parameter="slug"
    					delete-text="Hapus"
    					delete-confirmation-text="Apakah Anda yakin untuk menghapus data ini ?"
    					delete-cancel-text="Batal"
    					>
    					
    					@include('core::components.table')
    				</table-component>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
