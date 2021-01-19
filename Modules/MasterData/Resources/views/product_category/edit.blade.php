@extends('core::layouts.master')

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<product-category-form
	    				inline-template
	    				action-form="{{ route('product-category.update', [ $data->slug ]) }}"
	    				redirect-uri="{{ route('product-category.index') }}"
	    				data-uri="{{ route('product-category.data', [ $data->slug ]) }}">
		    			@include('masterdata::product_category.form')
		    		</product-category-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
