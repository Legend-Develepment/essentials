<?php

/*
 * Making an account, which is the one form a stranger can reach.
 *
 * Four strings. Everything else on the page is Filament's own and is already
 * translated by it - the email field, the password field, the confirmation and
 * the button all come from filament-panels.
 */

return [
    'title' => '创建一个账号',
    'heading' => '创建一个账号',

    'username' => '用户名',
    'username_helper' => '字母、数字，以及夹在它们中间的 . _ 或 -。至少三个字符。这是面板用来称呼你的名字，之后在这里改不了。',
    'username_rule' => '用户名可以包含字母、数字，以及夹在它们中间的 . _ 或 -，并且必须以字母或数字开头。',
];
