@extends('core::layouts.master')

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<faq-form
	    				inline-template
	    				action-form="{{ route('faq.store') }}"
	    				redirect-uri="{{ route('faq.index') }}">
		    			@include('masterdata::faq.form')
		    		</faq-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
