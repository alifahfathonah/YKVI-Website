@extends('core::layouts.master')

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<cme-form
	    				inline-template
	    				action-form="{{ route('cme.update', [ $data->slug ]) }}"
	    				redirect-uri="{{ route('cme.index') }}"
	    				data-uri="{{ route('cme.data', [ $data->slug ]) }}">
		    			@include('masterdata::cme.form')
		    		</cme-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
