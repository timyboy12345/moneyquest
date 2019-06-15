<?php

namespace App\Http\Controllers;

//use App\Request;
use App\Request as Req;
use App\Subscription;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Mollie\Api\Exceptions\ApiException;

class ScheduleController extends Controller
{
    /**
     * @param $id
     * @param Request $r
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     * @throws ApiException
     * @throws \Mollie\Api\Exceptions\IncompatiblePlatform
     */
    public function index($id, Request $r)
    {
        $request = Req::find($id);

        if (!$request) {
            return redirect(route('home'));
        }

        $mandate = null;

        $subscription = Subscription
            ::where(
                ['user_id' => Auth::user()->id, 'request_id' => $request->id]
            )
            ->first();

        if (isset($subscription)) {
            return redirect(route('home'));
        }

        if (Auth::user()->mollie_customer_id != null) {
            $mollie = new \Mollie\Api\MollieApiClient();
            $mollie->setApiKey(env('MOLLIE_API_KEY'));

            $customer = $mollie->customers->get(Auth::user()->mollie_customer_id);
            $mandates = $customer->mandates();

            if (sizeof($mandates) > 0) {
                $mandate = $mandates[0];
            }
        }

        return view('/schedule/index', compact(['request', 'mandate']));
    }

    /**
     * @param $id
     * @param Request $r
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws ApiException
     * @throws \Mollie\Api\Exceptions\IncompatiblePlatform
     */
    public function indexPost($id, Request $r)
    {
        $request = Req::find($id);
        if (!$request) {
            return redirect(route('home'));
        }

        // Flash input
        $r->flash();

        // Validate required fields
        $r->validate(
            [
                'payments' => 'required|integer|min:2|max:10',
                'interval' => 'required|integer|min:1|max:31'
            ]
        );

        // Check the IBAN format if submitted
        if (Input::get('iban') !== null) {
            if (!preg_match('/([A-Z]{2})([0-9]{2})([A-Z]{4})([0-9]{8,10})/', Input::get('iban'))) {
                return back()
                    ->withErrors(['iban' => "Geen geldige IBAN rekening formaat"]);
            }
        }

        // Create new mollie instance
        $mollie = new \Mollie\Api\MollieApiClient();
        $mollie->setApiKey(env('MOLLIE_API_KEY'));

        // Check if user has a mollie customer account
        if (isset(Auth::user()->mollie_customer_id)) {
            // Get the user
            try {
                $customer = $mollie
                    ->customers->get(Auth::user()->mollie_customer_id);
            } catch (ApiException $e) {
                return response()->json([$e->getMessage()]);
            }
        } else {
            // Create a new user
            try {
                $customer = $mollie->customers->create(
                    [
                        "name" => Auth::user()->username,
                        "email" => Auth::user()->email,
                    ]
                );
            } catch (ApiException $e) {
                return response()->json([$e->getMessage()]);
            }

            // Insert the mollie customer id in the database
            $user = User::find(Auth::user()->id);
            $user->update(['mollie_customer_id' => $customer->id]);
        }

        $mandates = $customer->mandates();

        if (sizeof($mandates) == 0) {
            try {
                $mandate = $mollie->customers->get($customer->id)->createMandate(
                    [
                        "method" => \Mollie\Api\Types\MandateMethod::DIRECTDEBIT,
                        "consumerName" => Auth::user()
                                ->firstname . " " . Auth::user()
                                ->familyname,
                        "consumerAccount" => Input::get('iban'),
                    ]
                );
            } catch (ApiException $e) {
                return response()->json([$e->getMessage()]);
            }
        } else {
            $mandate = $customer->mandates()[0];
        }

        $total_amount = $request->amount;
        $interval_amount = $total_amount / Input::get('payments');

        $subscription = $customer->createSubscription(
            [
                "amount" => [
                    "currency" => "EUR",
                    "value" => number_format($interval_amount, 2, '.', ''),
                ],
                "method" => "directdebit",
                "times" => Input::get('payments'),
                "interval" => Input::get('interval') . " days",
                "description" => $request->description,
                "webhookUrl" => "https://webshop.example.org/subscriptions/webhook/",
            ]
        );

        Subscription::create(
            [
                'id' => $subscription->id,
                'request_id' => $request->id,
                'user_id' => Auth::user()->id,
                'mollie_subscription_id' => $subscription->id,
                'interval' => Input::get('interval'),
                'payments' => Input::get('payments'),
                'amount' => $interval_amount,
                'state' => 'active'
            ]
        )->save();

        return redirect(
            route(
                'schedule-success',
                [
                    $request->id,
                    $subscription->id
                ]
            )
        );
    }

    /**
     * @param $id
     * @param $subscription_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     * @throws ApiException
     * @throws \Mollie\Api\Exceptions\IncompatiblePlatform
     */
    public function success($id, $subscription_id)
    {
        $request = Req::find($id);

        if (!$request) {
            return redirect(route('home'));
        }

        $mandate = null;

        if (Auth::user()->mollie_customer_id != null) {
            $mollie = new \Mollie\Api\MollieApiClient();
            $mollie->setApiKey(env('MOLLIE_API_KEY'));

            $customer = $mollie->customers->get(Auth::user()->mollie_customer_id);
            $mandates = $customer->mandates();

            if (sizeof($mandates) > 0) {
                $mandate = $mandates[0];
            }
        }

        return view('/schedule/success', compact(['request', 'mandate']));
    }
}
