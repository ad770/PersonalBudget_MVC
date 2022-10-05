<?php

namespace App\Controllers;

use \Core\View;

/**
 * Items controller (example)
 *
 * PHP version 7.0
 */
//class Items extends \Core\Controller
class Items extends Authenticated
{

    /**
     * Require the user to be authenticated before giving access to all methods in the controller
     *
     * @return void
     */
    /*
    protected function before()
    {
        $this->requireLogin();
    }
    */

    /**
     * Incomes items
     *
     * @return void
     */
    public function incomesAction()
    {
        View::renderTemplate('Items/incomes.html');
    }

    public function addIncomeAction()
    {
    }

    /**
     * Expenses items
     *
     * @return void
     */
    public function expensesAction()
    {
        View::renderTemplate('Items/expenses.html');
    }

    public function addExpenseAction()
    {
    }

    /**
     * Balance items
     *
     * @return void
     */
    public function balanceAction()
    {
        View::renderTemplate('Items/balance.html');
    }

    /**
     * Add a new item
     *
     * @return void
     */
    public function newAction()
    {
        echo "new action";
    }

    /**
     * Show an item
     *
     * @return void
     */
    public function showAction()
    {
        echo "show action";
    }
}
