window.onload = function () {
    if (window.jQuery) {
        const currentUrl = window.location.pathname;
        if (currentUrl.includes('mod/quiz/view.php')) {
            const ruleQuiz = jQuery('.customize-attempt-content').detach();
            jQuery('.customize-activity-dates').append(ruleQuiz);
        }
        jQuery("#answerquestion").submit(function (event) {
            event.preventDefault(); // Ngăn reload trang
            const content = jQuery("#content").val()
            const id = jQuery("#id").val()
            console.log(content, id)
            const wwwroot = jQuery(this).data("url")
            jQuery.ajax({
                type: "POST",
                url: `answerquestion.php`, // File PHP xử lý
                data: {
                    content: content,
                    id: id
                },
                success: function (response) {
                    $('#myModal').modal('hide');
                    jQuery("#resultMessage").html(response);
                    jQuery("#answerquestion")[0].reset(); // Reset form sau khi lưu
                },
                error: function () {
                    jQuery("#resultMessage").html("<div class='alert alert-warning'>Lỗi khi trả lời!</div>");
                }
            });
        });
    } else {
        console.error("error load jquery");
    }
};
