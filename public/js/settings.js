$(document).ready(function () {
    $(".changeIncomeForm").hide();
    $(".editIncomeCategoryButton").click(function () {
        $(".addIncomeCategoryForm:visible").slideUp(300);
        $(".changeIncomeForm:visible").not($(this).closest(".editIncomeCategory").find("form")).slideUp(300);
        $(this).closest(".editIncomeCategory").find("form").slideToggle(300);
    });
});

$(document).ready(function () {
    $(".addIncomeCategoryForm").hide();
    $(".addIncomeCategoryButton").click(function () {
        $(".changeIncomeForm:visible").slideUp(300);
        $(this).closest(".addIncomeCategory").find("form").slideToggle(300);
    });
});

$(document).ready(function () {
    $(".changeExpenseForm").hide();
    $(".editExpenseCategoryButton").click(function () {
        $(".addExpenseCategoryForm:visible").slideUp(300);
        $(".changeExpenseForm:visible").not($(this).closest(".editExpenseCategory").find("form")).slideUp(300);
        $(this).closest(".editExpenseCategory").find("form").slideToggle(300);
    });
});

$(document).ready(function () {
    $(".addExpenseCategoryForm").hide();
    $(".addExpenseCategoryButton").click(function () {
        $(".changeExpenseForm:visible").slideUp(300);
        $(this).closest(".addExpenseCategory").find("form").slideToggle(300);
    });
});

$(document).ready(function () {
    $(".changePaymentForm").hide();
    $(".editPaymentMethodButton").click(function () {
        $(".addPaymentMethodForm:visible").slideUp(300);
        $(".changePaymentForm:visible").not($(this).closest(".editPaymentMethods").find("form")).slideUp(300);
        $(this).closest(".editPaymentMethods").find("form").slideToggle(300);
    });
});

$(document).ready(function () {
    $(".addPaymentMethodForm").hide();
    $(".addPaymentMethodButton").click(function () {
        $(".changePaymentForm:visible").slideUp(300);
        $(this).closest(".addPaymentMethod").find("form").slideToggle(300);
    });
});

$(function () {
    $('.checkLimit').change(function () {
        if ($(this).is(':checked')) {
            $(".limitValue").prop('disabled', false);
        } else {
            $(".limitValue").prop('disabled', true);
        }
    });
});
