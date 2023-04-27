const hideLimitSection = () => {
    $('.limitSection').hide();
};

const isLimit = () => {
    document.getElementById('expense_cat').addEventListener('change', function () {
        const id = this.options[this.selectedIndex].id;
        console.log(id);
        this.value == 1 ? checkCategory(id) : hideLimitSection();
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
    // fetch(`api/expenses/:${id}?date=${date}`);
};

const getLimitForCategory = (id) => {
    fetch(`/api/limit/:${id}`)
        .then(response => response.json())
        .then(data => console.log(data))
        .catch(error => console.log(error));
};

//Zmiana daty
const checkLimit = () => {
    getSumOfExpensesForSelectedMonth();
    calculateLimits();
    renderOnDom();
};

//Zmiana kategorii

const checkCategory = (id) => {
    $('.limitSection').show();
    getLimitForCategory(id);
    checkLimit();
};

