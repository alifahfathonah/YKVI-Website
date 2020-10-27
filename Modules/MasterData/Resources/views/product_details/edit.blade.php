@extends('core::layouts.master')

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<product-details-form
	    				inline-template
	    				action-form="{{ route('product-details.update', [ $data->slug ]) }}"
	    				redirect-uri="{{ route('product-details.index') }}"
	    				data-uri="{{ route('product-details.data', [ $data->slug ]) }}"
	    				:filter-product='@json($product)'>
		    			@include('masterdata::product_details.form')
		    		</product-details-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection