<?php

namespace App\Http\Controllers\Business;

use App\Traits\InstitutionTrait;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class DashboardController extends Controller
{

    use UserTrait;
    use institutionTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.dashboard', compact('user', 'institution'));
    }


    public function breakdown($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        // category breakdown
        $categories = Category::with('user', 'status', 'institution', 'categoryTotalSubTotal', 'categoryTotalAdjustment', 'categoryTotalTotal', 'categoryTotalPaid', 'categoryTotalBalance')->get();
        return $categories;

        return view('business.breakdown', compact('user', 'institution', 'categories'));
    }
}
