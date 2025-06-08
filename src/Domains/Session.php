<?php namespace Lord\PosApp\Domains;

class Session {
  public int $user_id;
  public string $data;
  public ?\DateTime $created_at = null;
  public ?\DateTime $updated_at = null;
}
