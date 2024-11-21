<?php

namespace App\Repository;

interface OtpRepositoryInterface extends RepositoryInterface
{

    public function generate($email, $tokenize = false);

    public function check($email, $code, $token = null);

    public function verify($email, $token = null);

    public function remove($email);

}
