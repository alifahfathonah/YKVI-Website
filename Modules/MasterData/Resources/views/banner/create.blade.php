@extends('core::layouts.master')

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<banner-form
	    				inline-template
	    				action-form="{{ route('banner.store') }}"
	    				redirect-uri="{{ route('banner.index') }}">
		    			@include('masterdata::banner.form')
		    		</banner-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
