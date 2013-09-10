<?php
return array (
  'user' => 
  array (
    'type' => 2,
    'description' => 'Пользователь системы',
    'bizRule' => '',
    'data' => '',
    'assignments' => 
    array (
      2 => 
      array (
        'bizRule' => NULL,
        'data' => NULL,
      ),
    ),
  ),
  'admin' => 
  array (
    'type' => 2,
    'description' => 'Администратор',
    'bizRule' => '',
    'data' => '',
    'children' => 
    array (
      0 => 'user',
    ),
  ),
);
