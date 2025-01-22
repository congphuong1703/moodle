window.onload = function () {
    if (window.jQuery) {
        const ruleQuiz = jQuery('.customize-attempt-content').detach();
        jQuery('.activity-information').append(ruleQuiz);
    } else {
        console.error("error load jquery");
    }
};
