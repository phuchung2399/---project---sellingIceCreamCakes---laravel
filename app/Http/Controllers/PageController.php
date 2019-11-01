<?php

namespace App\Http\Controllers;

use App\Slide;
use App\News;
use App\Product;
use App\ProductType;
use App\Cart;
use Session;
use App\Customer;
use App\Bill;
use App\BillDetail;
use App\User;
use Hash;
use Auth;
use DB;

use Illuminate\Http\Request;

class PageController extends Controller
{
    //--------------- Function ----------------//
    public function getIndex( Request $request )
    {
        $slide = Slide::all();
        //return view('page.trangchu',['slide'=>$slide]);
        if($request->ajax() || 'NULL'){
            $new_product = Product::where('new', 1)->paginate(4);
            $sanpham_khuyenmai = Product::where('promotion_price', '<>', 0)->paginate(8);
            return view('page.trangchu', compact('slide', 'new_product', 'sanpham_khuyenmai'));
        }
    }

    public function getLoaiSp($type)
    {
        $sp_theoloai = Product::where('id_type', $type)->get();
        $sp_khac = Product::where('id_type', '<>', $type)->paginate(3);
        $loai = ProductType::all();
        $loap_sp = ProductType::where('id', $type)->first();
        return view('page.loai_sanpham', compact('sp_theoloai', 'sp_khac', 'loai', 'loap_sp'));
    }

    public function getChitiet( Request $req)
    {
        $sanpham_khuyenmai = Product::where('promotion_price', '<>', 0)->paginate(10);
        $sanpham = DB::table('products')->join('type_products','type_products.id','=','products.id_type')->select('products.*','type_products.description')->where('products.id','=',$req->id)->first();
        $sp_tuongtu = Product::where('id_type', $sanpham->id_type)->paginate(6);
        return view('page.chitiet_sanpham', compact('sanpham_khuyenmai','sanpham', 'sp_tuongtu'));
    }


    public function getLienHe()
    {
        return view('page.lienhe');
    }

    public function getGioiThieu()
    {
        return view('page.gioithieu');
    }

    public function getAddtoCart(Request $req, $id)
    {
        $product = Product::find($id);
        $oldCart = Session('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        $req->session()->put('cart', $cart);
        return redirect()->back();
    }

    public function getDelItemCart($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        return redirect()->back();
    }

    public function getCheckout()
    {
        return view('page.dat_hang');
    }

    public function postCheckout(Request $req)
    {
        $cart = Session::get('cart');

        $customer = new Customer;
        $customer->name = $req->name;
        $customer->gender = $req->gender;
        $customer->email = $req->email;
        $customer->address = $req->address;
        $customer->phone_number = $req->phone;
        $customer->note = $req->notes;
        $customer->save();

        $bill = new Bill;
        $bill->id_customer = $customer->id;
        $bill->date_order = date('Y-m-d');
        $bill->total = $cart->totalPrice;
        $bill->payment = $req->payment_method;
        $bill->note = $req->notes;
        $bill->save();

        foreach ($cart->items as $key => $value) {
            $bill_detail = new BillDetail;
            $bill_detail->id_bill = $bill->id;
            $bill_detail->id_product = $key;
            $bill_detail->quantity = $value['qty'];
            $bill_detail->unit_price = ($value['price'] / $value['qty']);
            $bill_detail->save();
        }
        Session::forget('cart');
        return redirect()->back()->with('thongbao', 'Đặt hàng thành công');
    }

    public function getLogin()
    {
        return view('page.dangnhap');
    }

    public function getSignin()
    {
        return view('page.dangki');
    }

    public function postSignin(Request $req)
    {
        $this->validate(
            $req,
            [
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|max:20',
                'fullname' => 'required',
                're_password' => 'required|same:password'
            ],
            [
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Không đúng định dạng email',
                'email.unique' => 'Email đã có người sử dụng',
                'password.required' => 'Vui lòng nhập mật khẩu',
                're_password.same' => 'Mật khẩu không giống nhau',
                'password.min' => 'Mật khẩu ít nhất 6 kí tự'
            ]
        );
        $user = new User();
        $user->full_name = $req->fullname;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->phone = $req->phone;
        $user->address = $req->address;
        $user->save();
        return redirect()->back()->with('thanhcong', 'Tạo tài khoản thành công');
    }

    public function postLogin(Request $req)
    {
        $this->validate(
            $req,
            [
                'email' => 'required|email',
                'password' => 'required|min:6|max:20'
            ],
            [
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Email không đúng định dạng',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'password.min' => 'Mật khẩu ít nhất 6 kí tự',
                'password.max' => 'Mật khẩu không quá 20 kí tự'
            ]
        );
        $credentials = array('email' => $req->email, 'password' => $req->password);
        $user = User::where([
            ['email', '=', $req->email]
        ])->first();

        if ($user) {
            if (Auth::attempt($credentials)) {
                return redirect()->route('trang-chu');
            } else {
                return redirect()->back()->with(['flag' => 'danger', 'message' => 'Đăng nhập không thành công']);
            }
        } else {
            return redirect()->back()->with(['flag' => 'danger', 'message' => 'Tài khoản chưa kích hoạt']);
        }
    }
    public function postLogout()
    {
        Auth::logout();
        return redirect()->route('trang-chu');
    }
    //--------------- FunctionEnd ----------------//
    // Search
    


    //--------------- Admin ----------------//
    public function getViewAdmin()
    {
        //Hiển thị dữ liệu trong admin.view
        $products = Product::select('id', 'name','id_type','description','unit_price','promotion_price','image','unit','new')->get()->toArray();
       // $productsBanhMan = Product::select('id', 'name','id_type','description','unit_price','promotion_price','image','unit','new')->where('id_type', 1)->get()->toArray();
       // $productsBanhNgot = Product::select('id', 'name','id_type','description','unit_price','promotion_price','image','unit','new')->where('id_type', 2)->get()->toArray();
       // $productsBanhTraiCay = Product::select('id', 'name','id_type','description','unit_price','promotion_price','image','unit','new')->where('id_type', 3)->get()->toArray();
       // $productsBanhKem = Product::select('id', 'name','id_type','description','unit_price','promotion_price','image','unit','new')->where('id_type', 4)->get()->toArray();
       // $productsBanhCrepe = Product::select('id', 'name','id_type','description','unit_price','promotion_price','image','unit','new')->where('id_type', 5)->get()->toArray();
       //  $productsBanhPizza = Product::select('id', 'name','id_type','description','unit_price','promotion_price','image','unit','new')->where('id_type', 6)->get()->toArray();
       // $productsBanhSuKem = Product::select('id', 'name','id_type','description','unit_price','promotion_price','image','unit','new')->where('id_type', 7)->get()->toArray();
        //Hiển thị slide
        $slide = Slide::select('id','image')->get()->toArray();
        //Hiển thị user
        $user = User::select('id','full_name','email','phone','address')->get()->toArray();
        // Hóa đơn
        $bill = Bill::select('id','id_customer','date_order','total','payment','note')->get()->toArray();
        // Hóa đơn chi tiết
        $BillDetail = BillDetail::select('id','id_bill','id_product','quantity','unit_price')->get()->toArray();
        // new
        $News = News::select('id','title','content','image')->get()->toArray();

        //return view('admin.viewAdmin',compact('productsBanhMan','productsBanhNgot','productsBanhTraiCay','productsBanhKem','productsBanhCrepe','productsBanhPizza','productsBanhSuKem','user','slide','bill','BillDetail','News'));
        return view('admin.viewAdmin',compact('products','user','slide','bill','BillDetail','News'));
    }
    //Sử lý thêm sửa xóa admin.view





// delete
public function getDeleteProduct($id)
{
    $products = Product::find($id);
    $products->delete($id);
    return back()->with('success', 'Xóa sản phẩm thành công!');
}
public function getDeleteSlide($id)
{
    $slide = Slide::find($id);
    $slide->delete($id);
    return back()->with('success', 'Xóa sản phẩm thành công!');
}
public function getDeleteBill($id)
{
    $bill = Bill::find($id);
    $bill->delete($id);
    return back()->with('success', 'Xóa sản phẩm thành công!');
}
public function getDeleteBillDetail($id)
{
    $BillDetail = BillDetail::find($id);
    $BillDetail->delete($id);
    return back()->with('success', 'Xóa sản phẩm thành công!');
}
public function getDeleteUser($id)
{
    $user = User::find($id);
    $user->delete($id);
    return back()->with('success', 'Xóa sản phẩm thành công!');
}
public function getDeleteNew($id)
{
    $new = News::find($id);
    $new->delete($id);
    return back()->with('success', 'Xóa sản phẩm thành công!');
}
    //--------------- AdminEnd ----------------//
}
