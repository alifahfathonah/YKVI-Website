@extends('core::layouts.master')

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<cme-form
	    				inline-template
	    				action-form="{{ route('cme.store') }}"
	    				redirect-uri="{{ route('cme.index') }}">
		    			@include('masterdata::cme.form')
		    		</cme-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
