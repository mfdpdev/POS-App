<?php

function getDatabaseConfig(): array
{
  return [
    "database" => [
      "dev" => [
        "url" => "pgsql:host=localhost;port=5432;dbname=pos_app_db",
        "username" => "postgres",
        "password" => "",
      ],
      "prod" => [
        "url" => "pgsql:host=localhost;port=5432;dbname=pos_app_db",
        "username" => "postgres",
        "password" => "",
      ],
    ]
  ];
}
