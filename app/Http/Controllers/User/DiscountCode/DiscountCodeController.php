<?php

namespace App\Http\Controllers\User\DiscountCode;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Trait\DataTrait;
use App\Models\DiscountCode;
use Validator;

class DiscountCodeController extends Controller
{
    use DataTrait;

    //الحصول على معلومات كود الحسم من اسمه

    public function getDiscountCodeByName(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'discountCodeName' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $discountCodeName = $request->input('discountCodeName');
        $discountCode = DiscountCode::where('code_name', $discountCodeName)->get();
        return $this->Data($discountCode, 'DiscountCode Retrieved Successfully', 200);
    }

    //جلب اكواد الحسم بناء على ال id الخاصة بهم

    public function getDiscountCodeByIDs(Request $request)
    {
        $discountCodeIDs = $request->query('discountCodeIDs');

        if (!$discountCodeIDs) {
            return response()->json('discountCodeIDs parameter is missing or empty', 422);
        }

        if (!is_array($discountCodeIDs)) {
            // If the parameter is not an array, try to decode it as JSON
            $discountCodeIDs = json_decode($discountCodeIDs, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                return response()->json('discountCodeIDs parameter is not a valid array', 422);
            }
        }

        $discountCode = DiscountCode::whereIn('id', $discountCodeIDs)->get();

        if ($discountCode->isEmpty()) {
            return response()->json('Discount codes not found', 404);
        }

        return $this->Data($discountCode, 'DiscountCode Retrieved Successfully', 200);
    }
}
