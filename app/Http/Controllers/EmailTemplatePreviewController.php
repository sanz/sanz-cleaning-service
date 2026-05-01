<?php

namespace App\Http\Controllers;

class EmailTemplatePreviewController extends Controller
{
    public function index()
    {
        $links = [
            'Contact Mail' => route('preview.emails.show', ['template' => 'contact']),
            'Order Booked' => route('preview.emails.show', ['template' => 'order-booked']),
            'Welcome Client' => route('preview.emails.show', ['template' => 'welcome-client']),
        ];

        $html = '<h1>Email Template Previews</h1><ul>';

        foreach ($links as $label => $url) {
            $html .= '<li><a href="' . $url . '">' . $label . '</a></li>';
        }

        $html .= '</ul>';

        return response($html);
    }

    public function show($template)
    {
        if (in_array($template, ['contact', 'contact-mail', 'contactMail'], true)) {
            return view('emails.contactMail', [
                'data' => [
                    'name' => 'Jane Doe',
                    'email' => 'jane@example.com',
                    'message' => 'Hi Sanz team, I would like to request a deep cleaning service.',
                ],
            ]);
        }

        if (in_array($template, ['order-booked', 'orderBooked'], true)) {
            return view('emails.orderBooked', [
                'orderDetail' => [
                    'name' => 'Jane Doe',
                    'order_code' => 'ORD-2026-0042',
                    'booking_date' => now()->addDays(2),
                    'time_slot' => '10:00 AM - 12:00 PM',
                    'amount' => '$149.00',
                    'address' => '42 Ocean View Road, San Jose, CA',
                ],
            ]);
        }

        if (in_array($template, ['welcome-client', 'welcomeClient'], true)) {
            return view('emails.welcomeClient', [
                'clnt' => [
                    'name' => 'Sanz Partner',
                ],
            ]);
        }

        abort(404);
    }
}
