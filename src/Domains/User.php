<?php namespace Lord\PosApp\Domains;

class User {
  // public string $id;
  public string $name;
  public string $email;
  public string $password;
  public string $role;
  public ?\DateTime $created_at = null;
  public ?\DateTime $updated_at = null;
}
