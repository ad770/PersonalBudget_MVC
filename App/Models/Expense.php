<?php

namespace App\Models;

use PDO;
use \App\Models\User;
use \App\Auth;
use \Core\View;

/**
 * User model
 *
 * PHP version 7.0
 */
class Expense extends \Core\Model
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

    public function addExpense()
    {
        $this->validate();

        if (empty($this->errors)) {

            $sql = 'INSERT INTO expenses (user_id, expense_category_assigned_to_user_id, payment_method_assigned_to_user_id, amount, date_of_expense, expense_comment)
                    VALUES (:user_id, :expense_cat, :payment_cat, :expense_value, :expense_date, :expense_comment)';
            $user_id = Auth::getUser();
            $db = static::getDB();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':user_id', $user_id->id, PDO::PARAM_INT);
            $stmt->bindValue(':expense_cat', $this->expense_cat, PDO::PARAM_STR);
            $stmt->bindValue(':payment_cat', $this->expense_payment, PDO::PARAM_STR);
            $stmt->bindValue(':expense_value', $this->expense_value, PDO::PARAM_STR);
            $stmt->bindValue(':expense_date', $this->expense_date, PDO::PARAM_STR);
            $stmt->bindValue(':expense_comment', $this->expense_comment, PDO::PARAM_STR);
            return $stmt->execute();
        }
        return false;
    }

    public static function getExpenseCategories()
    {
        $sql = 'SELECT * FROM expenses_category_assigned_to_users
                WHERE user_id = :user_id';
        $user_id = Auth::getUser();
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':user_id', $user_id->id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function createExpenseCategoriesForNewUser($user_id)
    {
        $sql = 'INSERT INTO expenses_category_assigned_to_users (user_id, name) 
                SELECT :user_id, name FROM expenses_category_default';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        return $stmt->execute();
    }

    public static function getLimitValueByExpenseId($id)
    {
        $sql = 'SELECT limit_value FROM expenses_category_assigned_to_users
                WHERE user_id = :user_id AND id = :id';
        $user_id = Auth::getUser();
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':user_id', $user_id->id, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getSumOfCategoryExpenseForSelectedMonth($id, $startDate, $endDate)
    {
        $sql = 'SELECT SUM(expenses.amount) as expenseSum FROM expenses WHERE expenses.expense_category_assigned_to_user_id = :id AND expenses.date_of_expense BETWEEN :beginDate AND :endDate';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':beginDate', $startDate, PDO::PARAM_STR);
        $stmt->bindValue(':endDate', $endDate, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
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

    public static function createPaymentCategoriesForNewUser($user_id)
    {
        $sql = 'INSERT INTO payment_methods_assigned_to_users (user_id, name) 
                SELECT :user_id, name FROM payment_methods_default';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);

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
            $this->errors[] = 'podaj wartość';
        } else if ($this->expense_value <= '0') {
            $this->errors[] = 'wartość musi być większa od 0';
        }

        //Expense category
        if (!isset($this->expense_cat)) {
            $this->errors[] = 'kategoria wydatku nie może być pusta';
        }

        //Payment method
        if (!isset($this->expense_payment)) {
            $this->errors[] = 'metoda płatności nie może być pusta';
        }

        //Date of expense
        if ($this->expense_date == '') {
            $this->errors[] = 'data wydatku nie może być pusta';
        }
    }
}
