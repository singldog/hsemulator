<?php

/**
 * @name 4月6日总体测试
 */

$elv = new \app\data\cards\Elven_archer;
$elv2 = new \app\data\cards\Elven_archer;
$deck = new \app\game\basis\Deck;
$deck->addCard($elv);
$deck->addCard($elv2);
$board = new \app\game\basis\Board;
$hand = new \app\game\basis\Hand;
$hero = new \app\game\basis\Hero('Jaina Proudmore', 'xxxxx', v(0), v(30), null);
$player = new \app\game\basis\Player('测试员1号', $hero, $board, $hand, $deck);

$player->drawARandomCard();
$player->drawARandomCard();

dd($player->exportData());