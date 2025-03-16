<?php

namespace theme_lms;


require_once(__DIR__ . '/../../config.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = required_param('id', PARAM_INT);
    $content = required_param('content', PARAM_TEXT);
    $next = optional_param('next', 'http://localhost/moodle', PARAM_TEXT);

    global $DB, $USER;

    $comment = (object)array(
        "content" => $content,
        "userid" => $USER->id,
        "customdiscussionid" => $id,
        "createdat" => date('Y-m-d H:i:s')
    );

    $discussion = $DB->get_record('custom_discussions', ['id' => $id]);
    if (!empty($discussion)) {
        $discussion->isanswer = 1;
        $DB->update_record('custom_discussions', $discussion);
    }
    $inserted = $DB->insert_record('custom_comments', $comment);
    if ($inserted) {
        echo "<div class='alert alert-success' role='alert'>Trả lời thành công!</div>";
    } else {
        echo "<div class='alert alert-warning'>Lỗi khi trả lời!</div>";
    }
}

redirect($next);
