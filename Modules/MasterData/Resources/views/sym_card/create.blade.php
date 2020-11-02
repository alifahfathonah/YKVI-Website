@extends('core::layouts.master')

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<sym-card-form
	    				inline-template
	    				action-form="{{ route('sym-card.store') }}"
	    				redirect-uri="{{ route('sym-card.index') }}">
		    			@include('masterdata::sym_card.form')
		    		</sym-card-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
