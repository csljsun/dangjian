<?php

namespace Home\Behavior;

class AuthCheckBehavior {
    public function run(&$return) {
        if (C(USER_AUTH_ON)) {
            return true;
        } else {
            return false;
        }
    }
}