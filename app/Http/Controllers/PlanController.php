<?php

namespace App\Http\Controllers;

use App\Models\Liga;
use App\Services\PlanFactService;
use App\Services\PlanServices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    public  function changePlan(Request $request)
    {
        $inputs = $request->all();

        unset($inputs['_token']);

        $plan = new PlanServices;
        $new_plan = $plan->changePlan($inputs['liga_id']);
        
        return redirect()->back();
    }

    public function getPlans($date)
    {
        $planfact = new PlanFactService;
        return response()->json($planfact->getPlan($date));
    }
}
