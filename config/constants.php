<?php


if (!defined('ROLE_ADMIN')) define('ROLE_ADMIN', 1);
if (!defined('ROLE_REVIEWER')) define('ROLE_REVIEWER', 2);
if (!defined('ROLE_USER')) define('ROLE_USER', 3);

// Article status
if (!defined('ARTICLE_DRAFT')) define('ARTICLE_DRAFT', 0);
if (!defined('ARTICLE_CREATED')) define('ARTICLE_CREATED', 1);
if (!defined('ARTICLE_WAITING_REVIEW')) define('ARTICLE_WAITING_REVIEW', 2);
if (!defined('ARTICLE_ACCEPTED')) define('ARTICLE_ACCEPTED', 3);
if (!defined('ARTICLE_DENIED')) define('ARTICLE_DENIED', 9);

// Review status
if (!defined('REVIEW_ACCEPTED')) define('REVIEW_ACCEPTED', 0);
if (!defined('REVIEW_ACCEPTED_REWRITE')) define('REVIEW_ACCEPTED_REWRITE', 1);
if (!defined('REVIEW_ACCEPTED_EDIT')) define('REVIEW_ACCEPTED_EDIT', 2);
if (!defined('REVIEW_DENIED')) define('REVIEW_DENIED', 9);