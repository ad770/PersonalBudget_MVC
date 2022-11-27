<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Models\Balance;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Home extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        $currentMonth = [];
        $currentMonth['beginDate'] = date('Y-m-d', strtotime('first day of this month'));
        $currentMonth['endDate'] = date('Y-m-d');
        if (Auth::isLoggedIn()) {
            View::renderTemplate('Home/index.twig', [
                'incomeSum' => Balance::getTotalIncome($currentMonth),
                'expenseSum' => Balance::getTotalExpense($currentMonth),
            ]);
        } else {
            View::renderTemplate('Login/new.html');
        }
    }
}
