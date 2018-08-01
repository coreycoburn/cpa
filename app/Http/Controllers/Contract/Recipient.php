<?php

namespace App\Http\Controllers\Contract;

class Recipient
{
    private $data;

    public function __construct($event)
    {
        $data = [];
        $data['social_title'] = $event->social_title;

        if ($event->address_contact == 1) {
            $data['first_name'] = $event->fname;
            $data['last_name'] = $event->lname;
            $data['email'] = $event->email;
            $data['phone'] = $event->phone;
        } else if ($event->address_contact == 2) {
            $data['first_name'] = $event->fname2;
            $data['last_name'] = $event->lname2;
            $data['email'] = $event->email2;
            $data['phone'] = $event->phone2;
        }

        if ($event->social_title == 'Unknown') {
            if ($event->address_contact == 1) {
                $data['social_title'] = $event->fname;
            } else if ($event->address_contact == 2) {
                $data['social_title'] = $event->fname2;
            }
        }

        $this->data = $data;

        return;
    }

    public function get($items = NULL)
    {
        return get($this->data, $items);
    }
}
