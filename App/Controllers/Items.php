<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Income;
use \App\Auth;
use App\Models\RememberedLogin;



/**
 * Items controller (example)
 *
 * PHP version 7.0
 */
//class Items extends \Core\Controller
class Items extends Authenticated
{
    // /**
    //  * Before filter - called before each action method
    //  *
    //  * @return void
    //  */
    // protected function before()
    // {
    //     parent::before();

    //     $this->user = Auth::getUser();
    // }

    /**
     * Incomes items
     *
     * @return void
     */
    public function incomesAction()
    {
        $categories = Income::getIncomeCategories();
        View::renderTemplate('Items/incomes.html', [
            'categories' => $categories
        ]);
        // Funkcja wypisuje poprawnie pobrane dane z bazy danych
        // Nie wyświetla opcji na liście wyboru kategorii w incomes.html 
        // Błąd z pętlą foreach w incomes.html line 40!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        foreach ($categories as $category) {
            echo ($category->name);
            echo "<br>";
        };
    }

    public function newIncomeAction()
    {
        $income = new Income($_POST);
        if ($income->addIncome()) {
            $this->redirect('/Items/incomes');
        } else {
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
        View::renderTemplate('Items/expenses.html');
    }

    public function addExpenseAction()
    {
        View::renderTemplate('Items/expenses.html');
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
