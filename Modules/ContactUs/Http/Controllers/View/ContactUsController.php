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
        $this->middleware(['auth']);
    }

    public function breadcrumbs()
    {
        return [
            ['href' => url('/'), 'text' => 'mdi-home'],
            ['href' => route('contact-us.index'), 'text' => __('Contact Us')],
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
                "text" => __('Sender Name'),
                "align" => 'center',
                "sortable" => false,
                "value" => 'name',
            ],
            [
                "text" => __('Sender Email'),
                "align" => 'center',
                "sortable" => false,
                "value" => 'email',
            ],
            [
                "text" => __('Phone Number'),
                "align" => 'center',
                "sortable" => false,
                "value" => 'phone_number',
            ],
            [
                "text" => __('Subject'),
                "align" => 'center',
                "sortable" => false,
                "value" => 'subject',
            ],
            [
                "text" => __('Received Date'),
                "align" => 'center',
                "sortable" => false,
                "value" => 'last_update',
            ]
           
        ];
        return view('contactus::contact_us.index')
             ->with('page_title', __('Contact Us'))
             ->with('breadcrumbs', $this->breadcrumbs())
             ->with('table_headers', $table_headers);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Contact Us $contact_us
     * @return Renderable
     */
    public function edit(ContactUs $contact_us)
    {
        $breadcrumbs[] = ['href' => route('contact-us.edit', [ $contact_us->slug ]), 'text' => __('Message Detail')];

        return view('contactus::contact_us.edit')
            ->with('data', $contact_us)
            ->with('page_title', __('Message Detail') . ' ' . $contact_us->name)
            ->with('breadcrumbs', array_merge($this->breadcrumbs(), $breadcrumbs));
    }
}
