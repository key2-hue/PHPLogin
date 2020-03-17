<?php

namespace MyApp;

class Controller {
  protected function afterLogin() {
    return isset($_SESSION['user']) && !empty($_SESSION['user']);
  }
}