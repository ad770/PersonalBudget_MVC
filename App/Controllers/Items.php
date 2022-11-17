<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Income;
use \App\Models\Expense;
use \App\Auth;
use App\Models\RememberedLogin;
use \App\Flash;



/**
 * Items controller (example)
 *
 * PHP version 7.0
 */
//class Items extends \Core\Controller
class Items extends Authenticated
{
    /**
     * Incomes items
     *
     * @return void
     */
    public function incomesAction()
    {
        $categories = Income::getIncomeCategories();
        View::renderTemplate('Items/incomes.html', [
            'incomeCategories' => $categories
        ]);
    }

    public function newIncomeAction()
    {
        $income = new Income($_POST);

        if ($income->addIncome()) {
            Flash::addMessage('Przychód poprawnie dodano!');
            $this->redirect('/Items/incomes');
        } else {
            Flash::addMessage('Wystąpił błąd, spróbuj ponownie', Flash::WARNING);

            View::renderTemplate('Items/incomes.html', [
                'income' => $income
            ]);
        }
    }

    /**
     * Expenses items
     *
     * @return void
     */
    public function expensesAction()
    {
        $categories = Expense::getExpenseCategories();
        $payments = Expense::getPaymentCategories();
        View::renderTemplate('Items/expenses.html', [
            'expenseCategories' => $categories,
            'paymentCategories' => $payments
        ]);
    }

    public function newExpenseAction()
    {
        $expense = new Expense($_POST);
        if ($expense->addExpense()) {
            Flash::addMessage('Wydatek poprawnie dodano!');
            $this->redirect('/Items/expenses');
        } else {
            Flash::addMessage('Wystąpił błąd, spróbuj ponownie', Flash::WARNING);

            View::renderTemplate('Items/expenses.html', [
                'expense' => $expense
            ]);
        }
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
