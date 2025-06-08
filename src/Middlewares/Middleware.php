<?php namespace Lord\PosApp\Middlewares;

interface Middleware {
  function before(): void;
}
