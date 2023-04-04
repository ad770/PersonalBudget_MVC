const hideLimitSection = () => {
    $('.limitSection').hide();
};

const isLimit = () => {
    document.getElementById('expense_cat').addEventListener('change', function () {
        this.value == 1 ? checkCategory() : hideLimitSection();
    });
}



fetch("/api/expenses")
    .then((response) => response.json())
    .then((data) => console.log(data));

// REST API
const renderOnDom = () => {

};

const calculateLimits = () => {
    //calculate limits
};

const getSumOfExpensesForSelectedMonth = () => {
    fetch(`api/expenses/:${id}?date=${date}`);
};

const getLimitForCategory = () => {
    fetch(`/api/limit/:${id}`)
        .then((response) => response.json())
        .then((data) => console.log(data));
    //Limit dla kategorii z danym id
};

//Zmiana daty
const checkLimit = () => {
    getSumOfExpensesForSelectedMonth();
    calculateLimits();
    renderOnDom();
};

//Zmiana kategorii

const checkCategory = () => {
    $('.limitSection').show();
    getLimitForCategory();
    checkLimit();
};

