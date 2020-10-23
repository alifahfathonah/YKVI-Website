@extends('core::layouts.master')

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<banner-form
	    				inline-template
	    				action-form="{{ route('banner.update', [ $data->slug ]) }}"
	    				redirect-uri="{{ route('banner.index') }}"
	    				data-uri="{{ route('banner.data', [ $data->slug ]) }}">
		    			@include('masterdata::banner.form')
		    		</banner-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection