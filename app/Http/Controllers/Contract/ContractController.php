<?php

namespace App\Http\Controllers\Contract;

use App\ContractTodo;
use App\Employee;
use App\Event;
use App\Http\Controllers\Contract\Sign\BookIt;
use App\Http\Controllers\Contract\Sign\UploadSignature;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeclineContract;
use App\Http\Requests\ReviseContract;
use App\Http\Requests\SignContract;
use App\Mail\DeclinedContract;
use App\Mail\RevisedContract;
use App\Mail\SignedContract;
use App\Notifications\DeclinedContractMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class ContractController extends Controller
{
    public function index()
    {
        $params = $this->_getParams(request());

        $data = (new ContractData($params))->get();

        return view('contract.sign', compact('data'));
    }

    public function sign(SignContract $request)
    {
        $validated = (object) $request->validated();

        $booked = new BookIt($validated);
        $recipient = new Recipient($booked->contract());

        $upload = new UploadSignature($validated);
        $upload->storage($validated->signature);

        Mail::to($validated->email)
            ->bcc(['soraya@cpavalet.com', 'regionalmgr@cpavalet.com', 'events2@cpavalet.com'])
            ->queue(new SignedContract([$booked->contract(), $request->input(), $recipient->get()]));
    }

    public function revise(ReviseContract $request)
    {
        $validated = (object) $request->validated();

        $event = (new ContractType($validated))->get();

        $todo = new ContractTodo;
        $todo->comment = $validated->message;
        $event->todos()->save($todo);

        $recipient = new Recipient($event);

        Mail::to($validated->email)
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
        $validated = (object) $request->validated();

        $event = Event::find($validated->event_id);

        $event->book_client = 'td';
        $event->td_notes = $validated->message;
        $event->save();

        $recipient = new Recipient($event);

        $users = Employee::officeManagers()->get();

        Notification::send($users, new DeclinedContractMessage($event));

        Mail::to($validated->email)
            // ->bcc(['soraya@cpavalet.com', 'events@cpavalet.com', 'events2@cpavalet.com'])
            ->queue(new DeclinedContract([
                $event,
                $recipient->get(),
                $validated,
                $event->userQuestion->email
            ]));
    }

    private function _getParams($request)
    {
        return (object) $request->get('params');
    }
}
