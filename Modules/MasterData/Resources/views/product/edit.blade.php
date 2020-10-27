@extends('core::layouts.master')

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<product-form
	    				inline-template
	    				action-form="{{ route('product.update', [ $data->slug ]) }}"
	    				redirect-uri="{{ route('product.index') }}"
	    				data-uri="{{ route('product.data', [ $data->slug ]) }}">
		    			@include('masterdata::product.form')
		    		</product-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
