<?php
    require_once "user.php";
    require_once "curl.php";
    require_once "lead.php";
    require_once "task.php";

    $user = [
        'client_id' => '3757917f-6c87-438b-88a7-3846b759ce0e',
        'client_secret' => 'oGbUPxmknXka3HcQkrH7BCI0fXPARrKGqQ81ex809Ov16bH9xh26qW099YTEXrLb',
        'grant_type' => 'authorization_code',
        'code' => 'def502008ca6369e1b1f7677bbdd21ebf6ea3fde62d3284a21989f6434a73fad0436aeae1f8eb6aca9899a3b03f2e98f8ed7b7c7661cf07591cd344f3ad85fd107400b089ecd807326df6446ad6ae7fdad7a3aab67a7dc5976f43fad49f697f87f9463242d492b67b896a5ca3019e335c66393bcbe184a2697bf95aca7cecfaa5034ce0dedd188912ce48402e0920b6d0ea587cf148e68a9fb45d714e387063c9bc0c533c19ad93a040a0c637649f857a055431235b2209912eadae0e0481f298dd877a4836c350093de5e753454e6747368957171bdd6b159f71a51d5a36c21d5f0defb7f655af62fbc7ecb8b277a87554f66b705506f60a086f370ec4c7b22a78de90aee4850546ca22c1ef427dddcda2f68cd2c5813ffde4f48aa6d763f6839a56df88fa9ee60dea8cf64bc697f4f31b920f844dd92e7f9d372c0654811f5adf6945af8a0fcda2cc260d9529e7a048b11c9f0b61f39bc3f9ff9c9999dc0db0c2ca60d6640d3b9e263c732f435c7528fc4278e0e3956151760f2e289326b7814df3d15fe9adf89b414a7063cd7bac364ad96ce55f0eb37df99e93b5b79c7b69e35f450c8e821017dc483a3d1809feaefba8197af7222113ec63007e39928332c493653a9369f20603aff',
        'redirect_uri' => 'https://vitalypark555.amocrm.ru/',
    ];

    $subdomain = 'vitalypark555';
//    $response = User::getAccessToken($subdomain, $user);
//    $accessToken = $response['access_token']; получил токен и поместил его в curl.php

    $task = new Task($subdomain);
    $lead = new Lead($subdomain);

    $leads = $lead->getLeadsWithoutTasks();

    foreach($leads as $lead) {
        $task->addTaskToLead(intval($lead['id']), "Сделка без задачи", 1594224000);
    }

    $tasks = $task->getAllTasks();

    foreach($tasks as $task) {
        print_r($task);
        print('<br>');
    }
