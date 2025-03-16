window.onload = function () {
    if (window.jQuery) {
        const currentUrl = window.location.pathname;
        if (currentUrl.includes('mod/quiz/view.php')) {
            const ruleQuiz = jQuery('.customize-attempt-content').detach();
            jQuery('.customize-activity-dates').append(ruleQuiz);
        }
        jQuery(".ask-teacher-btn").click(function (event) {
            event.preventDefault(); // Ngăn reload trang
            document.getElementById('questionid').value = this.getAttribute('data-questionid')
        });
    } else {
        console.error("error load jquery");
    }
};
