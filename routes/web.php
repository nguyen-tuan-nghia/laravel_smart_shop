<?php

use Illuminate\Support\Facades\Route;

//home
Route::get('/', 'HomeController@index');
Route::get('/trang-chu',  'HomeController@index');
Route::get('/danh-muc-san-pham/{slug_category}','category_productController@show_category_home');
Route::get('/thuong-hieu-san-pham/{brand_name}','brandProductController@show_brand_home');
Route::get('/chi-tiet-san-pham/{product_slug}','ProductController@product_detail');
Route::post('/save-cart',  'CartController@save_cart');
Route::get('/show-cart',  'CartController@show_cart');
Route::post('/delete-by-cart',  'CartController@delete_by_cart');
Route::get('/login-checkout',  'CheckoutController@login_checkout');
Route::post('/save-customer',  'CheckoutController@save_customer');
Route::get('/checkout',  'CheckoutController@checkout');
Route::post('/login',  'CheckoutController@login');
Route::get('/logout-checkout',  'CheckoutController@logout_checkout');
Route::get('/payment', 'CheckoutController@payment');
Route::post('/search', 'HomeController@search');
Route::post('/order-place',  'CheckoutController@order_place');
Route::post('/checkout-coupon',  'CartController@checkout_coupon');
Route::post('/delete-coupon',  'CartController@delete_coupon');
Route::post('/select-delivery-home',  'deliveryController@select_delivery_home');
Route::post('/edit-customer-checkout',  'CheckoutController@edit_customer_checkout');
Route::post('/fetch-customer-checkout',  'CheckoutController@fetch_customer_checkout');
Route::post('/insert-fee',  'CheckoutController@insert_fee');
Route::get('/thanh-toan-thanh-cong',  'CheckoutController@handcash');
Route::get('/avata',  'HomeController@avata');
Route::get('/tin-tuc',  'postController@view_home_post');
Route::get('/tin-tuc/{category_post_slug}',  'postController@view_category_post');
Route::get('/tin-tuc/{category_post_slug}/{post_slug}',  'postController@view_post_detail');
Route::post('/load-comment',  'commentController@load_comment');
Route::post('send-comment',  'commentController@send_comment');
Route::get('/history','HomeController@history');
Route::get('/view-history-order/{order_id}',  'HomeController@history_order');
Route::get('/huy-order/{order_id}',  'HomeController@huy_order');
Route::get('/dem-so',  'HomeController@dem_so');
Route::post('doi-mat-khau-kh',  'HomeController@doi_mat_khau_kh');
Route::post('/update-avata',  'HomeController@update_avata');
Route::post('/delete-img',  'HomeController@delete_img');
Route::post('/autocomplete-ajax',  'HomeController@search_ajax');
Route::post('/attr-product-ajax',  'ProductController@attr_product_ajax');
Route::post('/attr-view-ajax',  'ProductController@attr_view_ajax');

Route::get('/them-gio',  'HomeController@them_gio');
Route::post('/cart-total-price',  'CartController@cart_total_price');
Route::get('/bang-thanh-toan',  'CartController@bang_thanh_toan');
Route::get('/bang-thanh-toan-check',  'CartController@bang_thanh_toan_check');

//fetch
Route::post('/category-fetch-home-brand',  'category_productController@category_fetch_home_brand');
Route::post('/category-fetch-home-price',  'category_productController@category_fetch_home_price');
Route::post('/category-fetch-home-all',  'category_productController@category_fetch_home_all');

//feedback
Route::post('/save-feedback',  'commentController@save_feedback');
Route::get('/feedback-model/{product_id}',  'commentController@feedback_model');
Route::get('/fetch-feedback-edit-modal/{feedback_id}',  'commentController@feedback_edit_model');
Route::get('/fetch-feedbackimg-edit-modal/{feedback_id}',  'commentController@feedbackimg_edit_model');
Route::get('/delete-feedback-img/{feedback_img_id}',  'commentController@delete_feedback_img');
Route::get('/delete-feedback-img/{feedback_img_id}',  'commentController@delete_feedback_img');
Route::get('/fetch-feedback-edit',  'commentController@fetch_feedback_edit');
Route::post('/edit-feedback',  'commentController@feedback_edit');

Route::post('/image-commnet',  'commentController@image_commnet');

// Route::get('/send-mail',  'mailController@send_mail');
Route::get('/re-password',  'mailController@re_password');
Route::post('/re-password',  'mailController@send_password');
Route::get('/reset-password',  'mailController@view_reset_password');
Route::post('/reset-password',  'mailController@update_password');

Route::get('/register',  'mailController@register');
Route::post('/register-mail',  'mailController@register_mail');
Route::post('/otp-mail',  'mailController@otp_mail');

//rating start
Route::post('/save-coment-rating-star',  'ProductController@save_coment_rating_star');

//Login facebook
Route::get('/login-facebook','socialController@login_facebook');
Route::get('/callback','socialController@callback_facebook');

//Login  google
Route::get('/login-google','socialController@login_google');
Route::get('/google/callback','socialController@callback_google');

Route::get('/vnpay','socialController@vnpay');
Route::get('/return-vnpay','socialController@return_vnpay');
Route::post('/create-vnpay', 'socialController@create_vnpay');

Route::post('/create-momo', 'socialController@create_momo');
Route::post('/notifyurl-momo', 'socialController@notifyurl_momo');

Route::get('/send-coupon',  'mailController@send_coupon');

Route::group(['middleware'=>'reply.roles'], function(){
Route::post('/chart-product',  'ProductController@chart_product');
Route::get('/all-product',  'ProductController@all_product');

Route::get('/comment','commentController@list_comment');
Route::post('/allow-comment','commentController@allow_comment');
Route::post('/reply-comment','commentController@reply_comment');
Route::post('/insert-rating','commentController@insert_rating');

Route::get('/list-feedback','commentController@list_feedback');
Route::get('/delete-feedback/{feedback_id}','commentController@delete_feedback');
Route::post('/update-feedback','commentController@update_feedback');
});

//admin
Route::get('/admin',  'AdminController@index');
Route::get('/dashboard',  'AdminController@show_dashboard');
Route::post('/admin-dashboard',  'AdminController@dashboard');
Route::get('/logout',  'AdminController@logout');
Route::post('/filter-by-date',  'AdminController@filter_by_date');
Route::post('/dashboard-filter',  'AdminController@dashboard_filter');
Route::post('/days-order',  'AdminController@days_order');
Route::post('/sum',  'AdminController@sum');
Route::post('/sum-dashboard-filter',  'AdminController@sum_dashboard_filter');
Route::post('/sum-filter-by-date',  'AdminController@sum_filter_by_date');


Route::get('/change-pass',  'UserController@pass');
Route::post('/edit-pass',  'UserController@edit_pass');


Route::group(['middleware'=>'admin.roles'], function(){
Route::post('/export-csv','ProductController@export_csv');
Route::get('/web-detail','webdetailController@index');
Route::post('/update-web-detail','webdetailController@update');

Route::get('/delete-comment/{comment_id}','commentController@delete_comment');

Route::get('/add-category-product',  'category_productController@add_category_product');
Route::get('/all-category-product',  'category_productController@all_category_product');
Route::post('/save-category-product',  'category_productController@save_category_product');
Route::get('/action-category-product/{category_id}',  'category_productController@action_category_product');
Route::get('/unaction-category-product/{category_id}',  'category_productController@unaction_category_product');
Route::get('/edit-category-product/{category_id}',  'category_productController@edit_category_product');
Route::post('/update-category-product/{category_id}',  'category_productController@update_category_product');
Route::get('/delete-category-product/{category_id}',  'category_productController@delete_category_product');

Route::get('/add-brand',  'brandProductController@add_brand');
Route::get('/all-brand',  'brandProductController@all_brand');
Route::post('/save-brand',  'brandProductController@save_brand');
Route::get('/action-brand/{brand_id}',  'brandProductController@action_brand');
Route::get('/unaction-brand/{brand_id}',  'brandProductController@unaction_brand');
Route::get('/edit-brand/{brand_id}',  'brandProductController@edit_brand');
Route::post('/update-brand/{brand_id}',  'brandProductController@update_brand');
Route::get('/delete-brand/{brand_id}',  'brandProductController@delete_brand');

Route::get('thuoc-tinh/{product_id}',  'ProductController@attr_product');
Route::post('/insert-attr-product/{product_id}',  'ProductController@insert_attribute');
Route::get('/delete-attribute/{attribute_id}',  'ProductController@delete_attribute');
Route::get('/attribute-edit/{attribute_id}',  'ProductController@get_edit_attribute');
Route::post('/update-attribute',  'ProductController@update_attribute');

Route::get('/add-product',  'ProductController@add_product');
Route::post('/save-product',  'ProductController@save_product');
Route::get('/action-product/{product_id}',  'ProductController@action_product');
Route::get('/unaction-product/{product_id}',  'ProductController@unaction_product');
Route::get('/edit-product/{product_id}',  'ProductController@edit_product');
Route::post('/update-product/{product_id}',  'ProductController@update_product');
Route::get('/delete-product/{product_id}',  'ProductController@delete_product');
Route::post('/ckeditor-upload',  'ProductController@ckeditor_upload');

Route::get('/all-coupon',  'couponController@all_coupon');
Route::get('/add-coupon',  'couponController@add_coupon');
Route::post('/save-coupon',  'couponController@save_coupon');
Route::get('/edit-coupon/{coupon_id}',  'couponController@edit_coupon');
Route::post('/update-coupon-{coupon_id}',  'couponController@update_coupon');
Route::get('/delete-coupon/{coupon_id}',  'couponController@delete_coupon');
Route::get('/send-coupon/{coupon_id}',  'mailController@send_coupon');

Route::get('/manage-order',  'orderController@all_order');
Route::get('/delete-order/{order_id}',  'orderController@delete_order');

Route::get('/manage-order-detail/{order_id}',  'orderController@order_detail');
Route::get('/delete-order-detail/{order_id}',  'orderController@delete_order_detail');
Route::get('/In-hoa-don/{order_id}',  'orderController@in_hoa_don');
Route::post('/update-quantity-order-detail',  'orderController@update_quantity_order_detail');
Route::post('/update-order-status',  'orderController@update_order_status');

Route::get('/delivery', 'deliveryController@add_delivery');
Route::post('/select-feeship', 'deliveryController@select_feeship');
Route::post('/insert-delivery', 'deliveryController@insert_delivery');
Route::post('/update-delivery', 'deliveryController@update_delivery');

Route::get('/add-slider',  'sliderController@add_slider');
Route::get('/all-slider',  'sliderController@all_slider');
Route::post('/save-slider',  'sliderController@save_slider');
Route::get('/action-slider/{slider_id}',  'sliderController@action_slider');
Route::get('/unaction-slider/{slider_id}',  'sliderController@unaction_slider');
Route::get('/edit-slider/{slider_id}',  'sliderController@edit_slider');
Route::post('/update-slider/{slider_id}',  'sliderController@update_slider');
Route::get('/delete-slider/{slider_id}',  'sliderController@delete_slider');

Route::get('/user',  'UserController@all_user');
Route::get('/user-regis',  'UserController@user_regis');
Route::post('/user-add',  'UserController@user_add');
Route::post('/assign-roles',  'UserController@assign_roles');
Route::get('/delete-user-roles/{admin_id}',  'UserController@delete_user_roles');
Route::get('/user-regis-admin',  'UserController@user_regis_admin');
Route::get('/customer-manager',  'UserController@customer_manager');
Route::get('/delete-customer/{customer_id}',  'UserController@delete_customer');



Route::get('add-gallery/{product_id}','galleryController@add_gallery');
Route::post('select-gallery','galleryController@select_gallery');
Route::post('insert-gallery/{pro_id}','galleryController@insert_gallery');
Route::post('update-gallery-name','galleryController@update_gallery_name');
Route::post('delete-gallery','galleryController@delete_gallery');
Route::post('update-gallery','galleryController@update_gallery');
});
Route::group(['middleware'=>'author.roles'], function(){
Route::post('/select-delivery', 'deliveryController@select_delivery');

Route::get('/add-category-post', 'category_postController@add_category_post');
Route::post('/save-category-post', 'category_postController@save_category_post');
Route::get('/all-category-post', 'category_postController@all_category_post');
Route::get('/action-category-post/{category_post_id}',  'category_postController@action_category_post');
Route::get('/unaction-category-post/{category_post_id}',  'category_postController@unaction_category_post');
Route::get('/edit-category-post/{category_post_id}',  'category_postController@edit_category_post');
Route::post('/update-category-post/{category_post_id}',  'category_postController@update_category_post');
Route::get('/delete-category-post/{category_post_id}',  'category_postController@delete_category_post');

Route::get('/add-post', 'postController@add_post');
Route::post('/save-post', 'postController@save_post');
Route::get('/all-post', 'postController@all_post');
Route::get('/action-post/{post_id}',  'postController@action_post');
Route::get('/unaction-post/{post_id}',  'postController@unaction_post');
Route::get('/edit-post/{post_id}',  'postController@edit_post');
Route::post('/update-post/{post_id}',  'postController@update_post');
Route::get('/delete-post/{post_id}',  'postController@delete_post');
});
