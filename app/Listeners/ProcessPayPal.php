<?php

namespace App\Listeners;

use PRAXXYSEcommerce\PayPal\Events\PayPalNotified;
use Illuminate\Support\Facades\Log;
use App\Services\VisitaService;

class ProcessPayPal
{
    protected $result;
    protected $invoice;
    protected $visita;

    public function __construct(VisitaService $visita)
    {
        Log::info('Entering Process Paypal');
        $this->visita = $visita;
        Log::info('Visita website is now online');
    }

    /**
     * Handle the event.
     *
     * @param  \PRAXXYSEcommerce\PayPal\Events\PayPalNotified  $event
     * @return void
     */
    public function handle(PayPalNotified $event)
    {

        Log::info('Dispatching PayPalNotified...');

        # dd($event->result):
        # [
        #   "reference_code" => "(your invoice reference)",
        #   "transaction_code" => "Transaction code from PayPal",
        # ]
        $this->result = $event->result;

        # PROCESS YOUR ACTIONS HERE:
        
        $this->processInvoice();
       #$this->notifyUser();
       #$this->notifyAdmin();
    }


    /* * * * * * * * * * * * * * *
     * SAMPLE CODE FOR REFERENCE *
     * * * * * * * * * * * * * * */


    private function processInvoice() {
        $request['payment_code'] = $this->result['transaction_code'];
        $request['reference_code'] = $this->result['reference_code'];
        $data = $this->visita->updateInvoice($request);

        // \DB::beginTransaction();

        // # will cause error if no code is there
        // $this->invoice = Invoice::where('reference_code', $this->result['reference_code'])->first();
        // $this->invoice->status = Invoice::PAID;
        // $this->invoice->payment_gateway_code = $this->result['transaction_code'];

        // $this->invoice->save();

        // \DB::commit();

    }

    private function notifyUser()
    {
        $this->invoice->user->notify(new UserInvoicePaid($this->invoice));
    }

    private function notifyAdmin()
    {
        $admins = Admin::all();

        foreach ($admins as $admin)
        {
            $admin->notify(new AdminInvoicePaid($this->invoice));
        }
    }
}