@extends('core::layouts.master')

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<contact-us-form
	    				inline-template
	    				action-form="{{ route('contact-us.store') }}"
	    				redirect-uri="{{ route('contact-us.index') }}">
		    			@include('contactus::contact_us.form')
		    		</contact-us-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
