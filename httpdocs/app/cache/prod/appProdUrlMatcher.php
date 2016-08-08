<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        // nestle_web_homepage
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'nestle_web_homepage');
            }

            return array (  '_controller' => 'Nestle\\WebBundle\\Controller\\MainController::indexAction',  '_route' => 'nestle_web_homepage',);
        }

        if (0 === strpos($pathinfo, '/lead-data')) {
            // nestle_web_leads_data_ajax
            if ($pathinfo === '/lead-data') {
                return array (  '_controller' => 'Nestle\\WebBundle\\Controller\\MainController::leadsDataAjaxAction',  '_route' => 'nestle_web_leads_data_ajax',);
            }

            // nestle_web_leads_data_table_ajax
            if ($pathinfo === '/lead-data-table') {
                return array (  '_controller' => 'Nestle\\WebBundle\\Controller\\MainController::leadsDataTableAjaxAction',  '_route' => 'nestle_web_leads_data_table_ajax',);
            }

        }

        if (0 === strpos($pathinfo, '/sales')) {
            // nestle_web_leads_info
            if (0 === strpos($pathinfo, '/sales/transaction') && preg_match('#^/sales/transaction/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'nestle_web_leads_info')), array (  '_controller' => 'Nestle\\WebBundle\\Controller\\MainController::leadInfoAction',));
            }

            // nestle_web_get_exported_data
            if ($pathinfo === '/sales/get-export-data') {
                return array (  '_controller' => 'Nestle\\WebBundle\\Controller\\MainController::getExportDataAction',  '_route' => 'nestle_web_get_exported_data',);
            }

        }

        if (0 === strpos($pathinfo, '/bow')) {
            if (0 === strpos($pathinfo, '/bow/account')) {
                if (0 === strpos($pathinfo, '/bow/accounts')) {
                    // nestle_web_account_leads
                    if ($pathinfo === '/bow/accounts') {
                        return array (  '_controller' => 'Nestle\\WebBundle\\Controller\\AccountsController::accountsAction',  '_route' => 'nestle_web_account_leads',);
                    }

                    // nestle_web_account_leads_add
                    if (rtrim($pathinfo, '/') === '/bow/accounts/add') {
                        if (substr($pathinfo, -1) !== '/') {
                            return $this->redirect($pathinfo.'/', 'nestle_web_account_leads_add');
                        }

                        return array (  '_controller' => 'Nestle\\WebBundle\\Controller\\AccountsController::accountsProfileAddAction',  '_route' => 'nestle_web_account_leads_add',);
                    }

                    if (0 === strpos($pathinfo, '/bow/accounts/profile')) {
                        // nestle_web_account_leads_profile
                        if (preg_match('#^/bow/accounts/profile/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'nestle_web_account_leads_profile')), array (  '_controller' => 'Nestle\\WebBundle\\Controller\\AccountsController::accountsProfileAction',));
                        }

                        // nestle_web_account_leads_profile_edit
                        if (0 === strpos($pathinfo, '/bow/accounts/profile/edit') && preg_match('#^/bow/accounts/profile/edit/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'nestle_web_account_leads_profile_edit')), array (  '_controller' => 'Nestle\\WebBundle\\Controller\\AccountsController::accountsProfileEditAction',));
                        }

                    }

                    if (0 === strpos($pathinfo, '/bow/accounts/table')) {
                        // nestle_web_account_leads_table
                        if ($pathinfo === '/bow/accounts/table') {
                            return array (  '_controller' => 'Nestle\\WebBundle\\Controller\\AccountsController::accountsTableAction',  '_route' => 'nestle_web_account_leads_table',);
                        }

                        // nestle_web_account_leads_table_data
                        if ($pathinfo === '/bow/accounts/table-data') {
                            return array (  '_controller' => 'Nestle\\WebBundle\\Controller\\AccountsController::accountsTableDataAction',  '_route' => 'nestle_web_account_leads_table_data',);
                        }

                    }

                    // nestle_web_account_import_data
                    if ($pathinfo === '/bow/accounts/import') {
                        return array (  '_controller' => 'Nestle\\WebBundle\\Controller\\AccountsController::processCsvAction',  '_route' => 'nestle_web_account_import_data',);
                    }

                }

                // nestle_web_account_delete
                if (0 === strpos($pathinfo, '/bow/account/delete') && preg_match('#^/bow/account/delete/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'nestle_web_account_delete')), array (  '_controller' => 'Nestle\\WebBundle\\Controller\\AccountsController::accountsDeleteAction',));
                }

            }

            if (0 === strpos($pathinfo, '/bow/bowers')) {
                // nestle_web_bower
                if ($pathinfo === '/bow/bowers') {
                    return array (  '_controller' => 'Nestle\\WebBundle\\Controller\\BowerController::bowersAction',  '_route' => 'nestle_web_bower',);
                }

                // nestle_web_bower_add
                if ($pathinfo === '/bow/bowers/add') {
                    return array (  '_controller' => 'Nestle\\WebBundle\\Controller\\BowerController::bowerAddAction',  '_route' => 'nestle_web_bower_add',);
                }

                // nestle_web_bower_profile
                if (0 === strpos($pathinfo, '/bow/bowers/profile') && preg_match('#^/bow/bowers/profile/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'nestle_web_bower_profile')), array (  '_controller' => 'Nestle\\WebBundle\\Controller\\BowerController::bowerProfileAction',));
                }

                // nestle_web_bower_edit
                if (0 === strpos($pathinfo, '/bow/bowers/edit') && preg_match('#^/bow/bowers/edit/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'nestle_web_bower_edit')), array (  '_controller' => 'Nestle\\WebBundle\\Controller\\BowerController::bowerEditAction',));
                }

            }

            // nestle_web_bower_delete
            if (0 === strpos($pathinfo, '/bower/bowers/delete') && preg_match('#^/bower/bowers/delete/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'nestle_web_bower_delete')), array (  '_controller' => 'Nestle\\WebBundle\\Controller\\BowerController::bowerDeleteAction',));
            }

            if (0 === strpos($pathinfo, '/bow/bowers')) {
                if (0 === strpos($pathinfo, '/bow/bowers/table')) {
                    // nestle_web_bower_table
                    if ($pathinfo === '/bow/bowers/table') {
                        return array (  '_controller' => 'Nestle\\WebBundle\\Controller\\BowerController::bowersTableAction',  '_route' => 'nestle_web_bower_table',);
                    }

                    // nestle_web_bower_table_data
                    if ($pathinfo === '/bow/bowers/table-data') {
                        return array (  '_controller' => 'Nestle\\WebBundle\\Controller\\BowerController::bowersTableDataAction',  '_route' => 'nestle_web_bower_table_data',);
                    }

                }

                // nestle_web_bower_import_data
                if ($pathinfo === '/bow/bowers/import-data') {
                    return array (  '_controller' => 'Nestle\\WebBundle\\Controller\\BowerController::processCsvAction',  '_route' => 'nestle_web_bower_import_data',);
                }

            }

            if (0 === strpos($pathinfo, '/bow/pro')) {
                if (0 === strpos($pathinfo, '/bow/promo')) {
                    // nestle_web_promo
                    if ($pathinfo === '/bow/promo') {
                        return array (  '_controller' => 'Nestle\\WebBundle\\Controller\\PromoController::promosAction',  '_route' => 'nestle_web_promo',);
                    }

                    if (0 === strpos($pathinfo, '/bow/promo/table')) {
                        // nestle_web_promo_table
                        if ($pathinfo === '/bow/promo/table') {
                            return array (  '_controller' => 'Nestle\\WebBundle\\Controller\\PromoController::promoTableAction',  '_route' => 'nestle_web_promo_table',);
                        }

                        // nestle_web_promo_table_data
                        if ($pathinfo === '/bow/promo/table-data') {
                            return array (  '_controller' => 'Nestle\\WebBundle\\Controller\\PromoController::promoTableDataAction',  '_route' => 'nestle_web_promo_table_data',);
                        }

                    }

                    // nestle_web_promo_add
                    if ($pathinfo === '/bow/promo/add') {
                        return array (  '_controller' => 'Nestle\\WebBundle\\Controller\\PromoController::promoAddAction',  '_route' => 'nestle_web_promo_add',);
                    }

                    // nestle_web_promo_view
                    if (0 === strpos($pathinfo, '/bow/promo/view') && preg_match('#^/bow/promo/view/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'nestle_web_promo_view')), array (  '_controller' => 'Nestle\\WebBundle\\Controller\\PromoController::promoViewAction',));
                    }

                    // nestle_web_promo_edit
                    if (0 === strpos($pathinfo, '/bow/promo/edit') && preg_match('#^/bow/promo/edit/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'nestle_web_promo_edit')), array (  '_controller' => 'Nestle\\WebBundle\\Controller\\PromoController::promoEditAction',));
                    }

                    // nestle_web_promo_delete
                    if (0 === strpos($pathinfo, '/bow/promo/delete') && preg_match('#^/bow/promo/delete/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'nestle_web_promo_delete')), array (  '_controller' => 'Nestle\\WebBundle\\Controller\\PromoController::promoDeleteAction',));
                    }

                    // nestle_web_promo_import
                    if ($pathinfo === '/bow/promo/import-data') {
                        return array (  '_controller' => 'Nestle\\WebBundle\\Controller\\PromoController::processCsvAction',  '_route' => 'nestle_web_promo_import',);
                    }

                }

                if (0 === strpos($pathinfo, '/bow/product')) {
                    // nestle_web_products
                    if ($pathinfo === '/bow/products') {
                        return array (  '_controller' => 'Nestle\\WebBundle\\Controller\\ProductController::productsAction',  '_route' => 'nestle_web_products',);
                    }

                    if (0 === strpos($pathinfo, '/bow/product/table')) {
                        // nestle_web_product_table
                        if ($pathinfo === '/bow/product/table') {
                            return array (  '_controller' => 'Nestle\\WebBundle\\Controller\\ProductController::productTableAction',  '_route' => 'nestle_web_product_table',);
                        }

                        // nestle_web_product_table_data
                        if ($pathinfo === '/bow/product/table-data') {
                            return array (  '_controller' => 'Nestle\\WebBundle\\Controller\\ProductController::productTableDataAction',  '_route' => 'nestle_web_product_table_data',);
                        }

                    }

                    // nestle_web_product_import_data
                    if ($pathinfo === '/bow/product/import-data') {
                        return array (  '_controller' => 'Nestle\\WebBundle\\Controller\\ProductController::processCsvAction',  '_route' => 'nestle_web_product_import_data',);
                    }

                    if (0 === strpos($pathinfo, '/bow/products')) {
                        // nestle_web_product_add
                        if ($pathinfo === '/bow/products/add') {
                            return array (  '_controller' => 'Nestle\\WebBundle\\Controller\\ProductController::productAddAction',  '_route' => 'nestle_web_product_add',);
                        }

                        // nestle_web_product_edit
                        if (0 === strpos($pathinfo, '/bow/products/edit') && preg_match('#^/bow/products/edit/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'nestle_web_product_edit')), array (  '_controller' => 'Nestle\\WebBundle\\Controller\\ProductController::productEditAction',));
                        }

                    }

                    // nestle_web_product_view
                    if (0 === strpos($pathinfo, '/bow/product/view') && preg_match('#^/bow/product/view/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'nestle_web_product_view')), array (  '_controller' => 'Nestle\\WebBundle\\Controller\\ProductController::productViewAction',));
                    }

                    // nestle_web_product_delete
                    if (0 === strpos($pathinfo, '/bow/product/delete') && preg_match('#^/bow/product/delete/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'nestle_web_product_delete')), array (  '_controller' => 'Nestle\\WebBundle\\Controller\\ProductController::productDeleteAction',));
                    }

                }

            }

            if (0 === strpos($pathinfo, '/bow/distributor')) {
                // nestle_web_distributor_list
                if ($pathinfo === '/bow/distributor') {
                    return array (  '_controller' => 'Nestle\\WebBundle\\Controller\\DistributorController::distributorViewAction',  '_route' => 'nestle_web_distributor_list',);
                }

                // nestle_web_distributor_fetch_list
                if ($pathinfo === '/bow/distributor/get') {
                    return array (  '_controller' => 'Nestle\\WebBundle\\Controller\\DistributorController::distributorListAction',  '_route' => 'nestle_web_distributor_fetch_list',);
                }

                // nestle_web_distributor_manage
                if ($pathinfo === '/bow/distributor/manage') {
                    return array (  '_controller' => 'Nestle\\WebBundle\\Controller\\DistributorController::distributorManageAction',  '_route' => 'nestle_web_distributor_manage',);
                }

                // nestle_web_distributor_delete
                if ($pathinfo === '/bow/distributor/delete') {
                    return array (  '_controller' => 'Nestle\\WebBundle\\Controller\\DistributorController::distributorDeleteAction',  '_route' => 'nestle_web_distributor_delete',);
                }

            }

        }

        if (0 === strpos($pathinfo, '/cycle-plan')) {
            // nestle_web_cycle_plan
            if ($pathinfo === '/cycle-plan') {
                return array (  '_controller' => 'Nestle\\WebBundle\\Controller\\CyclePlanController::indexAction',  '_route' => 'nestle_web_cycle_plan',);
            }

            // nestle_web_cycle_plan_add
            if ($pathinfo === '/cycle-plan/add') {
                return array (  '_controller' => 'Nestle\\WebBundle\\Controller\\CyclePlanController::addCyclePlanAction',  '_route' => 'nestle_web_cycle_plan_add',);
            }

            // nestle_web_bower_cycle_plan_profile
            if (0 === strpos($pathinfo, '/cycle-plan/profile') && preg_match('#^/cycle\\-plan/profile/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'nestle_web_bower_cycle_plan_profile')), array (  '_controller' => 'Nestle\\WebBundle\\Controller\\CyclePlanController::profileCyclePlanAction',));
            }

            // nestle_web_cycle_plan_edit
            if (0 === strpos($pathinfo, '/cycle-plan/edit') && preg_match('#^/cycle\\-plan/edit/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'nestle_web_cycle_plan_edit')), array (  '_controller' => 'Nestle\\WebBundle\\Controller\\CyclePlanController::editCyclePlanAction',));
            }

            // nestle_web_cycle_plan_delete
            if (0 === strpos($pathinfo, '/cycle-plan/delete') && preg_match('#^/cycle\\-plan/delete/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'nestle_web_cycle_plan_delete')), array (  '_controller' => 'Nestle\\WebBundle\\Controller\\CyclePlanController::deleteCyclePlanAction',));
            }

        }

        if (0 === strpos($pathinfo, '/mobile/bower')) {
            // nestle_mobile_bower_login
            if ($pathinfo === '/mobile/bower/login') {
                return array (  '_controller' => 'Nestle\\MobileBundle\\Controller\\MainController::bowerLoginAction',  '_route' => 'nestle_mobile_bower_login',);
            }

            // nestle_mobile_bower_accounts
            if ($pathinfo === '/mobile/bower/accounts') {
                return array (  '_controller' => 'Nestle\\MobileBundle\\Controller\\MainController::retrieveMcpAction',  '_route' => 'nestle_mobile_bower_accounts',);
            }

            if (0 === strpos($pathinfo, '/mobile/bower/pro')) {
                // nestle_mobile_bower_products
                if ($pathinfo === '/mobile/bower/products') {
                    return array (  '_controller' => 'Nestle\\MobileBundle\\Controller\\MainController::retrieveProductsAction',  '_route' => 'nestle_mobile_bower_products',);
                }

                // nestle_mobile_bower_promo
                if ($pathinfo === '/mobile/bower/promos') {
                    return array (  '_controller' => 'Nestle\\MobileBundle\\Controller\\MainController::retrievePromoAction',  '_route' => 'nestle_mobile_bower_promo',);
                }

            }

            // nestle_mobile_bower_invoice_callback
            if ($pathinfo === '/mobile/bower/invoice/callback') {
                return array (  '_controller' => 'Nestle\\MobileBundle\\Controller\\MainController::receiveSalesReportAction',  '_route' => 'nestle_mobile_bower_invoice_callback',);
            }

            if (0 === strpos($pathinfo, '/mobile/bower/login')) {
                // nestle_mobile_bower_account_block
                if ($pathinfo === '/mobile/bower/login/block') {
                    return array (  '_controller' => 'Nestle\\MobileBundle\\Controller\\MainController::blockAccountLoginAction',  '_route' => 'nestle_mobile_bower_account_block',);
                }

                // nestle_mobile_bower_forgot_password
                if ($pathinfo === '/mobile/bower/login/forgot-password') {
                    return array (  '_controller' => 'Nestle\\MobileBundle\\Controller\\MainController::forgotPasswordAction',  '_route' => 'nestle_mobile_bower_forgot_password',);
                }

            }

            // nestle_mobile_bower_cycle_plan
            if ($pathinfo === '/mobile/bower/cycle-plan') {
                return array (  '_controller' => 'Nestle\\MobileBundle\\Controller\\MainController::retrieveCyclePlanAction',  '_route' => 'nestle_mobile_bower_cycle_plan',);
            }

        }

        // nestle_core_homepage
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'nestle_core_homepage');
            }

            return array (  '_controller' => 'Nestle\\CoreBundle\\Controller\\CoreController::indexAction',  '_route' => 'nestle_core_homepage',);
        }

        if (0 === strpos($pathinfo, '/log')) {
            if (0 === strpos($pathinfo, '/login')) {
                // login
                if (preg_match('#^/login(?:(?P<trailingSlash>[/]{0,1}))?$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'login')), array (  '_controller' => 'Nestle\\CoreBundle\\Controller\\CoreController::loginAction',  'trailingSlash' => '/',));
                }

                // _security_check
                if ($pathinfo === '/login_check') {
                    return array('_route' => '_security_check');
                }

            }

            // logout
            if ($pathinfo === '/logout') {
                return array('_route' => 'logout');
            }

        }

        // error403
        if ($pathinfo === '/forbidden') {
            return array (  '_controller' => 'Nestle\\CoreBundle\\Controller\\CoreController::forbiddenAction',  '_route' => 'error403',);
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
