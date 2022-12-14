<?php

namespace App\Http\Controllers\Business;

use App\Traits\InstitutionTrait;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ToDo;
use DB;
use App\Sale;
use App\Status;
use App\Transfer;
use App\Priority;
use App\Campaign;
use App\Category;
use App\PaymentSchedule;
use App\Frequency;
use App\Account;
use App\Product;
use App\SubCategory;
use App\UserAccount;
use App\CategoryUser;
use App\CategoryExpense;
use App\CategoryExpenseItem;
use App\Traits\ReferenceNumberTrait;

class CategoryController extends Controller
{

    use UserTrait;
    use institutionTrait;
    use ReferenceNumberTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }







    public function categories($portal)
    {
        // User
        $user = $this->getUser();
        // return $user;
        // Institution
        $institution = $this->getInstitution($portal);
        // categories
        // $categories = Category::with('user', 'status', 'institution')->whereHas('categoryUsers', function($q) use ($user){
        //     $q->where('category_user_id', $user->id)->where('category_id', $q->id);
        // })->where('institution_id', $institution->id)->where('is_institution', true)->get();
        // return $categories;

        $categoryIds = CategoryUser::where('category_user_id', $user->id)->pluck('category_id')->toArray();
        // return $categoryIds;
        $categories = Category::with('user', 'status', 'institution')->where('institution_id', $institution->id)->where('is_institution', true)->whereIn('id',$categoryIds)->get();

        $deletedCategories = Category::with('user', 'status', 'institution')->where('institution_id', $institution->id)->where('status_id', 'd35b4cee-5594-4cfd-ad85-e489c9dcdeff')->where('is_institution', true)->get();
        return view('business.categories', compact('user', 'institution', 'categories', 'deletedCategories'));

    }




    public function categoryStore(Request $request, $portal)
    {
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution($portal);

        // select account type
        $category = new Category();
        $category->name = $request->name;
        $category->description = " ";
        $category->is_institution = true;
        $category->user_id = $user->id;
        $category->institution_id = $institution->id;
        $category->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $category->save();


        // give user acceess to category
        $categoryUser = new CategoryUser();
        $categoryUser->category_id = $category->id;
        $categoryUser->category_user_id = $user->id;
        $categoryUser->institution_id = $institution->id;
        $categoryUser->is_institution = true;
        $categoryUser->user_id = $user->id;
        $categoryUser->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $categoryUser->save();


        return redirect()->route('business.category.show',['portal'=>$institution->portal, 'id'=>$category->id])->withSuccess('Category '.$category->name.' successfully created!');
    }


    public function categoryShow($portal, $category_id)
    {
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution($portal);
        // get category
        $category = Category::where('id', $category_id)->where('is_institution', true)->where('institution_id', $institution->id)->with('status', 'user', 'categoryExpenses', 'categoryExpenses.subCategory', 'categoryUsers', 'subCategories')->first();

        // category expeensee items
        $categoryExpensesIds = CategoryExpense::where('category_id', $category->id)->pluck('id')->toArray();
        $categoryExpenseItems = CategoryExpenseItem::whereIn('category_expense_id', $categoryExpensesIds)->with('categoryExpense', 'categoryExpense.category')->get();
        // return $categoryExpenseItems;
        // institution users
        // $registeredUserIds = CategoryUser::where('institution_id', $institution->id)->with('categoryUser')->get();
        // return $registeredUserIds;
        $registeredUserIds = CategoryUser::where('institution_id', $institution->id)->where('category_id', $category->id)->select('user_id')->get()->toArray();
        $institutionUsers = UserAccount::with('user')->where('is_institution', True)->where('institution_id', $institution->id)->whereNotIn('user_id', $registeredUserIds)->get();
        // return $institutionUsers;

        // Pending to dos
        $pendingToDos = ToDo::where('institution_id', $institution->id)->where('is_institution', true)->with('user', 'status', 'category')->where('status_id', 'f3df38e3-c854-4a06-be26-43dff410a3bc')->where('category_id', $category->id)->get();
        // In progress to dos
        $inProgressToDos = ToDo::where('institution_id', $institution->id)->where('is_institution', true)->with('user', 'status', 'category')->where('status_id', '2a2d7a53-0abd-4624-b7a1-a123bfe6e568')->where('category_id', $category->id)->get();
        // Completed to dos
        $completedToDos = ToDo::where('institution_id', $institution->id)->where('is_institution', true)->with('user', 'status', 'category')->where('status_id', 'facb3c47-1e2c-46e9-9709-ca479cc6e77f')->where('category_id', $category->id)->get();
        // Overdue to dos
        $overdueToDos = ToDo::where('institution_id', $institution->id)->where('is_institution', true)->with('user', 'status', 'category')->where('status_id', '99372fdc-9ca0-4bca-b483-3a6c95a73782')->where('category_id', $category->id)->get();

        return view('business.category_show', compact('overdueToDos', 'completedToDos', 'inProgressToDos', 'pendingToDos', 'category', 'user', 'institution', 'institutionUsers', 'categoryExpenseItems'));
    }




    public function categoryUpdate(Request $request, $portal, $category_id)
    {
//        return $request;
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution($portal);
        // select account type
        $categoryExists = Category::findOrFail($category_id);
        $category = Category::where('id', $category_id)->first();

        $category->name = $request->name;
        $category->description = " ";
        $category->save();


        return redirect()->route('business.category.show',['portal'=>$institution->portal, 'id'=>$category->id])->withSuccess('Category '.$category->name.' successfully created!');
    }





    public function subCategoryStore(Request $request, $portal, $category_id)
    {
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution($portal);

        // select account type
        $category = new SubCategory();
        $category->name = $request->name;
        $category->category_id = $category_id;
        $category->is_institution = true;
        $category->user_id = $user->id;
        $category->institution_id = $institution->id;
        $category->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $category->save();


        return redirect()->route('business.category.show',['portal'=>$institution->portal, 'id'=>$category_id])->withSuccess('Category '.$category->name.' successfully created!');
    }




    public function categoryExpenseCreate($portal, $category_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // priorities
        $priorities = Priority::all();
        // category
        $categoryExists = Category::findOrFail($category_id);
        $category = Category::where('id', $category_id)->first();
        $subCategories = SubCategory::where('category_id',$category_id)->get();

        return view('business.category_expense_create', compact( 'user', 'priorities', 'institution', 'category', 'subCategories'));
    }

    public function categoryExpenseStore(Request $request, $portal)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Generate reference
        $size = 5;
        $reference = $this->getRandomString($size);
        $expense = new CategoryExpense();
        $expense->reference = $reference;
        $expense->date = date('Y-m-d', strtotime($request->date));




        $expense->paid = 0;
        $expense->balance = 0;
        $expense->sub_total = $request->subtotal;
        $expense->adjustment = $request->adjustment;
        $expense->total = $request->grand_total;

        $expense->notes = "";

        $expense->category_id = $request->category;
        $expense->sub_category_id = $request->sub_category;
        $expense->user_id = $user->id;
        $expense->institution_id = $institution->id;

        $expense->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";

        $expense->is_institution = true;

        $expense->save();


        // item details
        foreach ($request->item_details as $item)
        {
            $data = $item['item'];



            // item details
            $expenseItem = new CategoryExpenseItem();
            $expenseItem->name = $item['item'];
            $expenseItem->quantity = $item['quantity'];
            $expenseItem->rate = $item['rate'];
            $expenseItem->amount = $item['amount'];

            $expenseItem->date = date('Y-m-d', strtotime($item['date']));
            $expenseItem->due_date = date('Y-m-d', strtotime($item['due_date']));

            $expenseItem->priority_id = $item['priority'];
            $expenseItem->status_id = "7feeea3a-d716-4be2-93e1-88c5082457c6";

            $expenseItem->category_expense_id = $expense->id;
            $expenseItem->user_id = $user->id;
            $expenseItem->save();




        }

        return redirect()->route('business.category.expense.show',['portal'=>$institution->portal, 'id'=>$expense->id])->withSuccess('Expense '.$expense->reference.' successfully created!');
    }

    public function categoryExpenseShow($portal, $category_expense_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // get expense
        $expense = CategoryExpense::where('institution_id', $institution->id)->where('is_institution', true)->where('id', $category_expense_id)->with('status', 'categoryExpenseItems', 'category', 'user', 'subCategory')->withCount('categoryExpenseItems')->first();
        // Pending to dos
        $pendingToDos = ToDo::where('institution_id', $institution->id)->where('is_institution', true)->with('user', 'status', 'expense')->where('status_id', 'f3df38e3-c854-4a06-be26-43dff410a3bc')->where('expense_id', $expense->id)->get();
        // In progress to dos
        $inProgressToDos = ToDo::where('institution_id', $institution->id)->where('is_institution', true)->with('user', 'status', 'expense')->where('status_id', '2a2d7a53-0abd-4624-b7a1-a123bfe6e568')->where('expense_id', $expense->id)->get();
        // Completed to dos
        $completedToDos = ToDo::where('institution_id', $institution->id)->where('is_institution', true)->with('user', 'status', 'expense')->where('status_id', 'facb3c47-1e2c-46e9-9709-ca479cc6e77f')->where('expense_id', $expense->id)->get();
        // Overdue to dos
        $overdueToDos = ToDo::where('institution_id', $institution->id)->where('is_institution', true)->with('user', 'status', 'expense')->where('status_id', '99372fdc-9ca0-4bca-b483-3a6c95a73782')->where('expense_id', $expense->id)->get();

        return view('business.category_expense_show', compact('overdueToDos', 'completedToDos', 'inProgressToDos', 'pendingToDos', 'expense', 'user', 'institution'));
    }

    public function categoryExpenseEdit($portal, $category_expense_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // priorities
        $priorities = Priority::all();
        // get expense
        $expense = CategoryExpense::where('institution_id', $institution->id)->where('is_institution', true)->where('id', $category_expense_id)->with('status', 'categoryExpenseItems', 'category', 'user')->withCount('categoryExpenseItems')->first();
        $expenseCategoryCount = CategoryExpenseItem::where('category_expense_id', $expense->id)->count();
        $expenseCategoryCount = $expenseCategoryCount+=1;
        // return $expenseCategoryCount;
        return view('business.category_expense_edit', compact('expense', 'user', 'institution', 'priorities', 'expenseCategoryCount'));
    }

    public function categoryExpenseUpdate(Request $request, $portal, $category_expense_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Generate reference
        $size = 5;
        $reference = $this->getRandomString($size);
        $expenseExists = CategoryExpense::findOrFail($category_expense_id);
        $expense = CategoryExpense::where('id', $category_expense_id)->first();


        $expense->sub_total = $request->subtotal;
        $expense->adjustment = $request->adjustment;
        $expense->total = $request->grand_total;


        $expense->user_id = $user->id;

        $expense->save();

        $expenseProducts =array();
        // item details
        // return $request->item_details;
        foreach ($request->item_details as $item)
        {
            // check if exists
            $expenseItem = CategoryExpenseItem::where('category_expense_id', $expense->id)->where('name', $item['item'])->first();
            if($expenseItem)
            {
                $expenseProducts[]['id'] = $expenseItem->id;
                $expenseItem->name = $item['item'];
                $expenseItem->quantity = $item['quantity'];
                $expenseItem->rate = $item['rate'];
                $expenseItem->amount = $item['amount'];

                $expenseItem->date = date('Y-m-d', strtotime($item['date']));
                $expenseItem->due_date = date('Y-m-d', strtotime($item['due_date']));

                $expenseItem->priority_id = $item['priority'];
                // $expenseItem->status_id = $item['status'];

                $expenseItem->user_id = $user->id;
                $expenseItem->category_expense_id = $expense->id;
                $expenseItem->save();
            }
            else
            {
                // item details
                $expenseItem = new CategoryExpenseItem();
                $expenseItem->name = $item['item'];
                $expenseItem->quantity = $item['quantity'];
                $expenseItem->rate = $item['rate'];
                $expenseItem->amount = $item['amount'];

                $expenseItem->date = date('Y-m-d', strtotime($item['date']));
                $expenseItem->due_date = date('Y-m-d', strtotime($item['due_date']));

                $expenseItem->priority_id = $item['priority'];
                $expenseItem->status_id = "7feeea3a-d716-4be2-93e1-88c5082457c6";

                $expenseItem->user_id = $user->id;
                $expenseItem->category_expense_id = $expense->id;
                $expenseItem->save();
                $expenseProducts[]['id'] = $expenseItem->id;
            }

        }


        // update paid

        // Get the deleted expense items
        $expenseItemIds = CategoryExpenseItem::where('category_expense_id', $expense->id)->whereNotIn('id', $expenseProducts)->select('id')->get()->toArray();

        // Delete removed expense items
        DB::table('category_expense_items')->whereIn('id', $expenseItemIds)->delete();

        return redirect()->route('business.category.expense.show',['portal'=>$institution->portal, 'id'=>$expense->id])->withSuccess('Expense '.$expense->reference.' successfully updated!');
    }

    public function categoryExpenseDelete($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // TODO expense delete
        // Get expenses
        $expenses = CategoryExpense::with('user', 'status')->get();

        return view('business.expenses', compact('expenses', 'user', 'institution'));
    }

    public function categoryExpenseRestore($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // TODO expense restore
        // Get expenses
        $expenses = CategoryExpense::with('user', 'status')->get();

        return view('business.expenses', compact('expenses', 'user', 'institution'));
    }








    public function categoryExpenseItemPaid($portal, $category_expens_item_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // expense item
        $expenseItem = CategoryExpenseItem::where('id', $category_expens_item_id)->first();
        $expenseItem->status_id = '0044ee5b-d3f8-4feb-a108-92e65b48e449';
        $expenseItem->save();


        $expense = CategoryExpense::where('institution_id', $institution->id)->where('is_institution', true)->where('id', $expenseItem->category_expense_id)->with('status', 'categoryExpenseItems', 'category', 'user')->withCount('categoryExpenseItems')->first();

        // total of expense items markeet as paid
        $totalExpenseItems = CategoryExpenseItem::where('category_expense_id', $expense->id)->sum('amount');
        $paidExpenseItems = CategoryExpenseItem::where('category_expense_id', $expense->id)->where('status_id', '0044ee5b-d3f8-4feb-a108-92e65b48e449')->sum('amount');
        $expense->paid = $paidExpenseItems;
        $expense->balance = doubleval($totalExpenseItems) - doubleval($paidExpenseItems);
        $expense->save();

        return redirect()->route('business.category.expense.show',['portal'=>$institution->portal, 'id'=>$expenseItem->category_expense_id])->withSuccess('Expense status for expeense item '.$expenseItem->name.' has been succesfully changed to paid!');
    }

    public function categoryExpenseItemEdit($portal, $category_expens_item_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // expense item
        $expenseItem = CategoryExpenseItem::where('id', $category_expens_item_id)->first();
        $expenseItem->status_id = '3091eee3-e1ca-4698-a46d-2faa4719bb59';
        $expenseItem->save();

        $expense = CategoryExpense::where('institution_id', $institution->id)->where('is_institution', true)->where('id', $expenseItem->category_expense_id)->with('status', 'categoryExpenseItems', 'category', 'user')->withCount('categoryExpenseItems')->first();

        // total of expense items markeet as paid
        $totalExpenseItems = CategoryExpenseItem::where('category_expense_id', $expense->id)->sum('amount');
        $paidExpenseItems = CategoryExpenseItem::where('category_expense_id', $expense->id)->where('status_id', '0044ee5b-d3f8-4feb-a108-92e65b48e449')->sum('amount');
        $expense->paid = $paidExpenseItems;
        $expense->balance = doubleval($totalExpenseItems) - doubleval($paidExpenseItems);
        $expense->save();

        return redirect()->route('business.category.expense.show',['portal'=>$institution->portal, 'id'=>$expenseItem->category_expense_id])->withSuccess('Expense status for expeense item '.$expenseItem->name.' has been succesfully changed to edit!');
    }

    public function categoryExpenseItemDeclined($portal, $category_expens_item_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // expense item

        $expenseItem = CategoryExpenseItem::where('id', $category_expens_item_id)->first();
        $expenseItem->status_id = '58d1a430-a171-4e72-a0d0-9bd8520f8ac3';
        $expenseItem->save();

        $expense = CategoryExpense::where('institution_id', $institution->id)->where('is_institution', true)->where('id', $expenseItem->category_expense_id)->with('status', 'categoryExpenseItems', 'category', 'user')->withCount('categoryExpenseItems')->first();


        // total of expense items markeet as paid
        $totalExpenseItems = CategoryExpenseItem::where('category_expense_id', $expense->id)->sum('amount');
        $paidExpenseItems = CategoryExpenseItem::where('category_expense_id', $expense->id)->where('status_id', '0044ee5b-d3f8-4feb-a108-92e65b48e449')->sum('amount');
        $expense->paid = $paidExpenseItems;
        $expense->balance = doubleval($totalExpenseItems) - doubleval($paidExpenseItems);
        $expense->save();


        return redirect()->route('business.category.expense.show',['portal'=>$institution->portal, 'id'=>$expenseItem->category_expense_id])->withSuccess('Expense status for expeense item '.$expenseItem->name.' has been succesfully changed to declined!');
    }








    public function institutionCategoryBreakdown($portal)
    {
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution($portal);


        // get category
        $category = Category::where('is_institution', true)->where('institution_id', $institution->id)->with('status', 'user', 'categoryExpenses', 'categoryUsers')->first();


        // institution users
        // $registeredUserIds = CategoryUser::where('institution_id', $institution->id)->with('categoryUser')->get();
        // return $registeredUserIds;
        $registeredUserIds = CategoryUser::where('institution_id', $institution->id)->where('category_id', $category->id)->select('user_id')->get()->toArray();
        $institutionUsers = UserAccount::with('user')->where('is_institution', True)->where('institution_id', $institution->id)->whereNotIn('user_id', $registeredUserIds)->get();
        // return $institutionUsers;

        // Pending to dos
        $pendingToDos = ToDo::where('institution_id', $institution->id)->where('is_institution', true)->with('user', 'status', 'category')->where('status_id', 'f3df38e3-c854-4a06-be26-43dff410a3bc')->where('category_id', $category->id)->get();
        // In progress to dos
        $inProgressToDos = ToDo::where('institution_id', $institution->id)->where('is_institution', true)->with('user', 'status', 'category')->where('status_id', '2a2d7a53-0abd-4624-b7a1-a123bfe6e568')->where('category_id', $category->id)->get();
        // Completed to dos
        $completedToDos = ToDo::where('institution_id', $institution->id)->where('is_institution', true)->with('user', 'status', 'category')->where('status_id', 'facb3c47-1e2c-46e9-9709-ca479cc6e77f')->where('category_id', $category->id)->get();
        // Overdue to dos
        $overdueToDos = ToDo::where('institution_id', $institution->id)->where('is_institution', true)->with('user', 'status', 'category')->where('status_id', '99372fdc-9ca0-4bca-b483-3a6c95a73782')->where('category_id', $category->id)->get();

        return view('business.category_show', compact('overdueToDos', 'completedToDos', 'inProgressToDos', 'pendingToDos', 'category', 'user', 'institution', 'institutionUsers'));
    }

}
