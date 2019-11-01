<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request ;
use DB;
use App\Product;

class searchProduct extends Controller
{
    public function getSearch(Request $search)
    {
        $productSearch = Product::where('name','LIKE','%'.$search->country_name.'%')->orWhere('unit_price',$search->country_name)->get();

        return view('page.search', compact('productSearch'));
    }


    function getSearchAjax(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data = DB::table('products')
            ->where('name', 'LIKE', "%{$query}%")
            ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach($data as $row)
            {
               $output .= '
               <li><a href="../public/chi-tiet-san-pham/'. $row->id .'">'.$row->name.'</a></li>
               ';
           }
           $output .= '</ul>';
           echo $output;
       }
    }
}
