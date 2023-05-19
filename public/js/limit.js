const getDate = document.getElementById('expense_date');
const getExpense = document.getElementById('expense_value');

let id = 0;
let limitValue = 0;
let spent = 0;
let expenseValue = 0;
let balance = 0;
let limitLeft = 0;


const hideLimitSection = () => {
    $('.limitSection').hide();
};

function isLimit() {
    id = this.options[this.selectedIndex].id;
    this.value == 1 ? showLimit() : hideLimitSection();
};

const showLimit = async () => {
    $('.limitSection').show(500);
    await calculateLimit();
    await renderOnDom();
}

const changeValues = async () => {
    await calculateLimit();
    await renderOnDom();
}

const calculateLimit = async () => {
    date = await getDate.value;
    limitValue = await getLimitForCategory();
    spent = await getSumOfExpensesForSelectedMonth();
    expenseValue = getExpense.value;
    if (expenseValue === null) {
        expenseValue = 0;
    }
    balance = limitValue - spent;
    limitLeft = balance - expenseValue;
};

const getLimitForCategory = async () => {
    try {
        const res = await fetch(`/api/limit/${id}`);
        const data = await res.json();
        return data['limit_value'];
    } catch (e) {
        console.log('ERROR: ', e);
    }
};

const getSumOfExpensesForSelectedMonth = async () => {
    try {
        const res = await fetch(`/api/expenses/${id}/${date}`);
        const data = await res.json();
        return data['expenseSum'];
    } catch (e) {
        console.log('ERROR: ', e);
    }
};

const renderOnDom = () => {
    document.getElementById('limit').innerHTML = limitValue + " zł";
    if (spent) {
        document.getElementById('spent').innerHTML = spent + " zł";
    } else {
        document.getElementById('spent').innerHTML = "0 zł";
    }
    document.getElementById('balance').innerHTML = balance + " zł";
    document.getElementById('spentAndValueInput').innerHTML = limitLeft + " zł";
}

document.getElementById('expense_cat').addEventListener('change', isLimit);
document.getElementById('expense_date').addEventListener('change', changeValues);
document.getElementById('expense_value').addEventListener('change', changeValues);
document.getElementById('expense_value').addEventListener('change', changeValues);