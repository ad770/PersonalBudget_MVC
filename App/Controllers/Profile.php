<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Flash;
use \App\Models\Income;
use \App\Models\Expense;
use \App\Models\Balance;


class Profile extends Authenticated
{
    protected function before()
    {
        parent::before();

        $this->user = Auth::getUser();
    }

    public function editIncomeCategoriesAction()
    {
        View::renderTemplate('Profile/edit_incomes.html', [
            'incomeCategories' => Income::getIncomeCategories(),
            'user' => $this->user
        ]);
    }

    public function editExpenseCategoriesAction()
    {
        View::renderTemplate('Profile/edit_expenses.html', [
            'expenseCategories' => Expense::getExpenseCategories(),
            'user' => $this->user
        ]);
    }

    public function editPaymentMethodsAction()
    {
        View::renderTemplate('Profile/edit_payments.html', [
            'paymentMethods' => Expense::getPaymentCategories(),
            'user' => $this->user
        ]);
    }

    public function showAction()
    {
        View::renderTemplate('Profile/show.html', [
            'user' => $this->user
        ]);
    }

    public function editUserAction()
    {
        View::renderTemplate('Profile/edit_user.html', [
            'user' => $this->user
        ]);
    }

    public function updateAction()
    {
        if ($this->user->updateProfile($_POST)) {

            Flash::addMessage('Zapisano zmiany');

            $this->redirect('/profile/show');
        } else {

            View::renderTemplate('Profile/edit.html', [
                'user' => $this->user
            ]);
        }
    }
}
