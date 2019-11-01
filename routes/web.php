<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('index',[
	'as'=>'trang-chu',
	'uses'=>'PageController@getIndex'
]);

Route::get('loai-san-pham/{type}',[
	'as'=>'loaisanpham',
	'uses'=>'PageController@getLoaiSp'
]);

Route::get('chi-tiet-san-pham/{id}',[
	'as'=>'chitietsanpham',
	'uses'=>'PageController@getChitiet'
]);

Route::get('lien-he',[
	'as'=>'lienhe',
	'uses'=>'PageController@getLienHe'
]);

Route::get('gioi-thieu',[
	'as'=>'gioithieu',
	'uses'=>'PageController@getGioiThieu'
]);

Route::get('add-to-cart/{id}',[
	'as'=>'themgiohang',
	'uses'=>'PageController@getAddtoCart'
]);

Route::get('del-cart/{id}',[
	'as'=>'xoagiohang',
	'uses'=>'PageController@getDelItemCart'
]);
Route::get('dat-hang',[
	'as'=>'dathang',
	'uses'=>'PageController@getCheckout'
]);

Route::post('dat-hang',[
	'as'=>'dathang',
	'uses'=>'PageController@postCheckout'
]);

Route::get('dang-nhap',[
	'as'=>'login',
	'uses'=>'PageController@getLogin'
]);
Route::post('dang-nhap',[
	'as'=>'login',
	'uses'=>'PageController@postLogin'
]);

Route::get('dang-ki',[
	'as'=>'signin',
	'uses'=>'PageController@getSignin'
]);

Route::post('dang-ki',[
	'as'=>'signin',
	'uses'=>'PageController@postSignin'
]);

Route::get('dang-xuat',[
	'as'=>'logout',
	'uses'=>'PageController@postLogout'
]);


// ----- search -----------//
Route::get('search',[
	'as'=>'searchProduct',
	'uses'=>'searchProduct@getSearch'
]);
Route::post('search/name',[
	'as'=>'search',
	'uses'=>'searchProduct@getSearchAjax'
]);
// ----- end search -----------//



// ----- admin -----------//

// view admin
Route::get('admin','PageController@getViewAdmin');
//







// delete
Route::get('deleteProduct/{id}', [
	'as' 	=> 'Product.getDeleteProduct',
	'uses' 	=> 'PageController@getDeleteProduct'
]);
Route::get('deleteSlide/{id}', [
	'as' 	=> 'Product.getDeleteSlide',
	'uses' 	=> 'PageController@getDeleteSlide'
]);
Route::get('deleteBill/{id}', [
	'as' 	=> 'Product.getDeleteBill',
	'uses' 	=> 'PageController@getDeleteBill'
]);
Route::get('deleteBillDetail/{id}', [
	'as' 	=> 'Product.getDeleteBillDetail',
	'uses' 	=> 'PageController@getDeleteBillDetail'
]);
Route::get('deleteUser/{id}', [
	'as' 	=> 'Product.getDeleteUser',
	'uses' 	=> 'PageController@getDeleteUser'
]);
Route::get('deleteNew/{id}', [
	'as' 	=> 'Product.getDeleteNew',
	'uses' 	=> 'PageController@getDeleteNew'
]);
//--end--//


