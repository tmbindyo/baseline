<?php

namespace App\Http\Controllers\Business;

use App\Account;
use App\Campaign;
use App\Expense;
use App\ExpenseAccount;
use App\ExpenseItem;
use App\Frequency;
use App\Liability;
use App\Loan;
use App\Sale;
use App\Status;
use App\Refund;
use App\Payment;
use App\Transfer;
use App\Transaction;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Traits\InstitutionTrait;
use App\Http\Controllers\Controller;
use App\Inventory;
use App\SaleProduct;
use App\Traits\ReferenceNumberTrait;

class ExpenseController extends Controller
{

    use UserTrait;
    use institutionTrait;
    use ReferenceNumberTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function expenses()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Get expenses
        $expenses = Expense::where('institution_id',$institution->id)->with('user','status','expense_account')->get();
        // return $expenses;

        return view('business.expenses',compact('expenses','user','institution'));
    }

    public function expenseCreate()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // expense accounts
        $expenseAccounts = ExpenseAccount::where('institution_id',$institution->id)->get();
        // get sales
        $sales = Sale::where('institution_id',$institution->id)->with('status')->get();
        // expense statuses
        $expenseStatuses = Status::where('status_type_id','7805a9f3-c7ca-4a09-b021-cc9b253e2810')->get();
        // get transfers
        $transfers = Transfer::where('institution_id',$institution->id)->get();
        // get campaign
        $campaigns = Campaign::where('institution_id',$institution->id)->get();
        // get liabilities
        $liabilities = Liability::where('institution_id',$institution->id)->get();
        // get frequencies
        $frequencies = Frequency::where('institution_id',$institution->id)->get();

        return view('business.expense_create',compact('liabilities','campaigns','sales','user','institution','frequencies','expenseAccounts','transfers','expenseStatuses'));
    }

    public function expenseStore(Request $request)
    {
//        return $request;
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Generate reference
        $size = 5;
        $reference = $this->getRandomString($size);
        $expense = new Expense();
        $expense->reference = $reference;
        $expense->date = date('Y-m-d', strtotime($request->date));

        if ($request->is_inventory_adjustment == "on")
        {
            $expense->is_inventory_adjustment = True;
            $expense->inventory_adjustment_id = $request->inventory_adjustment;
        }else{
            $expense->is_inventory_adjustment = False;
        }
        if ($request->is_transfer_order == "on")
        {
            $expense->is_transfer_order = True;
            $expense->transfer_order_id = $request->transfer_order;
        }else{
            $expense->is_transfer_order = False;
        }
        if ($request->is_warehouse == "on")
        {
            $expense->is_warehouse = True;
            $expense->warehouse_id = $request->warehouse;
        }else{
            $expense->is_warehouse = False;
        }
        if ($request->is_campaign == "on")
        {
            $expense->is_campaign = True;
            $expense->campaign_id = $request->campaign;
        }else{
            $expense->is_campaign = False;
        }
        if ($request->is_sale == "on")
        {
            $expense->is_sale = True;
            $expense->sale_id = $request->sale;
        }else{
            $expense->is_sale = False;
        }
        if ($request->is_liability == "on")
        {
            $expense->is_liability = True;
            $expense->liability_id = $request->liability;
        }else{
            $expense->is_liability = False;
        }
        if ($request->is_transfer == "on")
        {
            $expense->is_transfer = True;
            $expense->transfer_id = $request->transfer;
        }else{
            $expense->is_transfer = False;
        }
        if ($request->is_transaction == "on")
        {
            $expense->is_transaction = True;
            $expense->transaction_id = $request->transaction;
        }else{
            $expense->is_transaction = False;
        }


        if ($request->is_recurring == "on")
        {
            $expense->is_recurring = True;
            $expense->frequency_id = $request->frequency;
            $expense->start_repeat = date('Y-m-d', strtotime($request->start_date));
            $expense->end_repeat = date('Y-m-d', strtotime($request->end_date));
        }else
        {
            $expense->is_recurring = False;
        }
        if ($request->is_draft == "on")
        {
            $expense->is_draft = True;
        }else
        {
            $expense->is_draft = False;
        }

        $expense->sub_total = $request->subtotal;
        $expense->adjustment = $request->adjustment;
        $expense->total = $request->grand_total;
        $expense->paid = 0;

        $expense->notes = $request->notes;

        $expense->expense_account_id = $request->expense_account;
        $expense->user_id = $user->id;
        $expense->institution_id = $institution->id;
        $expense->status_id = $request->status;

        $expense->save();


        // item details
        foreach ($request->item_details as $item)
        {
            // item details
            $expenseItem = new ExpenseItem();
            $expenseItem->name = $item['item'];
            $expenseItem->quantity = $item['quantity'];
            $expenseItem->rate = $item['rate'];
            $expenseItem->amount = $item['amount'];
            $expenseItem->user_id = $user->id;
            $expenseItem->expense_id = $expense->id;
            $expenseItem->status_id = $request->status;
            $expenseItem->save();
        }

        return redirect()->route('business.expense.show',$expense->id)->withSuccess('Expense '.$expense->reference.' successfully created!');
    }

    public function expenseShow($expense_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // get expense
        $expense = Expense::where('institution_id',$institution->id)->where('id',$expense_id)->with('transfer','status','expense_items','transaction','expense_account','frequency','user','account','campaign','contact','expense_account','inventory_adjustment','liability','sale','sale','warehouse')->withCount('expense_items')->first();
        // get payments
        $payments = Transaction::where('institution_id',$institution->id)->where('expense_id',$expense->id)->where('status_id','2fb4fa58-f73d-40e6-ab80-f0d904393bf2')->with('expense','account','status')->get();
        // get pending payments
        $pendingPayments = Transaction::where('institution_id',$institution->id)->where('expense_id',$expense->id)->where('status_id','a40b5983-3c6b-4563-ab7c-20deefc1992b')->with('expense','account','status')->get();

        return view('business.expense_show',compact('expense','user','institution','payments','pendingPayments'));
    }

    public function expenseEdit($expense_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Get expense account
        $expenseAccounts = ExpenseAccount::where('institution_id',$institution->id)->get();
        // get orders
        $sales = Sale::where('institution_id',$institution->id)->with('status')->get();
        // expense statuses
        $expenseStatuses = Status::where('status_type_id','7805a9f3-c7ca-4a09-b021-cc9b253e2810')->get();
        // get transfers
        $transfers = Transfer::where('institution_id',$institution->id)->get();
        // get campaign
        $campaigns = Campaign::where('institution_id',$institution->id)->get();
        // get liabilities
        $liabilities = Liability::where('institution_id',$institution->id)->get();
        // get frequencies
        $frequencies = Frequency::where('institution_id',$institution->id)->get();
        // get expense
        $expense = Expense::where('institution_id',$institution->id)->where('id',$expense_id)->with('transfer','status','expense_items','transaction','expense_account','frequency','user','account','campaign','contact','expense_account','inventory_adjustment','liability','sale','sale','warehouse')->withCount('expense_items')->first();

        return view('business.expense_edit',compact('liabilities','campaigns','expense','user','institution','expenseAccounts','sales','expenseStatuses','transfers','frequencies'));
    }

    public function expenseUpdate(Request $request, $expense_id)
    {
        // User
        $user = $this->getUser();
        // Generate reference
        $size = 5;
        $reference = $this->getRandomString($size);
        $expenseExists = Expense::findOrFail($expense_id);
        $expense = Expense::where('id',$expense_id)->first();
        $expense->reference = $reference;
        $expense->expense_account_id = $request->expense_account;
        $expense->date = date('Y-m-d', strtotime($request->date));
        if ($request->is_order == "on")
        {
            $expense->is_order = True;
            $expense->order_id = $request->order;
        }else{
            $expense->is_order = False;
        }
        if ($request->is_album == "on")
        {
            $expense->is_album = True;
            $expense->album_id = $request->album;
        }else{
            $expense->is_album = False;
        }
        if ($request->is_project == "on")
        {
            $expense->is_project = True;
            $expense->project_id = $request->project;
        }else{
            $expense->is_project = False;
        }
        if ($request->is_design == "on")
        {
            $expense->is_design = True;
            $expense->design_id = $request->design;
        }else{
            $expense->is_design = False;
        }
        if ($request->is_transfer == "on")
        {
            $expense->is_transfer = True;
            $expense->transfer_id = $request->transfer;
        }else{
            $expense->is_transfer = False;
        }
        if ($request->is_transaction == "on")
        {
            $expense->is_transaction = True;
            $expense->transaction_id = $request->transaction;
        }else{
            $expense->is_transaction = False;
        }
        if ($request->is_campaign == "on")
        {
            $expense->is_campaign = True;
            $expense->campaign_id = $request->campaign;
        }else{
            $expense->is_campaign = False;
        }
        if ($request->is_asset == "on")
        {
            $expense->is_asset = True;
            $expense->asset_id = $request->asset;
        }else{
            $expense->is_asset = False;
        }
        if ($request->is_liability == "on")
        {
            $expense->is_liability = True;
            $expense->liability_id = $request->liability;
        }else{
            $expense->is_liability = False;
        }
        if ($request->is_recurring == "on")
        {
            $expense->is_recurring = True;
            $expense->frequency_id = $request->frequency;
            $expense->start_repeat = date('Y-m-d', strtotime($request->start_date));
            $expense->end_repeat = date('Y-m-d', strtotime($request->end_date));
        }else
        {
            $expense->is_recurring = False;
        }
        if ($request->is_draft == "on")
        {
            $expense->is_draft = True;
        }else
        {
            $expense->is_draft = False;
        }

        $expense->sub_total = $request->subtotal;
        $expense->adjustment = $request->adjustment;
        $expense->total = $request->grand_total;

        $expense->notes = $request->notes;

        $expense->user_id = $user->id;
        $expense->status_id = $request->status;

        $expense->save();

        $expenseProducts =array();
        // item details
        foreach ($request->item_details as $item)
        {
            // check if exists
            $expenseItem = ExpenseItem::where('expense_id',$expense->id)->where('name',$item['item'])->first();
            if($expenseItem)
            {
                $expenseProducts[]['id'] = $expenseItem->id;
                $expenseItem->name = $item['item'];
                $expenseItem->quantity = $item['quantity'];
                $expenseItem->rate = $item['rate'];
                $expenseItem->amount = $item['amount'];
                $expenseItem->user_id = $user->id;
                $expenseItem->expense_id = $expense->id;
                $expenseItem->status_id = $request->status;
                $expenseItem->save();
            }
            else
            {
                // item details
                $expenseItem = new ExpenseItem();
                $expenseItem->name = $item['item'];
                $expenseItem->quantity = $item['quantity'];
                $expenseItem->rate = $item['rate'];
                $expenseItem->amount = $item['amount'];
                $expenseItem->user_id = $user->id;
                $expenseItem->expense_id = $expense->id;
                $expenseItem->status_id = $request->status;
                $expenseItem->save();
                $expenseProducts[]['id'] = $expenseItem->id;
            }

        }
        // Get the deleted expense items
        $expenseItemIds = ExpenseItem::where('expense_id',$expense->id)->whereNotIn('id',$expenseProducts)->select('id')->get()->toArray();

        // Delete removed expense items
        DB::table('expense_items')->whereIn('id', $expenseItemIds)->delete();

        return redirect()->route('business.expense.show',$expense->id)->withSuccess('Expense '.$expense->reference.' successfully updated!');
    }

    public function expenseDelete()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // TODO expense delete
        // Get albums
        $expenses = Expense::with('user','status')->get();

        return view('business.expenses',compact('expenses','user','institution'));
    }

    public function expenseRestore()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // TODO expense restore
        // Get albums
        $expenses = Expense::with('user','status')->get();

        return view('business.expenses',compact('expenses','user','institution'));
    }


    public function transactions()
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Get albums
        $transactions = Transaction::where('institution_id',$institution->id)->with('user','status','account','expense')->get();
        return view('business.transactions',compact('transactions','user','institution','transactions'));

    }

    public function transactionCreate($expense_id)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // get expenses
        $expense = Expense::findOrFail($expense_id);
        // accounts
        $accounts = Account::where('institution_id',$institution->id)->get();

        // transaction statuses
        $transactionStatuses = Status::where('status_type_id','8f56fc70-6cd8-496f-9aec-89e5748968db')->get();
        return view('business.transaction_create',compact('accounts','expense','user','institution','transactionStatuses'));
    }

    public function transactionStore(Request $request)
    {
        // get expense
        $expense = Expense::findOrFail($request->expense);
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // new transaction
        $size = 5;
        $reference = $this->getRandomString($size);
        $transaction = new Transaction();
        $transaction->expense_id = $request->expense;
        $transaction->account_id = $request->account;
        $transaction->amount = $request->amount;

        $transaction->initial_amount = 0;
        $transaction->subsequent_amount = 0;

        $transaction->reference = $reference;
        $transaction->date = date('Y-m-d', strtotime($request->date));
        $transaction->notes = $request->notes;
        $transaction->user_id = $user->id;
        $transaction->institution_id = $institution->id;
        $transaction->status_id = $request->status;
        $transaction->save();

        // account subtraction
        if ($request->status_id = '2fb4fa58-f73d-40e6-ab80-f0d904393bf2'){

            // update expense paid
            $expensePaid = Expense::where('id',$request->expense)->first();
            $expensePaid->paid = doubleval($expensePaid->paid)+doubleval($request->amount);
            $expensePaid->save();
            // if liability
            if ($expense->is_liability == 1){
                $liability = Liability::findOrFail($expense->liability_id);
                $liability->paid = doubleval($liability->paid)+doubleval($request->amount);
                $liability->save();
            }
            // sale
            if ($expense->is_sale == 1){
                $sale = Sale::findOrFail($expense->sale_id);
                $sale->paid = doubleval($sale->paid)+doubleval($request->amount);
                $sale->save();
            }
            // campaign
            if ($expense->is_campaign == 1){
                $campaign = Campaign::findOrFail($expense->campaign_id);
                $campaign->actual_cost = doubleval($campaign->actual_cost)+doubleval($request->amount);
                $campaign->save();
            }

            $account = Account::where('id',$request->account)->first();

            // update transaction
            $transaction = Transaction::findOrFail($transaction->id);
            $transaction->initial_amount = $account->balance;
            $transaction->subsequent_amount = doubleval($account->balance)-doubleval($request->amount);
            $transaction->save();

            // update account balance
            $account->balance = doubleval($account->balance)-doubleval($request->amount);
            $account->save();
        }

        return redirect()->route('business.expense.show',$transaction->expense_id)->withSuccess('Expense '.$transaction->reference.' successfully updated!');

    }

    public function transactionStatusChange(Request $request,$transaction_id)
    {

        // User
        $user = $this->getUser();
        // Check if transaction exists
        $transaction = Transaction::findOrFail($transaction_id);
        // get transaction
        $transaction = Transaction::where('id',$transaction_id)->first();
        $transaction->user_id = $user->id;
        $transaction->status_id = $request->status;
        $transaction->save();

        if ($request->status_id = '2fb4fa58-f73d-40e6-ab80-f0d904393bf2')
        {
            // update expense paid
            $expensePaid = Expense::where('id',$request->expense)->first();
            $expensePaid->paid = doubleval($expensePaid->paid)+doubleval($request->amount);
            $expensePaid->save();

            $account = Account::where('id',$request->account)->first();

            // update transaction
            $transaction = Transaction::findOrFail($transaction->id);
            $transaction->initial_amount = $account->balance;
            $transaction->subsequent_amount = doubleval($account->balance)-doubleval($request->amount);
            $transaction->save();

            // update account balance

            $account->balance = doubleval($account->balance)-doubleval($request->amount);
            $account->save();
        }
        // account subtraction

        return back()->withSuccess('Expense '.$transaction->reference.' status successfully updated!');
    }

    public function transactionPendingPayment(Request $request, $transaction_id)
    {

        // TODO figure out account
        // User
        $user = $this->getUser();
        // Check if transaction exists
        $transactionExists = Transaction::findOrFail($transaction_id);

        // get and update transaction
        $transaction = Transaction::where('id',$transaction_id)->first();
        $transaction->date = date('Y-m-d');
        $transaction->user_id = $user->id;
        $transaction->status_id = '2fb4fa58-f73d-40e6-ab80-f0d904393bf2';
        $transaction->save();

        // update expense paid
        $expensePaid = Expense::where('id',$request->expense)->first();
        $expensePaid->paid = doubleval($expensePaid->paid)+doubleval($request->amount);
        $expensePaid->save();

        $account = Account::where('id',$request->account)->first();

        // update transaction
        $transaction = Transaction::findOrFail($transaction->id);
        $transaction->initial_amount = $account->balance;
        $transaction->subsequent_amount = doubleval($account->balance)-doubleval($request->amount);
        $transaction->save();

        // update account balance
        $account->balance = doubleval($account->balance)-doubleval($request->amount);
        $account->save();

        return back()->withSuccess('Expense '.$transaction->reference.' successfully marked as billed!');

    }

    public function transactionBilled($transaction_id)
    {

        // User
        $user = $this->getUser();
        // Check if transaction exists
        $transactionExists = Transaction::findOrFail($transaction_id);

        // get and update transaction
        $transaction = Transaction::where('id',$transaction_id)->first();
        $transaction->billed = date('Y-m-d');
        $transaction->user_id = $user->id;
        $transaction->status_id = '2fb4fa58-f73d-40e6-ab80-f0d904393bf2';
        $transaction->is_billed = True;
        $transaction->save();

        // update account, credit previously paid amount
        $account = Account::where('id',$transaction->account_id)->first();
        $account->balance = doubleval($account->balance) + doubleval($transaction->amount);
        $account->user_id = $user->id;
        $account->save();

        // create record to track when billed

        return back()->withSuccess('Expense '.$transaction->reference.' successfully marked as billed!');

    }
    // test
    public function testRecurring(){

        $orderData = [
            'message'=>'Test'
        ];

        Mail::to('tmbindyo@fluidtechglobal.com')->send(new CancelledOrder($orderData));

    }


    // payments
    public function payments()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        $payments = Payment::where('institution_id',$institution->id)->with('user','status','account')->get();
        return view('business.payments',compact('payments','user','institution'));
    }

    public function paymentCreate()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // get accounts
        $accounts = Account::where('institution_id',$institution->id)->get();
        // loans
        $loans = Loan::where('institution_id',$institution->id)->get();
        // sales
        $sales = Sale::where('institution_id',$institution->id)->get();
        return view('business.payment_create',compact('user','institution','accounts','loans','sales'));
    }

    public function paymentStore(Request $request)
    {


        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // generate reference
        $size = 5;
        $reference = $this->getRandomString($size);

        // get account
        $account = Account::findOrFail($request->account);
        $accountBalance = doubleval($account->balance) + doubleval($request->amount);
        $payment = new Payment();
        $payment->reference = $reference;
        $payment->notes = $request->notes;
        $payment->date = date('Y-m-d', strtotime($request->date));
        $payment->initial_balance = $account->balance;
        $payment->amount = $request->amount;
        $payment->current_balance = $accountBalance;

        if($request->is_loan == "on"){
            $payment->is_loan = True;
            $payment->loan_id = $request->loan;
            // update loan as paid
            $loan = Loan::findOrFail($request->loan);
            $paid = doubleval($request->amount) + doubleval($loan->paid);
            $loan->paid = $paid;
            $loan->save();
        }else{
            $payment->is_loan = False;
        }

        if($request->is_liability == "on"){
            $payment->is_liability = True;
            $payment->liability_id = $request->liability;
            // update liability as paid
            $liability = Liability::findOrFail($request->liability);
            $paid = doubleval($request->amount) + doubleval($liability->paid);
            $liability->paid = $paid;
            $liability->save();
        }else{
            $payment->is_loan = False;
        }

        if($request->is_sale == "on"){
            $payment->is_sale = True;
            $payment->sale_id = $request->sale;
            // update sale as paid
            $sale = Sale::findOrFail($request->sale);
            $paid = doubleval($request->amount) + doubleval($sale->paid);
            $balance = doubleval($sale->total) - doubleval($paid);
            $sale->balance = $balance;
            $sale->paid = $paid;
            $sale->save();

            // reduce stock
            $saleProducts = SaleProduct::where('sale_id',$sale->id)->get();
            foreach($saleProducts as $saleProduct){
                // return $saleProduct;
                $inventory = Inventory::where('product_id',$saleProduct->product_id)->where('warehouse_id',$saleProduct->warehouse_id)->first();
                $quantity = doubleval($inventory->quantity) - doubleval($saleProduct->quantity);
                $inventory->quantity = $quantity;
                $inventory->save();
            }

        }else{
            $payment->is_sale = False;
        }

        $payment->account_id = $request->account;
        $payment->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $payment->user_id = $user->id;
        $payment->save();

        // credit account
        $account->balance = $accountBalance;
        $account->save();

        return redirect()->route('business.payment.show',$payment->id)->withSuccess('Payment created!');
    }

    public function paymentShow($payment_id)
    {
        // Check if contact type exists
        $paymentExists = Payment::findOrFail($payment_id);
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Get contact type
        $payment = Payment::with('user','status','refunds.account','loan','sale')->where('id',$payment_id)->first();
        return view('business.payment_show',compact('payment','user','institution'));
    }

    public function paymentDelete($payment_id)
    {

        $payment = Payment::findOrFail($payment_id);
        $payment->delete();

        return back()->withSuccess(__('Payment '.$payment->name.' successfully deleted.'));
    }
    public function paymentRestore($payment_id)
    {

        $payment = Payment::findOrFail($payment_id);
        $payment->restore();

        return back()->withSuccess(__('Payment '.$payment->name.' successfully restored.'));
    }



    // refunds
    public function refunds()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // refunds
        $refunds = Refund::where('institution_id',$institution->id)->with('user','status','account')->get();
        return view('business.refunds',compact('refunds','user','institution'));
    }

    public function refundCreate($payment_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // get accounts
        $accounts = Account::where('institution_id',$institution->id)->get();
        // payment
        $payment = Payment::findOrFail($payment_id);
        return view('business.refund_create',compact('user','institution','accounts','payment'));
    }

    public function refundStore(Request $request)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // generate reference
        $size = 5;
        $reference = $this->getRandomString($size);

        // get account
        $account = Account::findOrFail($request->account);
        $accountBalance = doubleval($account->balance) - doubleval($request->amount);

        // store refund record
        $refund = new Refund();
        $refund->reference = $reference;
        $refund->notes = $request->notes;

        $refund->initial_amount = $account->balance;
        $refund->subsequent_amount = $accountBalance;
        $refund->amount = $request->amount;

        $refund->date = date('Y-m-d', strtotime($request->date));

        $refund->payment_id = $request->payment;
        $refund->account_id = $request->account;
        $refund->institution_id = $institution->id;

        $refund->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $refund->user_id = $user->id;
        $refund->save();

        // update accounts balance
        $account->balance = $accountBalance;
        $account->save();

        return redirect()->route('business.refund.show',$refund->id)->withSuccess('Refund created!');
    }

    public function refundShow($refund_id)
    {
        // Check if contact type exists
        $refundExists = Refund::findOrFail($refund_id);
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // Get contact type
        $refund = Refund::with('user','status','account','payment')->where('id',$refund_id)->first();
        return view('business.refund_show',compact('refund','user','institution'));
    }

    public function refundUpdate(Request $request, $refund_id)
    {

        $refund = Refund::findOrFail($refund_id);

        return redirect()->route('business.refund.show',$refund->id)->withSuccess('Refund updated!');
    }

    public function refundDelete($refund_id)
    {

        $refund = Refund::findOrFail($refund_id);
        $refund->delete();

        return back()->withSuccess(__('Refund '.$refund->name.' successfully deleted.'));
    }

    public function refundRestore($refund_id)
    {

        $refund = Refund::findOrFail($refund_id);
        $refund->restore();

        return back()->withSuccess(__('Refund '.$refund->name.' successfully restored.'));
    }
}
