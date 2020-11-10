@extends('core::layouts.master')

@section('content')
    <v-row
        class="px-md-4 px-sm-2">
        <v-col cols="12">
            <v-card>
                <v-card-title>
                    SymCard
                </v-card-title> 
                <v-divider></v-divider> 
                <v-card-text>
                    @if ($data)
                        <v-list-item>
                            <v-list-item-content>
                                <h4 class="my-2">Judul</h4>
                                <span>{{ $data->title ?? '-' }}</span>
                            </v-list-tem-content>
                            <v-list-item-content>
                                <h4 class="my-2">Gambar</h4>
                                @if($data->url_sym_card_image)
                                    <v-img
                                        max-height="160"
                                        max-width="250"
                                        src="{{ $data->url_sym_card_image }}"
                                    ></v-img>
                                @else
                                    <span>-</span>
                                @endif
                            </v-list-item-content>
                            <v-list-item-content>
                                <h4 class="my-2">Link Embed Youtube</h4>
                                @if($data->link_embed_youtube)
                                    <a href="{{ $data->link_embed_youtube }}" target="_blank">{{ $data->link_embed_youtube }}</a>
                                @else
                                    <span>-</span>
                                @endif
                            </v-list-tem-content>
                            <v-list-item-content>
                                <h4 class="my-2">Deskripsi</h4>
                                <p>{!! $data->description ?? '-' !!}</p>
                            </v-list-item-content>
                        </v-list-item>
                    @else
                        <span class="ml-3">Tidak ada data SymCard</span>
                    @endif
                </v-card-text>
                <v-card-actions>
                    @if ($data)
                        <v-btn
                            class="mx-5 my-3"
                            type="button"
                            color="primary"
                            href="{{ route('sym-card.edit',[$data->slug ?? '']) }}"
                        >
                            Ubah Data
                        </v-btn>
                    @else
                        <v-btn
                            class="mx-5 my-3"
                            type="button"
                            color="primary"
                            href="{{ route('sym-card.create') }}"
                        >
                            Tambah Data
                        </v-btn>
                    @endif
                </v-card-actions>
            </v-card>
        </v-col>
    </v-row>
@endsection