<?php

class ControllerUsers
{

  /** ============
   *   USER LOGIN
   *  ============
   */
  static public function ctrUserLogin()
  {
    if (
      !empty($_POST['loginUser'])
      && $loginUser = $_POST['loginUser']
      && !empty($_POST['loginPass'])
    ) {
      if (
        /**
         * Match only numbers and letters on User Login.
         */
        preg_match('/^[a-zA-Z0-9]+$/', $loginUser)
        /**
         * Password Rules
         *
         * 1. At least one uppercase letter.
         * 2. At least one special char from this group:!@#$&*
         * 3. At least one number
         * 4. At least one lowercase letter
         * 5. Password length from 8 till 16 characters.
         */
        && preg_match(
          '/^(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z]).{8,16}$/',
          $_POST['loginPass']
        )
      ) {
        $table = 'users';
        $item = 'user';
        $value = $_POST['loginUser'];

        $response = UsersModel::MdlShowUsers($table, $item, $value);

        if (
          !empty($response)
          && $response['user'] === $value
          && $response['password'] === $_POST['loginPass']
        ) {
          echo '<br/><div class="alert alert-success">Bem-vindo ao sistema.</div>';
          $_SESSION['posStartSes'] = 'ok';
          echo '<script>window.location = "home";</script>';
        } else {
          echo '<br/><div class="alert alert-danger">Não foi possível completar o login. Por favor verifique seus dados.</div>';
        }
      }
    }
  }
}
