<?php

namespace App\Models;

use PDO;
use \App\Auth;
use \Core\View;

/**
 * User model
 *
 * PHP version 7.0
 */
class Balance extends \Core\Model
{
    /**
     * Error messages
     *
     * @var array
     */
    public $errors = [];

    /**
     * Class constructor
     *
     * @param array $data  Initial property values (optional)
     *
     * @return void
     */
    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }

    public function switchTime()
    {
        if (!isset($this->balanceDateOption)) {
            $this->balanceDateOption = 'current_month';
        }
        $timePeriod = [];
        switch ($this->balanceDateOption) {
            default:
            case 'currentMonth':
                $timePeriod['beginDate'] = date('Y-m-d', strtotime('first day of this month'));
                $timePeriod['endDate'] = date('Y-m-d');
                return $timePeriod;
                break;

            case 'previousMonth':
                $timePeriod['beginDate'] = date('Y-m-d', strtotime("first day of last month"));
                $timePeriod['endDate'] = date('Y-m-d', strtotime("last day of last month"));
                return $timePeriod;
                break;

            case 'currentYear':
                $timePeriod['beginDate'] = date('Y-m-d', strtotime("first day of january"));
                $timePeriod['endDate'] = date('Y-m-d');
                return $timePeriod;
                break;

            case 'undenify':
                $timePeriod['beginDate'] = $this->postBeginDate;
                $timePeriod['endDate'] =  $this->postEndDate;
                return $timePeriod;
                break;
        }
        return false;
    }

    public static function getIncomes($selectedPeriod)
    {
        $sql = 'SELECT incomes_category_assigned_to_users.name, incomes.income_category_assigned_to_user_id, incomes.amount, incomes.date_of_income, incomes.income_comment 
                FROM incomes, incomes_category_assigned_to_users
                WHERE incomes.user_id = :user_id 
                AND incomes.income_category_assigned_to_user_id = incomes_category_assigned_to_users.id
                AND incomes.date_of_income BETWEEN :beginDate AND :endDate';
        $user_id = Auth::getUser();
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':user_id', $user_id->id, PDO::PARAM_INT);
        $stmt->bindValue(':beginDate', $selectedPeriod['beginDate'], PDO::PARAM_STR);
        $stmt->bindValue(':endDate', $selectedPeriod['endDate'], PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function getExpenses($selectedPeriod)
    {
        $sql = 'SELECT expenses_category_assigned_to_users.name as expense_cat, payment_methods_assigned_to_users.name as payment_method, expenses.expense_category_assigned_to_user_id, expenses.payment_method_assigned_to_user_id, expenses.amount, expenses.date_of_expense, expenses.expense_comment 
                FROM expenses, expenses_category_assigned_to_users, payment_methods_assigned_to_users
                WHERE expenses.user_id = :user_id 
                AND expenses.expense_category_assigned_to_user_id = expenses_category_assigned_to_users.id 
                AND expenses.payment_method_assigned_to_user_id = payment_methods_assigned_to_users.id
                AND expenses.date_of_expense BETWEEN :beginDate AND :endDate';
        $user_id = Auth::getUser();
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':user_id', $user_id->id, PDO::PARAM_INT);
        $stmt->bindValue(':beginDate', $selectedPeriod['beginDate'], PDO::PARAM_STR);
        $stmt->bindValue(':endDate', $selectedPeriod['endDate'], PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function getExpenseCategoryName()
    {
        $sql = 'SELECT * FROM expenses_category_assigned_to_users
                WHERE user_id = :user_id';
        $user_id = Auth::getUser();
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':user_id', $user_id->id, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function getPaymentCategories()
    {
        $sql = 'SELECT * FROM payment_methods_assigned_to_users
                WHERE user_id = :user_id';
        $user_id = Auth::getUser();
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':user_id', $user_id->id, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function getTotalIncome($selectedPeriod)
    {
        $sql = 'SELECT incomes_category_assigned_to_users.name, SUM(incomes.amount) as incomeSum FROM incomes_category_assigned_to_users, incomes WHERE incomes.user_id = :user_id 
        AND incomes.income_category_assigned_to_user_id = incomes_category_assigned_to_users.id
        AND incomes.date_of_income BETWEEN :beginDate AND :endDate
        GROUP BY incomes_category_assigned_to_users.name';
        $user_id = Auth::getUser();
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':user_id', $user_id->id, PDO::PARAM_INT);
        $stmt->bindValue(':beginDate', $selectedPeriod['beginDate'], PDO::PARAM_STR);
        $stmt->bindValue(':endDate', $selectedPeriod['endDate'], PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        return $stmt->execute();
    }

    public static function getTotalExpense($selectedPeriod)
    {
        $sql = 'SELECT expenses_category_assigned_to_users.name, SUM(expenses.amount) as expenseSum FROM expenses_category_assigned_to_users, expenses WHERE expenses.user_id = :user_id 
        AND expenses.expense_category_assigned_to_user_id = expenses_category_assigned_to_users.id
        AND expenses.date_of_expense BETWEEN :beginDate AND :endDate
        GROUP BY expenses_category_assigned_to_users.name';
        $user_id = Auth::getUser();
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':user_id', $user_id->id, PDO::PARAM_INT);
        $stmt->bindValue(':beginDate', $selectedPeriod['beginDate'], PDO::PARAM_STR);
        $stmt->bindValue(':endDate', $selectedPeriod['endDate'], PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        return $stmt->execute();
    }
    /**
     * Validate current property values, adding valiation error messages to the errors array property
     *
     * @return void
     */
    public function validate()
    {
        // Value
        if ($this->expense_value == '') {
            $this->errors[] = 'Podaj wartość';
        } else if ($this->expense_value <= '0') {
            $this->errors[] = 'Wartość musi być większa od 0';
        }

        //Expense category
        if (empty($this->expense_cat)) {
            $this->errors[] = 'Wybierz kategorię wydatku';
        }

        //Payment method
        if (empty($this->payment_cat)) {
            $this->errors[] = 'Wybierz metodę płatności';
        }

        //Date of expense
        if (empty($this->expense_date)) {
            $this->errors[] = 'Wybierz datę wydatku';
        }
    }
}
