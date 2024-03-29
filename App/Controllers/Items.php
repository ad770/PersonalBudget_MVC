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
            // Flash::addMessage('Coś poszło nie tak, spróbuj ponownie', Flash::WARNING);
            View::renderTemplate('Items/incomes.twig', [
                'incomeCategories' => Income::getIncomeCategories(),
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

    public function expensesAjaxAction()
    {
        $categoryId = $this->route_params['id'];
        $date = $this->route_params['date'];

        $startDateFind = strtotime(date("Y-m-d", strtotime($date)) . ", first day of this month");
        $startDate = date("Y-m-d", $startDateFind);
        $lastDateFind = strtotime(date("Y-m-d", strtotime($date)) . ", last day of this month");
        $endDate = date("Y-m-d", $lastDateFind);

        echo json_encode(Expense::getSumOfCategoryExpenseForSelectedMonth($categoryId, $startDate, $endDate), JSON_UNESCAPED_UNICODE);
    }

    public function limitValueAction()
    {
        $categoryId = $this->route_params['id'];
        echo json_encode(Expense::getLimitValueByExpenseId($categoryId), JSON_UNESCAPED_UNICODE);
    }

    public function newExpenseAction()
    {
        $expense = new Expense($_POST);
        if ($expense->addExpense()) {
            Flash::addMessage('Wydatek poprawnie dodano!');
            $this->redirect('/Items/expenses');
        } else {
            // Flash::addMessage('Coś poszło nie tak, spróbuj ponownie', Flash::WARNING);
            View::renderTemplate('Items/expenses.twig', [
                'expenseCategories' => Expense::getExpenseCategories(),
                'paymentCategories' => Expense::getPaymentCategories(),
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
