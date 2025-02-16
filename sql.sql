create table mdl_custom_discussions
(
    id          bigint auto_increment
        primary key,
    user_id     bigint               not null,
    content     mediumtext           null,
    question_id bigint               not null,
    is_answer   tinyint(1) default 0 not null,
    created_at  timestamp            null,
    constraint mdl_custom_discussions_mdl_question_id_fk
        foreign key (question_id) references mdl_question (id),
    constraint mdl_custom_discussions_mdl_user_id_fk
        foreign key (user_id) references mdl_user (id)
);

create table mdl_custom_comments
(
    id                   bigint auto_increment
        primary key,
    custom_discussion_id bigint     not null,
    content              mediumtext not null,
    user_id              bigint     not null,
    created_at           timestamp  null,
    constraint mdl_custom_comments_mdl_custom_discussions_id_fk
        foreign key (custom_discussion_id) references mdl_custom_discussions (id),
    constraint mdl_custom_comments_mdl_user_id_fk
        foreign key (user_id) references mdl_user (id)
);

