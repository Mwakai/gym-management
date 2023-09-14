<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Safaricom\Mpesa\Mpesa;
use Safaricom\Mpesa\Facade\Mpesa as FacadeMpesa;
class MembersController extends Controller
{
  
    public function index() {

        $query = Member::all();
        $total = count($query);


        $members = Member::latest()->paginate(5);

        return view('admin.members', compact('members', 'total'))->with('i', (request()->input('page', 1) - 1) * 5);
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

        /**
         * DARAJA API TO MAKE MPESA 
         * PAYMENT
         */
        $BusinessShortCode = '174379';
        $LipaNaMpesaPasskey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
        $TransactionType = 'CustomerPayBillOnline';
        $Amount = $request->payment;
        $PartyA = '254746745475'; // replace this with your phone number
        $PartyB = '174379';
        $PhoneNumber = '254746745475';
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
        dd($stkPushSimulation);

        return redirect()->back()->with('success', 'Member Added Successfully');

    }

    //DELETE MEMBER 
    public function deleteMember(Request $request) {
        $id = $request->id;
        Member::where('id', $id)->delete();
    
        return redirect()->back()->with('success', 'Member Deleted Successfully');
    }
}
