<?php

namespace App\Http\Controllers;

use App\Http\Requests\CloseSmenaRequest;
use App\Http\Requests\OpenSmenaRequest;
use Illuminate\Http\Request;
use App\Models\ElchiLevel;
use App\Models\ElchiBall;
use App\Models\ElchiElexir;
use App\Models\PharmacyUser;
use App\Models\ShiftCode;
use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ShiftController extends Controller
{
    public function index()
    {
        $level = ElchiLevel::where('user_id', Auth::user()->id)->value('level');
        $elchi_ball = ElchiBall::where('user_id', Auth::user()->id)->first();
        $elchi_elexir = ElchiElexir::where('user_id', Auth::user()->id)->first();


        return view('shift.index', compact('level', 'elchi_ball', 'elchi_elexir', 'shifts', 'pharmacy', 'shift_code', 'shift_close_code'));
    }
    public function open(OpenSmenaRequest $request)
    {
        // $exist = Shift->where('user_id', Auth::id())->whereDate('open_date', date('Y-m-d'))->exists();
        $makeCloseShift = Shift::where('pharma_id', $request->pharmacy)
        ->where('user_id', Auth::id())
        ->whereDate('open_date', date('Y-m-d'))
        ->orderBy('id','DESC')
        ->where('active', 0)
        ->first();
        
        if ($makeCloseShift) {
            $x = 15;
            $file = $request->file('open_selfi');
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $img = \Image::make($file);
            $img->save('images/users/open_smena/' . $imageName, $x);

            Shift::where('pharma_id', $request->pharmacy)
            ->where('user_id', Auth::id())
            ->whereDate('open_date', date('Y-m-d'))
            ->where('active', 0)
            ->update([
                'active' => 1,
                'open_image' => $imageName,
                'open_code' => $request->open_code,
                'admin_check' => null
            ]);
            return redirect()->back()->with('smena', 'Smena va kassa ochildi');
        } else {
            $x = 15;
            $file = $request->file('open_selfi');
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $img = \Image::make($file);
            $img->save('images/users/open_smena/' . $imageName, $x);

            $new = new Shift([
                'open_date' => date('Y-m-d H:i:s'),
                'close_date' => NULL,
                'user_id' => Auth::user()->id,
                'active' => 1,
                'open_code' => $request->open_code,
                'close_code' => '200',
                'admin_check' => NULL,
                'open_image' => $imageName,
                'close_image' => NULL,
                'pharma_id' => $request->pharmacy
            ]);
            $new->save();
            recommendNews();
            if ($new->id) {
                $duplicates = Shift::whereDate('open_date', Carbon::now())->where('user_id', Auth::id())->where('active', 1)->orderBy('id', 'ASC')->pluck('id')->toArray();
                if (count($duplicates) > 1) {
                    array_pop($duplicates);
                    Shift::whereIn('id', $duplicates)->delete();
                }
                return redirect()->back()->with('smena', 'Smena va kassa ochildi');
            }
        }
    }
    public function close(CloseSmenaRequest $request)
    {

        $x = 15;
        $file = $request->file('close_selfi');
        $imageName = time() . '.' . $file->getClientOriginalExtension();
        $img = \Image::make($file);
        $img->save('images/users/close_smena/' . $imageName, $x);

        $new = Shift::where('active', 1)->where('user_id', Auth::user()->id)->update([
            'close_date' => date('Y-m-d H:i:s'),
            'close_image' => $imageName,
            'close_code' => $request->close_code,
            'active' => 2,
        ]);

        return redirect()->back()->with('smena', 'Smena va kassa yopildi');
    }
}
