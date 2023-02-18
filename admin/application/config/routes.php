<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = "login";
$route['dashboard'] = "dashboard";
$route['admin/profile'] = "dashboard/updateProfile";

// role access

$route['error-404'] = "dashboard/error_module";

// Users
$route['agents/create-agent'] = "agents/createAgent";
$route['agents/all-agents'] = "agents/index";
$route['agents/update-agent/(:any)'] = "agents/editAgent/$1";

//navbar main-menu
$route['menus/main-menu'] = "navbar/navbar_menu/allNavbars";
$route['menus/sub-menu/(:num)'] = "navbar/navbar_menu/allsubMenus/$1";


$route['menus/edit-main-menu/(:num)'] = "navbar/navbar_menu/updateNavbar/$1";
$route['menus/edit-sub-menu/(:num)'] = "navbar/navbar_menu/updateSubmenu/$1";



// Arrange Menus
$route['menus/arrange-menus'] = "navbar/Arrangemenu/index";



// General
$route['general'] = "General/general";
$route['general/update-social-site/(:any)'] = "General/updateSocial/$1";
$route['general/update-location/(:any)'] = "General/updateLocation/$1";
$route['general/update-area/(:any)'] = "General/updateArea/$1";
$route['general/update-trending-news/(:any)'] = "General/updateTrending/$1";
$route['general/update-business-solution/(:any)'] = "General/updateBsolutions/$1";
$route['general/update-slider/(:any)'] = "General/editSlider/$1";


//Start Pages Routes

//Homepage
//$route['pages'] = "pages/pages/index";
$route['pages/homepage/(:any)'] = "pages/pages/editPage/$1";

//News and community
$route['news-and-community'] = "pages/Newscommunity/editPage";
$route['news-and-community/(:any)'] = "pages/Newscommunity/editPage/$1";




// File Manager Routes
$route['file-manager'] = "file_manager/file_manager/index";
$route['file-manager/gallery-type/(:any)'] = "file_manager/file_manager/index/$1";


// products

$route['products'] = "products/products";
$route['products/create-product'] = "products/products/createProduct";
$route['products/edit-product/(:any)'] = "products/products/updateProduct/$1";
$route['products/edit-product/(:any)/(:any)'] = "products/products/updateProduct/$1/$1";
$route['products/free-sample-products'] = "products/products/freeSampleproducts";
$route['products/edit-sample-product/(:any)'] = "products/products/freeSampleproducts/$1";


// Category routes
$route['products/categories'] = "products/categories/categories";
$route['products/edit-category/(:any)'] = "products/categories/categories/editCategory/$1";



// grape js routes

$route['pages'] = "grape/allPages";
$route['pages/create-page'] = "grape/createPage";
$route['pages/edit-page/(:any)'] = "grape/editPage/$1";
$route['page/(:any)'] = "grape/viewPage/$1";
$route['page/(:any)/(:any)'] = "grape/viewPage/$1";
$route['page/(:any)/(:any)/(:any)'] = "grape/viewPage/$1";

// style manager
$route['style-manager'] = "superadmin/style_manager/Stylemanager/index";


// Conatact Emails

$route['contact-emails'] = "superadmin/contactEmails/Contactemails/index";
$route['contact-emails/(:any)'] = "superadmin/contactEmails/Contactemails/index/$1";


// Meta Data

$route['meta-data'] = "superadmin/metaData/Metadata/index";
$route['meta-data/(:any)'] = "superadmin/metaData/Metadata/index/$1";




// Dynamic Pages
$route['pages/dynamic-pages'] = "pages/dynamicpages/index";
$route['pages/dynamic-page/(:any)'] = "pages/$1";



$route['pages/dynamic-page/homepage/(:any)'] = "pages/Homepage/index/$1";



// Faqs
$route['faqs/edit-faq/(:any)'] = "faqs/index/$1";


// orders

$route['orders/delivery-once-orders'] = "orders/DeliveryOnce/index";
$route['orders/all-orders'] = "orders/Consumerorders/index";
$route['orders/consumer-orders'] = "orders/Consumerorders/conOrders";
$route['orders/consumer-orders/invoice/(:any)'] = "orders/Consumerorders/generateInvoice/$1";
$route['orders/invoice-orders'] = "orders/Invoiceorders/index";
$route['orders/invoice-orders/changeShift/(:any)/(:any)'] = "orders/Invoiceorders/changeShift/$1/$1";

$route['orders/free-sample-orders'] = "orders/Freesample/index";
$route['orders/subscribed-orders'] = "orders/Subscribed/index";
$route['orders/active-orders'] = "orders/Activeorders/index";
$route['orders/cancelled-orders'] = "orders/Activeorders/cancelledOrders";
$route['orders/deliverable-quantity'] = "orders/Activeorders/deliverableQuantity";
$route['orders/agent-deliverable-quantity'] = "orders/Activeorders/deliverableQuantity";
$route['orders/assigned-orders'] = "orders/Activeorders/assignedOrders";



// Agent orders

$route['agent-orders/delivery-once-orders'] = "orders/DeliveryOnce/agentOrders";
$route['agent-orders/free-sample-orders'] = "orders/Freesample/agentOrders";
$route['agent-orders/subscribed-orders'] = "orders/subscribed/agentOrders";
$route['agent-orders/active-orders'] = "orders/Activeorders/agentOrders";
$route['agent-orders/delivered-orders'] = "orders/Activeorders/agentDeliveredOrders";

$route['agent-orders/deliverableQuantity'] = "orders/Agentorders/deliverableQuantity";
$route['agent-orders/alldeliverableQuantity'] = "orders/Agentorders/allProductquantity";
$route['agent-orders/filterdeliverableQuantity'] = "orders/Agentorders/filterProductquantity";
$route['agent-orders/filterallDeliveredorders'] = "orders/Activeorders/filterallDeliveredorders";
$route['agent-orders/filterallactiveorders'] = "orders/Activeorders/filterallagentActiveorders";



$route['agent-orders/updateDeliverystatus'] = "orders/DeliveryOnce/updateDeliverystatus";
$route['agent-orders/updateFreesampledeliverystatus'] = "orders/Freesample/updateDeliverystatus";
$route['agent-orders/updateActivedeliverystatus'] = "orders/Activeorders/updateDeliverystatus";
$route['agent-orders/updateSubscribedeliverystatus'] = "orders/Subscribed/updateDeliverystatus";
$route['agent-orders/view-order/(:any)'] = "orders/DeliveryOnce/viewdoOrder/$1";
$route['agent-orders/view-free-sample-order/(:any)'] = "orders/Freesample/viewdoOrder/$1";
$route['agent-orders/view-subscribed-order/(:any)'] = "orders/subscribed/viewdoOrder/$1";


// admin assigned Agent orders
$route['orders/agent-order'] = "orders/Agentorders";
$route['orders/agent-order/insertOrder'] = "orders/Agentorders/insertOrder";

$route['orders/agent-orders'] = "orders/Agentorders/myorders";
$route['orders/agent-orders/filterOrders'] = "orders/Agentorders/filterOrders";

$route['orders/depositOrders'] = "orders/Agentorders/depositOrders";
$route['orders/depositOrders/transactiondocuments/(:any)'] = "agentOrders/Agentproducts/transactiondocuments/$1";
$route['orders/agent-orders/filterdepositOrders'] = "orders/Agentorders/filterdepositOrders";

$route['orders/agent-order/updateOrder/(:any)'] = "orders/Agentorders/updateOrder/$1";
$route['orders/agent-order/delOrder/(:any)'] = "/orders/Agentorders/delOrder/$1";
$route['orders/agent-orders/editOrder'] = "orders/Agentorders/editOrder";
$route['orders/agent-orders/cancelled-orders'] = "orders/Agentorders/deletedOrders";
$route['orders/agent-orders/update-history'] = "orders/Agentorders/updateHistory";
$route['orders/agent-orders/deliverableQuantity'] = "orders/Agentdeliverableqty/index";
$route['orders/agent-orders/allProductquantity'] = "orders/Agentdeliverableqty/allProductquantity";
$route['orders/agent-orders/indentordersexport'] = "orders/Indentordersexport/index";
$route['orders/agent-orders/indentordersexport/export'] = "orders/Indentordersexport/filterOrders";


// get filtered dq agents

$route['orders/agent-orders/getfilterams'] = "ajax/getfilterams";
$route['orders/agent-orders/getdqTi'] = "ajax/getfilterdqTincharge";
$route['orders/agent-orders/getdqBDA'] = "ajax/getfilterdqSemployees";
$route['orders/agent-orders/getdqAgents'] = "ajax/getfilterdqAgents";
 



// Agent products
$route['agent-products'] = "agentOrders/Agentproducts";
$route['agent-products/insertOrder'] = "agentOrders/Agentproducts/insertOrder";
$route['agent-products/myorders'] = "agentOrders/Agentproducts/myorders";
$route['agent-products/filtermyorders'] = "agentOrders/Agentproducts/filterOrders";
$route['agent-products/filterdepositorders'] = "agentOrders/Agentproducts/filterdepositorders";
$route['agent-products/depositOrders'] = "agentOrders/Agentproducts/depositOrders";
$route['agent-products/updateOrder/(:any)'] = "agentOrders/Agentproducts/updateOrder/$1";
$route['agent-products/delOrder/(:any)'] = "agentOrders/Agentproducts/delOrder/$1";
$route['agent-products/editOrder'] = "agentOrders/Agentproducts/editOrder";
$route['agent-products/transactiondocuments/(:any)'] = "agentOrders/Agentproducts/transactiondocuments/$1";




