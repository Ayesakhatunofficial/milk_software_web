<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//for login route
$routes->get('/', 'Login::login');
$routes->post('/loginmatch', 'Login::LoginMatch');

// for logout route
$routes->get('/logout','Home::Logout');

//dashboard main page route
$routes->get('/index', 'Home::index');

//dairy part route
$routes->get('/dairy/create','Dairy::create');
$routes->post('/dairy/add', 'Dairy::addData');
$routes->get('/dairy/view', 'Dairy::viewData');
$routes->get('/dairy/edit/(:num)','Dairy::editData/$1');
$routes->post('/dairy/update/(:num)','Dairy::updateData/$1');
$routes->get('/dairy/delete/(:num)','Dairy::deleteData/$1');

//employee part route
$routes->get('/employee/create','Employee::create');
$routes->post('/employee/add', 'Employee::addData');
$routes->get('/employee/view', 'Employee::viewData');
$routes->get('/employee/edit/(:num)','Employee::editData/$1');
$routes->post('/employee/update/(:num)','Employee::updateData/$1');
$routes->get('/employee/delete/(:num)','Employee::deleteData/$1');

//fermers page route
$routes->get('/fermer/create', 'Fermer::create');
$routes->post('/fermer/add', 'Fermer::addData');
$routes->get('/fermer/view', 'Fermer::viewData');
$routes->get('/fermer/edit/(:num)','Fermer::editData/$1');
$routes->post('/fermer/update/(:num)','Fermer::updateData/$1');
$routes->get('/fermer/bank/(:num)','Fermer::viewBank/$1');



//collection boy page route
$routes->get('/collection/create', 'Collection::create');
$routes->post('/collection/add', 'Collection::addData');
$routes->get('/collection/view', 'Collection::viewData');
$routes->get('/collection/edit/(:num)','Collection::editData/$1');
$routes->post('/collection/update/(:num)','Collection::updateData/$1');
$routes->get('/collection/delete/(:num)','Collection::deleteData/$1');

//bank page route
$routes->get('/bank/create', 'Bank::create');
$routes->post('/bank/add', 'Bank::addData');
$routes->get('/bank/view', 'Bank::viewData');
$routes->get('/bank/edit/(:num)','Bank::editData/$1');
$routes->post('/bank/update/(:num)','Bank::updateData/$1');
$routes->get('/bank/delete/(:num)','Bank::deleteData/$1');

//Shift page route
$routes->get('/shift/create', 'Shift::create');
$routes->post('/shift/add', 'Shift::addData');
$routes->get('/shift/view', 'Shift::viewData');
$routes->get('/shift/edit/(:num)','Shift::editData/$1');
$routes->post('/shift/update/(:num)','Shift::updateData/$1');
$routes->get('/shift/delete/(:num)','Shift::deleteData/$1');

//sale rate page route
$routes->get('/salerate/create', 'Salerate::create');
$routes->post('/salerate/add', 'Salerate::addData');
$routes->get('/salerate/view', 'Salerate::viewData');
$routes->get('/salerate/edit/(:num)','Salerate::editData/$1');
$routes->post('/salerate/update/(:num)','Salerate::updateData/$1');
$routes->get('/salerate/delete/(:num)','Salerate::deleteData/$1');

//customer part route
$routes->get('/customer/create','Customer::create');
$routes->post('/customer/add', 'Customer::addData');
$routes->get('/customer/view', 'Customer::viewData');
$routes->get('/customer/edit/(:num)','Customer::editData/$1');
$routes->post('/customer/update/(:num)','Customer::updateData/$1');
$routes->get('/customer/delete/(:num)','Customer::deleteData/$1');

//sales screen part route
$routes->get('/screen/create','Salesscreen::Create');
$routes->post('/search/customer', 'Salesscreen::getCustomerResult');
$routes->post('/screen/getprice', 'Salesscreen::getPrice');

$routes->post('/screen/getperproductprice', 'Salesscreen::getPerProductPrice');

$routes->post('/screen/getproductprice', 'Salesscreen::getProductPrice');

$routes->post('/screen/getdue', 'Salesscreen::getDueAmount');
$routes->post('/screen/add','Salesscreen::addData');

$routes->post('/screen/addcustomer','Salesscreen::addCustData');
$routes->post('/screen/addfarmer','Salesscreen::addFarmerData');


$routes->get('/screen/view','Salesscreen::viewData');
$routes->get('/screen/edit/(:num)','Salesscreen::editData/$1');
$routes->post('/screen/update/(:num)','Salesscreen::updateData/$1');
$routes->get('/screen/delete/(:num)','Salesscreen::deleteData/$1');

$routes->get('/screen/invoice/(:num)','Salesscreen::Invoice/$1');
$routes->get('/screen/invoiceprint/(:num)','Salesscreen::InvoicePrint/$1');


//Milk Collection part route
$routes->get('/milk/create','MilkCollection::create');
$routes->post('/search/farmer', 'MilkCollection::getFarmerResult');
$routes->post('/milk/getprice', 'MilkCollection::getPrice');
$routes->post('/milk/add', 'MilkCollection::addData');
$routes->get('/milk/view', 'MilkCollection::viewData');
$routes->get('/milk/edit/(:num)','MilkCollection::editData/$1');
$routes->post('/milk/update/(:num)','MilkCollection::updateData/$1');
$routes->get('/milk/delete/(:num)','MilkCollection::deleteData/$1');

//expense category part route
$routes->get('/category/create','Category::create');
$routes->post('/category/add', 'Category::addData');
$routes->get('/category/view', 'Category::viewData');
$routes->get('/category/edit/(:num)','Category::editData/$1');
$routes->post('/category/update/(:num)','Category::updateData/$1');
$routes->get('/category/delete/(:num)','Category::deleteData/$1');

//expense part route
$routes->get('/expense/create','Expense::create');
$routes->post('/expense/add', 'Expense::addData');
$routes->get('/expense/view', 'Expense::viewData');
$routes->get('/expense/edit/(:num)','Expense::editData/$1');
$routes->post('/expense/update/(:num)','Expense::updateData/$1');
$routes->get('/expense/delete/(:num)','Expense::deleteData/$1');

//Advance part route
$routes->get('/advance/create','Advance::create');
$routes->post('/advance/search/farmer', 'Advance::getFarmerResult');
//$routes->post('/milk/getprice', 'MilkCollection::getPrice');
$routes->post('/advance/add', 'Advance::addData');
$routes->get('/advance/view', 'Advance::viewData');
$routes->get('/advance/edit/(:num)','Advance::editData/$1');
$routes->post('/advance/update/(:num)','Advance::updateData/$1');
$routes->get('/advance/delete/(:num)','Advance::deleteData/$1');
$routes->get('/advance/collect/(:any)','Advance::CollectData/$1');
$routes->post('/advance/addcollect/','Advance::addCollectData');
$routes->get('/advance/viewcollect/(:any)','Advance::viewCollectData/$1');


//Report part route
$routes->get('/report/create','Report::ViewReport');
$routes->post('/search/salereport','Report::getSalesReport');

$routes->get('/milkreport/create','Report::ViewCollectionReport');
$routes->post('/search/milkcollectionreport','Report::getCollectionReport');

$routes->get('/productreport/create','Report::ViewProductReport');
$routes->post('/search/productreport','Report::getProductReport');


//csv// rate chart route
$routes->get('/rate_chart/create','RateChart::Create');
$routes->post('/rate_chart/add','RateChart::Import');
$routes->get('/rate_chart/viewconfig','RateChart::ViewConfigData');
$routes->get('/rate_chart/view/(:num)','RateChart::ViewData/$1');
$routes->get('/rate_chart/edit/(:num)','RateChart::editData/$1');
$routes->post('/rate_chart/update/(:num)','RateChart::updateData/$1');
$routes->get('/rate_chart/delete/(:num)','RateChart::deleteData/$1');

//payment route
// customer
$routes->get('/payment/customer/view', 'Payment::viewCustData');
$routes->get('/payment/customer/collect/(:num)', 'Payment::CustCollect/$1');
$routes->post('/payment/customer/calculateSum/','Payment::calculateSum');
$routes->post('/payment/customer/addcustpay','Payment::addCustPayData');
$routes->get('/payment/customer/viewCustCollect/(:num)', 'Payment::viewCustPayData/$1');

//farmer
$routes->get('/payment/farmer/view', 'Payment::viewFarmerData');
$routes->get('/payment/farmer/pay/(:num)', 'Payment::FarmerPay/$1');
$routes->post('/payment/farmer/getpriccebydate/','Payment::getPriceByDate');
$routes->post('/payment/farmer/calculateTotal/','Payment::calculateTotal');
$routes->post('/payment/farmer/addfarmerpay','Payment::addFarmerPayData');
$routes->get('/payment/farmer/viewfarmerpay/(:num)', 'Payment::viewFarmerPayData/$1');
$routes->post('/payment/farmer/getPrice','Payment::getTotalPrice');

//setting
$routes->get('/setting/create','Setting::Create');
$routes->post('/setting/update','Setting::updateData');


//item
$routes->get('/item/create','Item::create');
$routes->post('/item/add', 'Item::addData');
$routes->get('/item/view', 'Item::viewData');
$routes->get('/item/edit/(:num)','Item::editData/$1');
$routes->post('/item/update/(:num)','Item::updateData/$1');
$routes->get('/item/delete/(:num)','Item::deleteData/$1');

//product
$routes->get('/product/create','Item::createProduct');
$routes->post('/product/getMilk', 'Item::getMilk');
$routes->post('/product/add', 'Item::addProductData');
$routes->get('/product/view/(:num)', 'Item::viewProductData/$1');
$routes->get('/product/totalview', 'Item::viewTotalProductData');
$routes->get('/product/edit/(:num)','Item::editProductData/$1');
$routes->post('/product/update/(:num)','Item::updateProductData/$1');
$routes->get('/product/delete/(:num)','Item::deleteProductData/$1');

