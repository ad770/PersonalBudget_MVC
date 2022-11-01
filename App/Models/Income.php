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
class Income extends \Core\Model
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
    public function __construct($incomeData = [])
    {
        foreach ($incomeData as $key => $value) {
            $this->$key = $value;
        };
    }

    public function addIncome()
    {
        // $this->validate();

        if (empty($this->errors)) {

            $sql = 'INSERT INTO incomes (user_id, income_category_assigned_to_user_id, amount, date_of_income, income_comment)
                    VALUES (:user_id, :income_cat, :income_value, :income_date, :income_comment)';
            $user_id = Auth::getUser();
            $db = static::getDB();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':user_id', $user_id->id, PDO::PARAM_STR);
            $stmt->bindValue(':income_cat', $this->income_cat, PDO::PARAM_STR);
            $stmt->bindValue(':income_value', $this->income_value, PDO::PARAM_STR);
            $stmt->bindValue(':income_date', $this->income_date, PDO::PARAM_STR);
            $stmt->bindValue(':income_comment', $this->income_comment, PDO::PARAM_STR);
            var_dump($user_id->id, ' ', $this->income_cat, ' ', $this->income_value, ' ', $this->income_date, ' ', $this->income_comment);

            var_dump($stmt);
            return $stmt->execute();
        }

        return false;
    }

    public function getIncomeCategories()
    {
        $sql = 'SELECT name FROM incomes_category_assigned_to_users
                WHERE user_id = :user_id';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':user_id', $this->user_id, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        // while ($cat_results = $cat_query->fetch(PDO::FETCH_ASSOC)) {
        //     echo "<option value='" . $cat_results['name'] . "''>" . $cat_results['name'] . "</option>";
        // }
        return $stmt->fetch();
    }
    /**
     * Validate current property values, adding valiation error messages to the errors array property
     *
     * @return void
     */
    public function validate()
    {
        // Value
        if ($this->income_value == '') {
            $this->errors[] = 'Podaj wartość';
        } else if ($this->income_value <= '0') {
            $this->errors[] = 'Wartość musi być większa od 0';
        }

        //Category
        // if ($this->income_id_cat == '') {
        //     $this->errors[] = 'Wybierz kategorię przychodu';
        // }

        //Date of income
        if ($this->income_date == '') {
            $this->errors[] = 'Wybierz datę przychodu';
        }
    }
}
