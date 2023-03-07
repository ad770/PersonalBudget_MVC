// FETCH

fetch("/api/expenses")
    .then((response) => response.json())
    .then((data) => console.log(data));

// REST API
const renderOnDom = () => {
    // renderDOM if necessary
};

const calculateLimits = () => {
    //calculate limits
};

const getSumOfExpensesForSelectedMonth = () => {
    fetch(`api/expenses/:${id}?date=${date}`);
};

const getLimitForCategory = () => {
    fetch(`/api/limit/:${id}`);
    //Limit dla kategorii z danym id
};
const getLimitData = () => {
    $.ajax({
        type: 'POST',
        url: '/add-expense/get-limit-data',
        dataType: 'json',
        data: {
            postCategoryId: categoryId
        },

        success: (result) => setCurrentExpenseLimit(result.expense_limit),
        error: (xhr) => alert(xhr.status)
    });
};

//Zmiana daty
const checkLimit = () => {
    getSumOfExpensesForSelectedMonth();
    calculateLimits();
    renderOnDom();

};

//Zmiana kategorii
const checkCategory = () => {
    getLimitForCategory();
    checkLimit();
};