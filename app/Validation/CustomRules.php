<?php
namespace App\Validation;

use Config\Database;

class CustomRules{

  public function not_self_unique(string $str = null, string $field = null, array $data = null)
  {
	return true;
  }
}