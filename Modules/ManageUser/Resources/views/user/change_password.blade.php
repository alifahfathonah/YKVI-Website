@extends('core::layouts.master')

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<user-form
	    				inline-template
	    				action-form="{{ route('change-password.update', [ Auth::user()->slug ]) }}"
	    				data-change-uri="{{ route('user.data', [ Auth::user()->slug ]) }}"
	    				redirect-uri="{{ route('dashboard.index') }}">
		    			@include('manageuser::user.form_change')
		    		</user-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
