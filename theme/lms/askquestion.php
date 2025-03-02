<?php

namespace theme_lms;

use context_system;
use moodle_url;


require_once(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/../../question/renderer.php');
require_once(__DIR__ . '/../../question/engine/lib.php');

global $PAGE, $OUTPUT, $DB, $CFG;
// Thiết lập tiêu đề trang
$id = optional_param('id', null, PARAM_INT);
$PAGE->set_url(new moodle_url('/theme/lms/askquestion.php', ["id" => $id]));
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('standard'); // Hoặc 'admin', 'report' nếu cần
// Tiêu đề và breadcrumb
$PAGE->set_title('Hỏi bài');
$PAGE->set_heading('Trang Tùy Chỉnh');
//$PAGE->navbar->add('Trang Tùy Chỉnh', new moodle_url('/theme/lms/askquestion.php'))

// Kiểm tra quyền truy cập nếu cần
require_login(); // Yêu cầu người dùng đăng nhập
$discussions = $DB->get_records_sql("select d.id, d.userid,d.content, d.questionid, d.isanswer,
       DATE_FORMAT(d.createdat, '%d/%m/%Y %H:%i:%s') as createdat, concat(u.firstname, ' ', u.lastname) as fullname,
       q.name as questionname, q.qtype, q.questiontext, qz.id as quizid, qz.name as quizname
from {custom_discussions} d 
JOIN {user} u ON d.userid = u.id 
    join {question} q on q.id = d.questionid 
                      left JOIN {question_attempts} qatt ON q.id = qatt.questionid
                        left JOIN {question_usages} qu ON qatt.questionusageid = qu.id
                      left JOIN {quiz_attempts} qa ON qa.uniqueid = qu.id
                      left JOIN {quiz} qz on qz.id = qa.quiz
              where :idcheck is null or d.id = :id
              order by d.id desc", ["idcheck" => $id, "id" => $id]);
foreach ($discussions as $discussion) {
    $cm = get_coursemodule_from_instance('quiz', $discussion->quizid);
    $discussion->urlquiz = $CFG->wwwroot . '/mod/quiz/view.php?id=' . $cm->id;
}
$templatecontext = [
    'discussions' => array_values($discussions),
    'returnurl' => $PAGE->url->out_as_local_url(false)
];
if ($id) {
    echo $OUTPUT->render_from_template('theme_lms/askquestiondetail', $templatecontext);
} else {
    echo $OUTPUT->render_from_template('theme_lms/askquestion', $templatecontext);
}
echo $OUTPUT->header();
// Render template

echo $OUTPUT->footer();