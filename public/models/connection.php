<?php

/**
 *
 */
class Connection {

  /**
   * ================
   *  DB Connection.
   * ================
   */
  public static function connect() {

    $link = new PDO("mysql:host=database;dbname=lamp", "lamp", "lamp");

    $link->exec("set names utf8");

    return $link;
  }

}
