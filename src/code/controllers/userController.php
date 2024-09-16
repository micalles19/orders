<?php
require_once __DIR__ . '/../app.php';

header("Content-Type: application/json; charset=utf-8");

$response = (object)[];

$method = $_SERVER['REQUEST_METHOD'];

$input = json_decode(file_get_contents('php://input'));

if ($method == 'GET') $input = (object)$_GET;

if ($method == 'POST' && !empty($_POST)) $input = (object)$_POST;

switch ($input->action) {
    case 'authenticate':
        $username = $input->username;
        $password = isset($input->password) && !empty($input->password) ? md5(base64_decode($input->password)) : null;

        $user = new User(null, $username, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

        $response = $user->authenticate($password);
        break;
    case "changePassword":
        $currentPassword = md5(base64_decode($input->currentPassword));
        $newPassword = md5(base64_decode($input->newPassword));
        $requestScreen = $input->requestScreen;
        $startSession = boolval($input->startSession);
        $recoveryRequestId = $input->recoveryRequestId;

        $id = isset($input->id) && !empty($input->id) ? base64_decode($input->id) : 0;
        $username = isset($input->username) && !empty($input->username) ? $input->username : null;

        $user = new User($id, $username, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

        $response = $user->changePassword($currentPassword, $newPassword, $requestScreen, $recoveryRequestId);

        if ($response->status == 200 && $response->message == 'success' && $startSession) {
            $response = $user->authenticate($newPassword);
        }
        break;
    case 'checkUsernameAvailability':
        $username = $input->username;
        $id = isset($input->id) && !empty($input->id) ? base64_decode($input->id) : 0;

        $response = User::checkUsernameAvailability($id, $username);
        break;
    case 'getAll':
        $statusCode = isset($input->statusCode) && !empty($input->statusCode) ? $input->statusCode : null;

        $response = User::getAll($statusCode);
        break;
    case 'logout':
        if (App::isLogged()) {
            $userId = App::getUserId();

            $user = new User($userId, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

            $response = $user->logout();
        } else {
            $response->status = 200;
            $response->message = 'success';
            $response->data = (object)[
                'id' => 0
            ];
        }
        break;
    case 'save':
        $id = isset($input->id) && !empty($input->id) ? base64_decode($input->id) : 0;
        $username = isset($input->username) && !empty($input->username) ? $input->username : null;
        $firstname = isset($input->firstname) && !empty($input->firstname) ? $input->firstname : null;
        $lastname = isset($input->lastname) && !empty($input->lastname) ? $input->lastname : null;
        $email = isset($input->email) && !empty($input->email) ? $input->email : null;
        $userPhotoFilename = isset($input->userPhotoFilename) && !empty($input->userPhotoFilename) ? $input->userPhotoFilename : null;
        $password = isset($input->password) && !empty($input->password) ? md5(base64_decode($input->password)) : null;
        $roleId = isset($input->roleId) && !empty($input->roleId) ? $input->roleId : 0;

        $user = new User($id, $username, $email, $firstname, $lastname, $userPhotoFilename, null, null, null, null, null, null, null, null, null, null, $roleId);

        $response = $user->save($password);
        break;
    case 'delete':
        $id = isset($input->id) && !empty($input->id) ? base64_decode($input->id) : 0;

        $user = new User($id, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

        $response = $user->delete();
        break;
    case 'lockUnlock':
        $id = isset($input->id) ? intval(base64_decode($input->id)) : 0;
        $newStatus = isset($input->newStatus) ? intval($input->newStatus) : 0;

        $user = new User($id, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

        $response = $user->lockUnlock($newStatus);
        break;
    case 'createTemporalPassword':
        $id = isset($input->id) ? intval(base64_decode($input->id)) : 0;
        $username = isset($input->username) ? $input->username : null;
        $email = isset($input->email) ? $input->email : null;

        $user = new User($id, $username, $email, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

        $response = $user->createTemporalPassword();
        break;
    case 'updateEmail':
        $id = isset($input->id) ? intval(base64_decode($input->id)) : 0;
        $email = isset($input->email) ? $input->email : null;
        $password = isset($input->password) ? md5(base64_decode($input->password)) : null;

        $user = new User($id, null, $email, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

        $response = $user->updateEmail($password);

        if ($response->status == 200 && $response->message == 'success') {
            if ($user->id == App::getUserId()) {
                $_SESSION[SESSION_INDEX]->email = $email;
            }
        }
        break;
    case 'updatePhoto':
        // $response->status = 500;
        // $response->test = $input;
        // break;
        $id = isset($input->id) ? intval(base64_decode($input->id)) : 0;

        $user = new User($id, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
        $userPhotoFilename = $input->userPhotoFilename;

        $ext = pathinfo($userPhotoFilename, PATHINFO_EXTENSION);
        $newFilename = 'u_' . str_pad($user->id, 3, '0', STR_PAD_LEFT) . '.' . $ext;

        if ($userPhotoFilename == 'default.png') {
            $newFilename = 'default.png';
        }

        $response = $user->updatePhoto($newFilename);

        if ($response->status == 200 && $response->message == 'success') {
            if (isset($_FILES['userPhotoFile'])) {
                $path = __DIR__ . '/../../assets/media/avatars/';

                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                file_exists($path . $newFilename) && unlink($path . $newFilename);

                move_uploaded_file($_FILES['userPhotoFile']['tmp_name'], $path . $newFilename);
            }
            App::isLogged() && $_SESSION[SESSION_INDEX]->userPhotoFilename = $newFilename;
        }
        break;
    default:
        $response->status = 404;
        $response->message = 'Action not found';
        break;
}

sendResponse($response);
