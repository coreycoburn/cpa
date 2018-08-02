<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class RevisedContract extends Mailable
{
    use Queueable, SerializesModels;

    public $contract;
    public $contractRecipient;
    public $request;
    public $fromEmail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->contract = $data[0];
        $this->contractRecipient = (object) $data[1];
        $this->request = (object) $data[2];
        $this->fromEmail = $data[3];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.contract.revise')
            ->from($this->fromEmail)
            ->subject('Request Changes to ' . $this->contract->contract_type . ' # ' . $this->contract->contract_number)
            ->with([
                'socialTitle' => $this->contractRecipient->social_title,
                'lastName' => $this->contractRecipient->last_name,
                'eventDate' => Carbon::parse($this->contract->event_date)->format('l, F j, Y'),
                'contractType' => $this->contract->contract_type,
                'contractTypeLower' => strtolower($this->contract->contract_type),
                'contractNumber' => $this->contract->contract_number,
                'eventType' => $this->contract->event_type,
                'message' => $this->request->message
            ]);
    }
}
