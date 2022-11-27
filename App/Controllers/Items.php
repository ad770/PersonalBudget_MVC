<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Income;
use \App\Models\Expense;
use \App\Models\Balance;
use \App\Flash;


class Items extends Authenticated
{
<<<<<<< HEAD
    /**
     * Incomes items
     *
     * @return void
     */
=======
>>>>>>> features/balance-functionality
    public function incomesAction()
    {
        View::renderTemplate('Items/incomes.twig', [
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
<<<<<<< HEAD
            Flash::addMessage('Wystąpił błąd, spróbuj ponownie', Flash::WARNING);

            View::renderTemplate('Items/incomes.html', [
=======
            Flash::addMessage('Coś poszło nie tak, spróbuj ponownie', Flash::WARNING);
            View::renderTemplate('Items/incomes.twig', [
                'incomeCategories' => Income::getIncomeCategories(),
>>>>>>> features/balance-functionality
                'income' => $income
            ]);
        }
    }

    public function expensesAction()
    {
        View::renderTemplate('Items/expenses.twig', [
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
<<<<<<< HEAD
            Flash::addMessage('Wystąpił błąd, spróbuj ponownie', Flash::WARNING);

            View::renderTemplate('Items/expenses.html', [
=======
            Flash::addMessage('Coś poszło nie tak, spróbuj ponownie', Flash::WARNING);
            View::renderTemplate('Items/expenses.twig', [
                'expenseCategories' => Expense::getExpenseCategories(),
                'paymentCategories' => Expense::getPaymentCategories(),
>>>>>>> features/balance-functionality
                'expense' => $expense
            ]);
        }
    }

    public function balanceAction()
    {
        $balancePeriod = new Balance($_POST);
        if ($selectedPeriod = $balancePeriod->switchTime()) {
            View::renderTemplate('Items/balance.twig', [
                'incomesData' => Balance::getIncomes($selectedPeriod),
                'expensesData' => Balance::getExpenses($selectedPeriod),
                'incomesChartData' => Balance::getIncomesForChart($selectedPeriod),
                'expensesChartData' => Balance::getExpensesForChart($selectedPeriod),
                'incomeSum' => Balance::getTotalIncome($selectedPeriod),
                'expenseSum' => Balance::getTotalExpense($selectedPeriod),
                'beginDate' => $selectedPeriod['beginDate'],
                'endDate' => $selectedPeriod['endDate'],
                'period' => $balancePeriod
            ]);
        }
    }
}
