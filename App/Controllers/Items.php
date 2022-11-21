<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Income;
use \App\Models\Expense;
use \App\Models\Balance;
use \App\Flash;


class Items extends Authenticated
{
    public function incomesAction()
    {
        View::renderTemplate('Items/incomes.html', [
            'incomeCategories' => Income::getIncomeCategories()
        ]);
    }

    public function newIncomeAction()
    {
        $income = new Income($_POST);
        if ($income->addIncome()) {
            Flash::addMessage('Przychód poprawnie dodano!');
            $this->redirect('/Items/incomes');
        } else {
            Flash::addMessage('Coś poszło nie tak, spróbuj ponownie', Flash::WARNING);
            View::renderTemplate('Items/incomes.html', [
                'incomeCategories' => Income::getIncomeCategories(),
                'income' => $income
            ]);
        }
    }

    public function expensesAction()
    {
        View::renderTemplate('Items/expenses.html', [
            'expenseCategories' => Expense::getExpenseCategories(),
            'paymentCategories' => Expense::getPaymentCategories()
        ]);
    }

    public function newExpenseAction()
    {
        $expense = new Expense($_POST);
        if ($expense->addExpense()) {
            Flash::addMessage('Wydatek poprawnie dodano!');
            $this->redirect('/Items/expenses');
        } else {
            Flash::addMessage('Coś poszło nie tak, spróbuj ponownie', Flash::WARNING);
            View::renderTemplate('Items/expenses.html', [
                'expenseCategories' => Expense::getExpenseCategories(),
                'paymentCategories' => Expense::getPaymentCategories(),
                'expense' => $expense
            ]);
        }
    }

    public function balanceAction()
    {
        $balanceUndenify = new Balance($_POST);
        if ($balanceUndenify->prepare()) {
            var_dump($balanceUndenify);
            View::renderTemplate('Items/balance.html', [
                'expensesData' => Balance::getExpenses(),
                'incomesData' => Balance::getIncomes(),
                'expensesChartData' => Balance::getTotalExpense(),
                'incomesChartData' => Balance::getTotalIncome()
            ]);
        }
    }

    public function setDateAction()
    {
        $balanceUndenify = new Balance($_POST);
        var_dump($balanceUndenify);
        if ($balanceUndenify->prepare()) {
            $this->balanceAction();
        } else {
            Flash::addMessage('Coś poszło nie tak, spróbuj ponownie', Flash::WARNING);
            $this->balanceAction();
        }
    }
}
