<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="/favicon.ico" />

        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;1,300;1,400;1,500&display=swap" rel="stylesheet">
        <link href="{{ asset('public/css/app.css') }}{{stripos(asset('public/css/app.css'), '?') === false ? '?' : '&'}}v={{config('core.app_version')}}" rel="stylesheet">
        @yield('styles')
    </head>
    <body>
        
        <div id="page-content">
            <base-layout inline-template>
                <v-app id="content" v-cloak>
                    <v-main>
                        <v-container
                            class="fill-height justify-center"
                        >
                            <v-row
                                align="center"
                                justify="center"
                            >
                                <v-col
                                    xl="7"
                                    lg="11"
                                    sm="8"
                                >
                                    <v-card class="elevation-4" light>
                                        <v-row>
                                            <v-col
                                                lg="7"
                                                class="d-none d-md-flex justify-center align-center"
                                                style="background-color: #cd4b3f"
                                            >
                                                <div class="d-none d-sm-block">
                                                    <div class="d-flex align-center pa-10">
                                                        <div>
                                                            <h2 class="display-1 white--text font-weight-medium text-center">
                                                                YKVI Website Backend
                                                            </h2>
                                                            {{-- <h6 class="subtitle-1 mt-4 white--text op-5 font-weight-regular">
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                                            </h6> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </v-col>

                                            <v-col
                                                lg="5"
                                            >
                                                <div class="pa-7 pa-sm-12">
                                                    @yield('content')
                                                </div>
                                            </v-col>
                                        </v-row>
                                    </v-card>
                                </v-col>
                            </v-row>

                        </v-container>
                    </v-main>

                </v-app>
            </base-layout>
        </div>
        
        <script src="{{ asset('public/js/app.js') }}{{stripos(asset('public/js/app.js'), '?') === false ? '?' : '&'}}v={{config('core.app_version')}}"></script>
        @yield('scripts')
    </body>
</html>