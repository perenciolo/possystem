<?php

class ControllerUsers
{

    /**
     * ============
     *   USER LOGIN
     * =============
     */
    public static function ctrUserLogin()
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
                $encrypt = crypt($_POST['loginPass'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $response = UsersModel::mdlShowUsers($table, $item, $value);

                if (
                    !empty($response)
                    && $response['user'] === $value
                    && $response['password'] === $encrypt
                ) {
                    echo '<br/>
                    <div class="alert alert-success">
                        Bem-vindo ao sistema.
                    </div>';

                    $_SESSION['posStartSes'] = 'ok';
                    $_SESSION['id'] = $response['id'];
                    $_SESSION['name'] = $response['name'];
                    $_SESSION['user'] = $response['user'];
                    $_SESSION['user'] = $response['user'];
                    $_SESSION['photo'] = $response['photo'];
                    $_SESSION['profile'] = $response['profile'];

                    echo '<script>window.location = "home";</script>';
                } else {
                    echo '<br/>
                    <div class="alert alert-danger">
                    Não foi possível completar o login. Por favor verifique seus dados.
                    </div>';
                }
            }
        }
    }

    /**
     * ===============
     *  USER REGISTER
     * ===============
     */
    public static function ctrCreateUser()
    {

        if (
            !empty($_POST['newUser'])
            && !empty($_POST['newName'])
            && !empty($_POST['newPassword'])
            && !empty($_POST['newProfile'])
        ) {
            $newUser = $_POST['newUser'];
            $newName = $_POST['newName'];
            $newPassword = $_POST['newPassword'];
            $newProfile = $_POST['newProfile'];

            if (
                preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚçÇ ]+$/', $newName)
                && preg_match('/^[a-zA-Z0-9]+$/', $newUser)
                && preg_match('/^(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z]).{8,16}$/', $newPassword)
            ) {
                /**
                 * Validate User Picture.
                 */
                $route = '';

                if (!empty($_FILES['newPicture']['tmp_name'])) {
                    $picture = $_FILES['newPicture'];

                    list($width, $height) = getimagesize($_FILES['newPicture']['tmp_name']);

                    $fixWidth = 500;
                    $fixHeight = 500;

                    // Create picture file dir.
                    $dir = 'views/img/users/' . $newUser;
                    if (!file_exists($dir) || !is_dir($dir)) {
                        mkdir($dir, 0755);
                    }

                    if ($picture['type'] === 'image/jpeg' || $picture['type'] === 'image/jpg' || $picture['type'] === 'image/png') {
                        $ext = explode('/', $picture['type'])[1];
                        // Save image in dir.
                        $now = time();
                        $route = "{$dir}/arq_{$newUser}_{$now}.{$ext}";

                        if ($ext === 'jpeg' || $ext === 'jpg') {
                            $source = imagecreatefromjpeg($picture['tmp_name']);
                            $destiny = imagecreatetruecolor($width, $height);
                            imagecopyresized($destiny, $source, 0, 0, 0, 0, $fixWidth, $fixHeight, $width, $height);
                            imagejpeg($destiny, $route);
                        } elseif ($ext === 'png') {
                            $source = imagecreatefrompng($picture['tmp_name']);
                            $destiny = imagecreatetruecolor($width, $height);
                            imagecopyresized($destiny, $source, 0, 0, 0, 0, $fixWidth, $fixHeight, $width, $height);
                            imagepng($destiny, $route);
                        }
                    }
                }

                $table = 'users';

                $encrypt = crypt($newPassword, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $data = [
                    'name' => $newName,
                    'user' => $newUser,
                    'password' => $encrypt,
                    'profile' => $newProfile,
                    'photo' => $route,
                ];

                $response = UsersModel::mdlAddUser($table, $data);

                if ($response) {
                    echo '<script>
                    swal({
                        type: "success",
                        title: "User created successfully.",
                        showConfirmButton: true,
                        confirmButtonText: "Close",
                        closeOnConfirm: false
                    }).then(result=>{
                        if (result && result.value) {
                            window.location = "users";
                        }
                    });
                </script>';
                }
            } else {
                echo '<script>
                    swal({
                        type: "error",
                        title: "User could not have special chars.",
                        showConfirmButton: true,
                        confirmButtonText: "Close",
                        closeOnConfirm: false
                    }).then(result=>{
                        if (result && result.value) {
                            window.location = "users";
                        }
                    });
                </script>';
            }
        }
    }

    public static function ctrShowUsers(string $item = '', string $value = '')
    {
        $table = 'users';

        return UsersModel::mdlShowUsers($table, $item, $value);
    }
}
