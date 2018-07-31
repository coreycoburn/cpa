<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class SignedContract extends Mailable
{
    use Queueable, SerializesModels;

    public $contract;
    public $request;
    public $contractRecipient;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->contract = $data[0];
        $this->request = (object) $data[1];
        $this->contractRecipient = (object) $data[2];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.contract.update')
            ->from('info@cpavalet.com')
            ->attachData(file_get_contents($this->request->pdf), config('company.name_short'). '_signed_contract_#' . $this->contract->contract_number . '.pdf', [
                    'mime' => 'application/pdf',
                ])
            ->with([
                'socialTitle' => $this->contractRecipient->social_title,
                'lastName' => $this->contractRecipient->last_name,
                'eventDate' => Carbon::parse($this->contract->event_date)->format('D, M j, Y'),
                'contractType' => $this->contract->contract_type,
                'contractNumber' => $this->contract->contract_number,
                'eventType' => $this->contract->event_type,
                'depositDueDate' => Carbon::parse($this->contract->dep1_due_date)->format('D, M j, Y')

            ]);
    }
}
