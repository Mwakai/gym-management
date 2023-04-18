<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Safaricom\Mpesa\Mpesa;
use Safaricom\Mpesa\Facade\Mpesa as FacadeMpesa;

class MembersController extends Controller
{
  

    public function index() {

        return view('admin.members');
    }



    public function join_us()
    {
        return view('pages.join_us');
    }

    //ADD MEMBER
    public function addMember(Request $request) {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'payment' => 'required',

        ]);

        Member::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'payment' => $request->payment,
        ]);
        
        $BusinessShortCode = '174379';
        $LipaNaMpesaPasskey = 'e2d3b0e1b1e1b1e1b1e1b1e1b1e1b1e1';
        $TransactionType = 'CustomerPayBillOnline';
        $Amount = $request->payment;
        $PartyA = $request->phone;
        $PartyB = '174379';
        $PhoneNumber = $request->phone;
        $CallBackURL = 'https://safaricom.co.ke/mpesa_online/lnmo_checkout_server.php?wsdl';
        $AccountReference = 'Mpesa';
        $TransactionDesc = 'Mpesa';
        $Remarks = 'Mpesa';

        $mpesa= new Mpesa();
        $stkPushSimulation = $mpesa->STKPushSimulation(
            $BusinessShortCode, // This is the paybill number
            $LipaNaMpesaPasskey, // Lipa Na Mpesa Online Passkey
            $TransactionType, // Transaction type CustomerPayBillOnline
            $Amount, // The amount the customer is paying
            $PartyA, // The phone number of the customer
            $PartyB, // The organization shortcode used to receive the transaction.
            $PhoneNumber, // Phone number same as $PartyA
            $CallBackURL, // The url to where responses from M-Pesa will be sent to
            $AccountReference, // Used with M-Pesa PayBills.
            $TransactionDesc, // A description of the transaction.
            $Remarks, // Comments that are sent along with the transaction.
        );

        return redirect()->back()->with('success', 'Member Added Successfully');

    }
}
