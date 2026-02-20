<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Enums\CouponTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Repositories\CouponRepository;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::latest()->get();
        $couponTypes = CouponTypeEnum::cases();
        return view('admin.coupon.index', compact('coupons', 'couponTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'couponCode' => 'required|unique:coupons,coupon_code',
            'type' => 'required',
            'discount' => 'required|numeric',
            'startDate' => 'required|date|after_or_equal:today',
            'expiryDate' => 'required|date|after:start_date',
        ]);

        CouponRepository::storeByRequest($request);

        return back()->withSuccess('Coupon created successfully');
    }

    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'type' => 'required',
            'discount' => 'required|numeric',
            'startDate' => 'required|date|after_or_equal:today',
            'expiryDate' => 'required|date|after:start_date',
        ]);

        CouponRepository::updateByRequest($request, $coupon);

        return back()->withSuccess('Coupon updated successfully');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return back()->withSuccess('Coupon deleted successfully');
    }
}
