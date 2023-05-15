const hideLimitSection = () => {
    $('.limitSection').hide();
};

const isLimit = () => {
    document.getElementById('expense_cat').addEventListener('change', function () {
        const id = this.options[this.selectedIndex].id;
        this.value == 1 ? checkCategory(id) : hideLimitSection();
    });
}

// REST API
const renderOnDom = () => {

};

const calculateLimits = () => {
    //calculate limits
};

const getSumOfExpensesForSelectedMonth = (id, date) => {
    fetch(`/api/expenses/${id}?date=${date}`)
        .then(response => response.json())
        .then(data => {
            let spentValue = data.expenseSum;
            document.getElementById("spent").innerHTML = spentValue
        })
        .catch(error => (console.error('Error:', error)));
};

const getLimitForCategory = (id) => {
    fetch(`/api/limit/${id}`)
        .then(response => response.json())
        .then(data => {
            let limitValue = data.limit_value;
            document.getElementById("limit").innerHTML = limitValue
        })
        .catch(error => (console.error('Error:', error)));
};

//Zmiana daty
const checkLimit = (id) => {
    // const date = new Date(document.getElementById('expense_date').value);
    const date = document.getElementById('expense_date').value;
    // const month = date.toLocaleString('en-us', { month: 'long' });;
    // const month = date.getMonth() + 1;

    // console.log(date);
    // console.log(month);

    getSumOfExpensesForSelectedMonth(id, date);
    //calculateLimits();
    //renderOnDom();
}

//Zmiana kategorii

const checkCategory = (id) => {
    $('.limitSection').show();
    getLimitForCategory(id);
    checkLimit(id);
};

