<?php

namespace App\Services;

use App\Mail\ContactMessage;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;

class ContactService
{
    /**
     * @param  array  $attributes
     * @return void
     */
    public function store(array $attributes): void
    {
        Contact::create($attributes);

        Mail::to('example@gmail.com')->send(new ContactMessage($attributes));
    }
}
