document.getElementById('expense_cat').addEventListener('change', isLimit);

const date = document.getElementById('expense_date').value;

let getExpenseValue = 0;

const hideLimitSection = () => {
    $('.limitSection').hide();
};

function isLimit() {
    const id = this.options[this.selectedIndex].id;
    this.value == 1 ? checkCategory(id) : hideLimitSection();
};

const checkCategory = (id) => {
    $('.limitSection').show(500);
    // getLimitForCategory(id);
    renderOnDom(id, date);
    // checkLimit(id);
};

const getLimitForCategory = async (id) => {
    try {
        const res = await fetch(`/api/limit/${id}`);
        const data = await res.json();
        return data['limit_value'];
    } catch (e) {
        console.log('ERROR: ', e);
    }
};

const getSumOfExpensesForSelectedMonth = async (id, date) => {
    try {
        const res = await fetch(`/api/expenses/${id}/${date}`);
        const data = await res.json();
        return data['expenseSum'];
    } catch (e) {
        console.log('ERROR: ', e);
    }
};


// const checkLimit = (id) => {
//     console.log(date);
//     //getSumOfExpensesForSelectedMonth(id, date);


//     // const date = new Date(document.getElementById('expense_date').value);
//     // const month = date.toLocaleString('en-us', { month: 'long' });;
//     // console.log(date);
//     // console.log(month);
//     // getSumOfExpensesForSelectedMonth(id, month);

//     //calculateLimits();
//     renderOnDom(id, date);
// }

function getValue() {
    getExpenseValue = document.getElementById('expense_value').value;
    console.log(getExpenseValue);
};

function getDate() {
    getDateValue = document.getElementById('expense_date').value;
    console.log(getDateValue);
};

// REST API
const renderOnDom = async (id, date) => {
    //getValue();
    //getDate();
    let limit = await getLimitForCategory(id);
    let spent = await getSumOfExpensesForSelectedMonth(id, date);
    let balance = limit - spent;
    let limitLeft = balance - getExpenseValue;
    document.getElementById('limit').innerHTML = limit + " zł";
    document.getElementById('spent').innerHTML = spent + " zł";
    document.getElementById('balance').innerHTML = balance + " zł";
    document.getElementById('spentAndValueInput').innerHTML = limitLeft + " zł";
};

const calculateLimits = () => {
    // getValue();

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

// const getSumOfExpensesForSelectedMonth = (id, date) => {
//     fetch(`/api/expenses/${id}/${date}`)
//         .then(response => response.json())
//         .then(data => {
//             let spentValue = data.expenseSum;
//             document.getElementById("spent").innerHTML = spentValue
//         })
//         .catch(error => (console.error('Error:', error)));
// };

// const getLimitForCategory = (id) => {
//     fetch(`/api/limit/${id}`)
//         .then(response => response.json())
//         .then(data => {
//             let limitValue = data.limit_value;
//             document.getElementById("limit").innerHTML = limitValue
//         })
//         .catch(error => (console.error('Error:', error)));
// };




//Zmiana daty

//Zmiana kategorii
document.getElementById('expense_value').addEventListener('change', renderOnDom);
document.getElementById('expense_date').addEventListener('change', renderOnDom);


