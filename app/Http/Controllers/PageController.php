<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\User;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe;

class PageController extends Controller
{
    public function index()
    {
        $topSellerProducts = DB::table('order_details')
            ->leftJoin('products','products.id','=','order_details.product_id')
            ->select('products.id','products.name','order_details.product_id',
                DB::raw('SUM(order_details.quantity) as total'))
            ->groupBy('products.id','order_details.product_id','products.name')
            ->orderBy('total','desc')
            ->limit(3)
            ->get();

        $latestProducts = Product::orderBy('created_at', 'desc')->take(10)->get();
        $featureProducts = Product::where('is_feature', 1)->orderBy('created_at', 'desc')->take(3)->get();
        $hotProducts = Product::where('is_hot', 1)->orderBy('created_at', 'desc')->take(3)->get();
        return view('frontend.index', compact('latestProducts', 'featureProducts', 'hotProducts', 'topSellerProducts'));
    }

    public function getProfile()
    {
        return view('frontend.profile');
    }

    public function shop($id = null)
    {
        if ($id) {
            $products = Product::where('category_id', $id)->orderBy('created_at', 'desc')->paginate(9);
        } else {
            $products = Product::orderBy('created_at', 'desc')->paginate(9);
        }

        return view('frontend.shop', compact('products'));
    }

    public function search(Request $request)
    {
        if ($request->search) {
            $products = Product::where('name', 'like', '%'.$request->search.'%')->orderBy('created_at', 'desc')->paginate(9);
        } else {
            $products = Product::orderBy('created_at', 'desc')->paginate(9);
        }

        return view('frontend.shop', compact('products'));
    }


    public function singleProduct($id)
    {
        $product = Product::find($id);
        $relateProducts = Product::where('category_id', $product->category_id)->where('id', '!=', $id)->get();
        return view('frontend.single_product', compact('product', 'relateProducts'));
    }

    public function cart()
    {
        $userId = Auth::check() ? Auth::id() : session()->getid();
        $cartItems = \Cart::session($userId)->getContent();
        $subTotal = \Cart::session($userId)->getSubTotal();
        return view('frontend.cart', compact('cartItems', 'subTotal'));
    }

    public function checkout()
    {
        $userId = Auth::check() ? Auth::id() : session()->getid();
        $cartItems = \Cart::session($userId)->getContent();
        $subTotal = \Cart::session($userId)->getSubTotal();
        $paymentMethods = PaymentMethod::where('status', 1)->get();
        return view('frontend.checkout', compact('cartItems', 'subTotal', 'paymentMethods'));
    }

    public function applyCoupon(Request $request)
    {
        session()->forget('coupon');
        $coupon = Coupon::where([['code', $request->coupon_code],['status', 1]])->first();
        $currentDate = date('Y-m-d');
        if ($coupon && ($currentDate >= $coupon->start_date) && ($currentDate <= $coupon->end_date)) {
            session()->put('coupon', $coupon);
            return redirect()->back()->with('notify_success', 'Applied Code');
        } else {
            return redirect()->back()->with('notify_failed', 'Invalid / Outdated Code');
        }
    }

    public function stripe()
    {
        return view('frontend.stripe');
    }

    public function order(Request $request)
    {
        if ($request->phone) {
            session()->put('notes', $request->notes);
            session()->put('phone', $request->phone);
            session()->put('name', $request->name);
            session()->put('email', $request->email);
            session()->put('address', $request->address);
            session()->put('payment_method', $request->payment_method);
        }

        if($request->payment_method == 2 && $request->stripeToken == null)
        {
            return redirect()->route('stripe_form');
        }

        $userId = Auth::check() ? Auth::id() : session()->getid();
        $order = new Order();
        $order->user_id = Auth::check() ? Auth::id() : 0;
        $order->coupon_id = session()->has('coupon') ? session()->get('coupon')->id : 0;
        $order->total = session()->has('coupon') ? \Cart::session($userId)->getTotal() * (100 - session()->get('coupon')->discount) / 100 : \Cart::session($userId)->getTotal();
        $order->status = 0;
        $order->notes = $request->notes ? $request->notes : session()->get('notes');
        $order->phone = $request->phone ? $request->phone : session()->get('phone');
        $order->name = $request->name ? $request->name : session()->get('name');
        $order->email = $request->email ? $request->email : session()->get('email');
        $order->address = $request->address ? $request->address : session()->get('address');
        $order->payment_method_id = $request->payment_method ? $request->payment_method : session()->get('payment_method');
        $order->payment_status = 0;

        $order->save();

        foreach (\Cart::session($userId)->getContent() as $item) {
            $orderDetail = new OrderDetail();
            $orderDetail->product_id = $item->id;
            $orderDetail->order_id = $order->id;
            $orderDetail->quantity = $item->quantity;
            $orderDetail->price = $item->price;
            $orderDetail->name = $item->name;
            $orderDetail->save();

            $product = Product::find($item->id);
            $product->inventory_quantity -= $item->quantity;
            $product->save();
        }

        if ($request->payment_method == 2) {
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            Stripe\Charge::create ([
                "amount" => (session()->has('coupon') ? \Cart::session($userId)->getTotal() * (100 - session()->get('coupon')->discount) / 100 : \Cart::session($userId)->getTotal()) * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Purchase for instrumental music !"
            ]);
            $order->payment_status = 1;
            $order->save();
        }

        \Cart::session($userId)->clear();
        session()->forget('notes');
        session()->forget('phone');
        session()->forget('name');
        session()->forget('email');
        session()->forget('address');
        session()->forget('payment_method');
        session()->forget('coupon');

        session()->flash('success', 'Payment successful!');

        return redirect()->route('checkout')->with('success', 'Place Order Successfully !');
    }

    public function orderHistory()
    {
        $orders = Order::with('order_details')->where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('frontend.order_history', compact('orders'));
    }

    public function reOrder(Request $request)
    {
        $userId = Auth::check() ? Auth::id() : session()->getid();

        foreach(json_decode($request->reorder_products) as $reorderProduct) {
            $product = Product::find($reorderProduct->product_id);
            \Cart::session($userId)->add(array(
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->sale_price ? $product->sale_price : $product->price,
                'quantity' => $reorderProduct->quantity,
                'attributes' => array(),
                'associatedModel' => $product->image
            ));
        }

        return redirect()->route('cart');
    }

    public function login()
    {
        if(Auth::check())
        {
            return redirect('index');
        }

        return view('backend.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request,
            [
                'email' =>  'email|required',
                'password'       =>  'required|min:6|max:32',
            ]);

        if (Auth::attempt(['email'=>$request->email, 'password'=>($request->password)], $request->remember_me))
        {
            if (Auth::user()->user_type == 2) //customer
            {
                return redirect('index');
            }

            if (Auth::user()->user_type == 1 || Auth::user()->user_type == 3)
            {
                return redirect('/admin');
            }
        }
        else
        {
            return redirect()->back()->with('notify','Invalid Email or Password !!');
        }
    }

    public function register()
    {
        return view('backend.register');
    }

    public function postRegister(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'password' => 'required',
            'password_confirm' => 'required|same:password',

        ]);

        $user = User::create($request->all());
        $user->user_type = 2;
        $user->save();

        Auth::guard('web')->loginUsingId($user->id);
        return redirect('index');
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect('login');
    }

    public function productReview(Request $request, $id)
    {
        $product = Product::find($id);
        $product->comment()->create([
            'user_id' => Auth::id(),
            'body' => $request->review
        ]);
        $product->save();

        return redirect()->back();
    }

    public function wishList()
    {
        $user = Auth::user();

        $favorites = $user->wish_lists()->with('product')->orderBy('created_at', 'desc')->get();
        return view('frontend.wish_list', compact('favorites'));
    }

    public function addWishList($id)
    {
        $checkWishList = WishList::where([['product_id', $id], ['user_id', Auth::id()]])->first();
        if (!$checkWishList) {
            $favourite = new WishList();
            $favourite->user_id = Auth::id();
            $favourite->product_id = $id;
            $favourite->save();
        }

        return redirect()->back()->with('success', 'Added to Wish List !');
    }

    public function removeWishList($id)
    {
        $favourite = WishList::find($id);
        $favourite->delete();

        return redirect()->back()->with('success', 'Removed from Wish List !');
    }
}
