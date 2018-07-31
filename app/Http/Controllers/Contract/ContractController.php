<?php

namespace App\Http\Controllers\Contract;

use App\Confirmation;
use App\ContractTodo;
use App\Employee;
use App\Event;
use App\Http\Controllers\Contract\ContractData;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Contract\ParseUrl;
use App\Http\Controllers\Contract\Recipient;
use App\Http\Controllers\Contract\Sign\BookIt;
use App\Http\Controllers\Contract\Sign\UploadSignature;
use App\Http\Requests\DeclineContract;
use App\Http\Requests\ReviseContract;
use App\Http\Requests\SignContract as SignContract;
use App\Mail\DeclinedContract;
use App\Mail\RevisedContract;
use App\Mail\SignedContract;
use App\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class ContractController extends Controller
{
    public function index(ParseUrl $request)
    {
        $contract = new ContractData((object) $request->get(
            ['client', 'contract_id', 'proposal_id', 'confirmation_id']
        ));

        $upload = new UploadSignature($request->get(['client', 'proposal_id', 'confirmation_id']));

        $data = array_merge($contract->getData(), [
            'data' => $request->get('sign'),
            'pdf' => config('contract.url') . 'contract.php?sign=' . $request->get('sign'),
            'today' => Carbon::now()->format('D, M j, Y'),
            'previously_signed' => $upload->exists(),
            'sig_y' => $request->get('sig_y')
        ]);

        return view('contract.sign', compact('data'));
    }

    public function store(SignContract $request)
    {
        $validated = $request->validated();

        $booked = new BookIt($validated);
        $recipient = new Recipient($booked->contract());

        $upload = new UploadSignature(request(['client', 'proposal_id', 'confirmation_id']));
        $upload->storage($request->get('signature'));

        Mail::to($validated['email'])
            ->bcc(['soraya@cpavalet.com', 'events@cpavalet.com', 'events2@cpavalet.com'])
            ->queue(new SignedContract([$booked->contract(), $request->input(), $recipient->get()]));
    }

    public function revise(ReviseContract $request)
    {
        $validated = $request->validated();

        if ($validated['type'] === 'proposal') {
            $event = Proposal::find($validated['contract_id']);
        } else {
            $event = Confirmation::find($validated['contract_id']);
        }

        $todo = new ContractTodo;
        $todo->comment = $validated['message'];
        $event->todos()->save($todo);

        $recipient = new Recipient($event);

        Mail::to($validated['email'])
            // ->bcc(['soraya@cpavalet.com', 'events@cpavalet.com', 'events2@cpavalet.com'])
            ->queue(new RevisedContract([
                $event,
                $recipient->get(),
                $validated,
                $event->userQuestion->email
            ]));
    }

    public function decline(DeclineContract $request)
    {
        $validated = $request->validated();

        $event = Event::find($validated['event_id']);

        $event->book_client = 'td';
        $event->td_notes = $validated['message'];
        $event->save();

        $recipient = new Recipient($event);

        Mail::to($validated['email'])
            // ->bcc(['soraya@cpavalet.com', 'events@cpavalet.com', 'events2@cpavalet.com'])
            ->queue(new DeclinedContract([
                $event,
                $recipient->get(),
                $validated,
                $event->userQuestion->email
            ]));
    }
}
