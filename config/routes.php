<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\Router;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass('DashedRoute');

Router::prefix('admin', function ($routes) {
    $routes->connect('/', ['controller' => 'CustomPages', 'action' => 'index']);
    $routes->fallbacks('DashedRoute');
});

Router::addUrlFilter(function ($params, $request) {
    if (isset($request->params['case_slug']) && !isset($params['case_slug'])) {
        $params['case_slug'] = $request->params['case_slug'];
    }
    return $params;
});

Router::scope(
    '/cases/:case_slug',
    function ($routes) {
        $routes->connect('/', ['controller' => 'CustomPages', 'action' => 'intro']);
        $routes->connect('/physical-exam', ['controller' => 'CustomPages', 'action' => 'physical_exam']);
        $routes->connect('/more-information', ['controller' => 'CustomPages', 'action' => 'more_information']);
        $routes->connect('/management', ['controller' => 'ManagementCounselings', 'action' => 'index']);
        $routes->connect('/management/medication', ['controller' => 'ManagementMedications', 'action' => 'index']);
        $routes->connect('/management/referral', ['controller' => 'ManagementReferrals', 'action' => 'index']);
        $routes->connect('/management/next-section', ['controller' => 'ManagementReferrals', 'action' => 'can_advance']);
        $routes->connect('/billing', ['controller' => 'Billings']);
        $routes->connect('/billing/next-section', ['controller' => 'Billings', 'action' => 'can_advance']);
        $routes->connect('/feedback', ['controller' => 'Feedback', 'action' => 'study']);
        $routes->connect('/feedback/counseling', ['controller' => 'Feedback', 'action' => 'counseling']);
        $routes->connect('/feedback/medication', ['controller' => 'Feedback', 'action' => 'medication']);
        $routes->connect('/feedback/referral', ['controller' => 'Feedback', 'action' => 'referral']);
        $routes->connect('/feedback/billing', ['controller' => 'Feedback', 'action' => 'billing']);
        $routes->connect('/summary', ['controller' => 'CustomPages', 'action' => 'summary']);
        $routes->fallbacks('DashedRoute');
    }
);


Router::scope('/', function ($routes) {
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);

    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks('DashedRoute');
});

/**
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();

