@extends('core::layouts.master')

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<about-us-form
	    				inline-template
	    				action-form="{{ route('about-us.store') }}"
	    				redirect-uri="{{ route('about-us.index') }}">
		    			@include('masterdata::about_us.form')
		    		</about-us-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
