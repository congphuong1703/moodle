create table mdl_custom_discussions
(
    id         bigint auto_increment
        primary key,
    userid     bigint               not null,
    content    mediumtext           null,
    questionid bigint               not null,
    isanswer   tinyint(1) default 0 not null,
    createdat  timestamp            null,
    constraint mdl_custom_discussions_mdl_question_id_fk
        foreign key (questionid) references mdl_question (id),
    constraint mdl_custom_discussions_mdl_user_id_fk
        foreign key (userid) references mdl_user (id)
);


create table mdl_custom_comments
(
    id                 bigint auto_increment
        primary key,
    customdiscussionid bigint     not null,
    content            mediumtext not null,
    userid             bigint     not null,
    createdat          timestamp  null,
    constraint mdl_custom_comments_mdl_custom_discussions_id_fk
        foreign key (customdiscussionid) references mdl_custom_discussions (id),
    constraint mdl_custom_comments_mdl_user_id_fk
        foreign key (userid) references mdl_user (id)
);