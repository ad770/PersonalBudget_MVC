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
            Flash::addMessage('Coś poszło nie tak, spróbuj ponownie', Flash::WARNING);
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
        $id = $this->route_params['id'];
        $date = $this->route_params['date'];
        echo ("Dane pobrane:");
        echo ("ID: ");
        echo ($id);
        echo ("Date: ");
        echo ($date);
        echo ("Koniec danych");
        // echo json_encode(Expense::getLimitValueByExpenseId($id), JSON_UNESCAPED_UNICODE);
    }

    public function limitValueAction()
    {
        $id = $this->route_params['id'];
        echo json_encode(Expense::getLimitValueByExpenseId($id), JSON_UNESCAPED_UNICODE);
    }

    public function newExpenseAction()
    {
        $expense = new Expense($_POST);
        if ($expense->addExpense()) {
            Flash::addMessage('Wydatek poprawnie dodano!');
            $this->redirect('/Items/expenses');
        } else {
            Flash::addMessage('Coś poszło nie tak, spróbuj ponownie', Flash::WARNING);
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
        print_r($balancePeriod);
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