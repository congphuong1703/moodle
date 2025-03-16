<?php

namespace theme_lms;


require_once(__DIR__ . '/../../config.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $questionid = required_param('questionid', PARAM_INT);
    $content = required_param('content', PARAM_TEXT);
    $next = optional_param('next', 'http://localhost/moodle', PARAM_TEXT);

    global $DB, $USER;

    $discussion = (object)array(
        "content" => $content,
        "userid" => $USER->id,
        "questionid" => $questionid,
        "isanswer" => 0,
        "createdat" => date('Y-m-d H:i:s')
    );


    $inserted = $DB->insert_record('custom_discussions', $discussion);
    redirect($next, $inserted ? "Trả lời thành công!" : "Lỗi khi trả lời!", null, $inserted ? \core\output\notification::NOTIFY_SUCCESS : \core\output\notification::NOTIFY_ERROR);
}

