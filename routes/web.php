<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'AdminControllers\LoginController@loginPage');
Route::post('/postLogin', 'AdminControllers\LoginController@postLogin');
Route::get('/registerPage', 'AdminControllers\LoginController@registerPage');
Route::get('admin/ThongTinHocPhiPage', 'AdminControllers\LoginController@ThongTinHocPhiPage');
Route::get('admin/logOut', 'AdminControllers\LoginController@postLogOut');

Route::post('admin/getAll_Hoc_Phi_Hoc_Vien', 'AdminControllers\InitController@getAll_Hoc_Phi_Hoc_Vien');
Route::post('admin/getAll_Import_AGR', 'AdminControllers\InitController@getAll_Import_AGR');
Route::post('admin/getAll_No_Hoc_Phi', 'AdminControllers\InitController@getAll_No_Hoc_Phi');


Route::post('admin/importHocphiExcel', 'AdminControllers\ImportExcelController@importHocphi');
Route::get('admin/ThongKeHocPhi', 'AdminControllers\ThongKeController@ThongKeHocPhi');
Route::post('admin/getAllThongKe', 'AdminControllers\ThongKeController@getAll');


Route::get('admin/chiTietCaNhan', 'AdminControllers\CaNhanController@chiTietCaNhan');
Route::post('admin/getAllChiTietCaNhan', 'AdminControllers\CaNhanController@getAllThongTinCaNhan');
Route::post('admin/updateChitietCaNhan', 'AdminControllers\CaNhanController@updateChitietCaNhan');

