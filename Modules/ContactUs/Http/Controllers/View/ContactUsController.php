<?php

namespace Modules\ContactUs\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ContactUs\Entities\ContactUs;

class ContactUsController extends Controller
{
    /**
     * Contact UsController constructor.
     *
     */
    public function __construct()
    {
        // $this->middleware(['auth']);
        $this->breadcrumbs = [
            ['href' => url('/'), 'text' => 'mdi-home'],
            ['href' => route('contact-us.index'), 'text' => 'Contact Us'],
        ];
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $table_headers = [
            [
                "text" => 'Nama',
                "align" => 'center',
                "sortable" => false,
                "value" => 'name',
            ],
            [
                "text" => 'Email',
                "align" => 'center',
                "sortable" => false,
                "value" => 'email',
            ],
            [
                "text" => 'Nomor Handphone',
                "align" => 'center',
                "sortable" => false,
                "value" => 'phone_number',
            ],
            [
                "text" => 'Subject',
                "align" => 'center',
                "sortable" => false,
                "value" => 'subject',
            ],
            [
                "text" => 'Tanggal dikirim',
                "align" => 'center',
                "sortable" => false,
                "value" => 'last_update',
            ]
           
        ];
        return view('contactus::contact_us.index')
             ->with('page_title', 'Contact Us')
             ->with('breadcrumbs', $this->breadcrumbs)
             ->with('table_headers', $table_headers);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Contact Us $contact_us
     * @return Renderable
     */
    public function edit(ContactUs $contact_us)
    {
        $this->breadcrumbs[] = ['href' => route('contact-us.edit', [ $contact_us->slug ]), 'text' => 'Details Message'];

        return view('contactus::contact_us.edit')
            ->with('data', $contact_us)
            ->with('page_title', 'Details Message ' . $contact_us->name)
            ->with('breadcrumbs', $this->breadcrumbs);
    }
}
