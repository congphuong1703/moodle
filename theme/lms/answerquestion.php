<?php


require_once(__DIR__ . '/../../config.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = required_param('id', PARAM_INT);
    $content = required_param('content', PARAM_TEXT);

    global $PAGE, $OUTPUT, $DB, $USER, $CFG;

    $comment = (object)[
        "content" => $content,
        "userid" => $USER->id,
        "customdiscussionid" => $id,
        "createdat" => time()
    ];

    $inserted = $DB->insert_record('custom_comments', $comment);
    if ($inserted) {
        echo "<div class='alert alert-success' role='alert'>Trả lời thành công!</div>";
    } else {
        echo "<div class='alert alert-warning'>Lỗi khi trả lời!</div>";
    }
}