const hideLimitSection = () => {
    $('.limitSection').hide();
};

const isLimit = () => {
    document.getElementById('expense_cat').addEventListener('change', function () {
        const id = this.options[this.selectedIndex].id;
        this.value == 1 ? checkCategory(id) : hideLimitSection();
    });
}

const getMonth = (id) => {
    const date = document.getElementById('expense_date').value;
    console.log("Data: ");
    console.log(date);
    console.log(" id: ");
    console.log(id);

    getSumOfExpensesForSelectedMonth(id, date);
}

// fetch("/api/expenses")
//     .then((response) => response.json())
//     .then((data) => console.log(data));

// REST API
const renderOnDom = () => {

};

const calculateLimits = () => {
    //calculate limits
};

const getSumOfExpensesForSelectedMonth = (id, date) => {
    fetch(`api/expenses/:${id}?date=${date}`)
        .then(response => response.json())
        .then(data => console.log(data))
        .catch(error => (console.error('Error:', error)));

};

const getLimitForCategory = (id) => {
    fetch(`/api/limit/${id}`)
        .then(response => response.json())
        .then(data => console.log(data))
        .catch(error => (console.error('Error:', error)));
    getMonth(id);
};

//Zmiana daty
function checkLimit() {
    getSumOfExpensesForSelectedMonth();
    calculateLimits();
    renderOnDom();
}

//Zmiana kategorii

const checkCategory = (id) => {
    $('.limitSection').show();
    getLimitForCategory(id);
    //checkLimit();
};

