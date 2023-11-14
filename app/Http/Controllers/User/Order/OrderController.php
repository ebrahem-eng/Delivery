<?php

namespace App\Http\Controllers\User\Order;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Trait\DataTrait;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    use DataTrait;

    //مجموع طلبات المستخدم 
    
    public function get_count_order()
    {
        $countOrder = Order::where('user_id' , Auth::guard('userD')->user()->id)->count();
        return $this->Data($countOrder, 'Count Order Retrieved Successfully', 200);

    }
}
