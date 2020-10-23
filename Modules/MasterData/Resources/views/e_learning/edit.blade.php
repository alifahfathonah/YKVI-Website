@extends('core::layouts.master')

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<e-learning-form
	    				inline-template
	    				action-form="{{ route('e-learning.update', [ $data->slug ]) }}"
	    				redirect-uri="{{ route('e-learning.index') }}"
	    				data-uri="{{ route('e-learning.data', [ $data->slug ]) }}">
		    			@include('masterdata::e_learning.form')
		    		</e-learning-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
