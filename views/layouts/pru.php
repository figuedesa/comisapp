<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo Nav::widget([
    "items" => [
        [
            "label" => "Home",
            "url" => ["site/index"],
            "linkOptions" => [...],
        ],
        [
            "label" => "Dropdown",
            "items" => [
                ["label" => "Level 1 - Dropdown A", "url" => "#"],
                "<li class="divider"></li>",
                "<li class="dropdown-header">Dropdown Header</li>",
                ["label" => "Level 1 - Dropdown B", "url" => "#"],
            ],
        ],
    ],
    "options" => ["class" =>"navbar-nav"],
]);

