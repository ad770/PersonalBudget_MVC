document.getElementById('expense_cat').addEventListener('change', isLimit);

const hideLimitSection = () => {
    $('.limitSection').hide();
};

function isLimit() {
    const id = this.options[this.selectedIndex].id;
    this.value == 1 ? checkCategory(id) : hideLimitSection();

};

// REST API
const renderOnDom = () => {

};

const calculateLimits = () => {
    // let expenseLimit = parseFloat(document.getElementById('limit').innerHTML);
    // let expenseSum = parseFloat(document.getElementById('spent').innerHTML);
    // let newExpense = parseFloat(document.getElementById('expense_value').value);

    // let sum = expenseSum + newExpense;
    // let diff = expenseLimit - (expenseSum + newExpense);

    // document.getElementById('balance').innerHTML = sum.toFixed(2);
    // document.getElementById('spentAndValueInput').innerHTML = diff.toFixed(2);

    // if (expenseLimit != 0){
    //     if (diff > 0) {
    //         $('.expenseLimit').css('color', 'green');
    //     }

    //     else if (diff < 0){
    //         $('.expenseLimit').css('color', 'red');
    //     }
    // }
};

const getSumOfExpensesForSelectedMonth = (id, date) => {
    fetch(`/api/expenses/${id}/${date}`)
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
    // const date = document.getElementById('expense_date').value;
    // console.log(date);
    // getSumOfExpensesForSelectedMonth(id, date);


    const date = new Date(document.getElementById('expense_date').value);
    const month = date.toLocaleString('en-us', { month: 'long' });;
    console.log(date);
    console.log(month);
    getSumOfExpensesForSelectedMonth(id, month);

    //calculateLimits();
    //renderOnDom();
}

//Zmiana kategorii

const checkCategory = (id) => {
    $('.limitSection').show();
    getLimitForCategory(id);
    checkLimit(id);
};

