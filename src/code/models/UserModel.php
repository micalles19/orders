<?php
class User
{
    public $id;
    public $username;
    public $email;
    public $firstname;
    public $lastname;
    public $userPhotoFilename;
    public $passwordExpirationDate;
    public $isFirstLogin;
    public $passwordChangeRequested;
    public $loginAttemptsRemaining;
    public $isLocked;
    public $firstLogin;
    public $lastLogin;
    public $createdAt;
    public $updatedAt;
    public $statusCode;
    public $roleId;
    public $roleName;

    public function __construct($id, $username, $email, $firstname, $lastname, $userPhotoFilename, $passwordExpirationDate, $isFirstLogin, $passwordChangeRequested, $loginAttemptsRemaining, $isLocked, $firstLogin, $lastLogin, $createdAt, $updatedAt, $statusCode, $roleId = null, $roleName = null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->userPhotoFilename = $userPhotoFilename;
        $this->passwordExpirationDate = $passwordExpirationDate;
        $this->isFirstLogin = $isFirstLogin;
        $this->passwordChangeRequested = $passwordChangeRequested;
        $this->loginAttemptsRemaining = $loginAttemptsRemaining;
        $this->isLocked = $isLocked;
        $this->firstLogin = $firstLogin;
        $this->lastLogin = $lastLogin;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->statusCode = $statusCode;
        $this->roleId = $roleId;
        $this->roleName = $roleName;
    }

    public function authenticate($password, $connection = null)
    {
        try {
            if (empty($connection)) $connection = getConnection();

            $query = "CALL userAuthenticate(:username,:email,:password,@response,@id,@remainingAttempts);";
            $stmt = $connection->getConnection()->prepare($query);
            $stmt->bindParam(':username', $this->username, PDO::PARAM_STR);
            $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->execute();

            $stmt->closeCursor();

            $data = $connection->getConnection()->query("SELECT @response response,@id id,@remainingAttempts remainingAttempts")->fetch(PDO::FETCH_OBJ);

            $message = $data->response;

            if ($message != "success") {
                return (object)[
                    'status' => 200,
                    'message' => $message,
                    'remainingAttempts' => $data->{"remainingAttempts"},
                ];
            }

            $this->id = $data->id;

            $requestData = User::getById($this->id, $connection);

            if ($requestData->status != 200) return $requestData;

            foreach ($requestData->user as $key => $value) {
                $this->$key = $value;
            }

            // $this->username = $requestData->user->username;
            // $this->email = $requestData->user->email;
            // $this->firstname = $requestData->user->firstname;
            // $this->lastname = $requestData->user->lastname;
            // $this->userPhotoFilename = $requestData->user->userPhotoFilename;
            // $this->passwordExpirationDate = $requestData->user->passwordExpirationDate;
            // $this->isFirstLogin = $requestData->user->isFirstLogin;
            // $this->passwordChangeRequested = $requestData->user->passwordChangeRequested;
            // $this->loginAttemptsRemaining = $requestData->user->loginAttemptsRemaining;
            // $this->isLocked = $requestData->user->isLocked;
            // $this->firstLogin = $requestData->user->firstLogin;
            // $this->lastLogin = $requestData->user->lastLogin;
            // $this->createdAt = $requestData->user->createdAt;
            // $this->updatedAt = $requestData->user->updatedAt;
            // $this->statusCode = $requestData->user->statusCode;

            return $this->startSession($connection);
        } catch (PDOException $e) {
            return (object)[
                'status' => 500,
                'message' => $e->getMessage()
            ];
        } catch (Exception $e) {
            return (object)[
                'status' => 500,
                'message' => $e->getMessage()
            ];
        }
    }

    private function startSession($connection = null)
    {
        try {
            $loginId = 0;
            $lastSessionId = 0;

            $clientAgent = getClientAgent();

            if (session_status() == PHP_SESSION_NONE) session_start();

            $currentSessionId = session_id();

            $query = "CALL saveUserLogin(:id,:sessionId,:client,@dbResponse,@dbLoginId,@dbLastSessionId);";
            $stmt = $connection->getConnection()->prepare($query);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $stmt->bindParam(':sessionId', $currentSessionId, PDO::PARAM_STR);
            $stmt->bindParam(':client', $clientAgent, PDO::PARAM_STR);
            $stmt->execute();

            $stmt->closeCursor();

            $data = $connection->getConnection()->query("SELECT @dbResponse response,@dbLoginId loginId,@dbLastSessionId lastSessionId")->fetch(PDO::FETCH_OBJ);

            if ($data->response == 'success') {
                $_SESSION[SESSION_INDEX] = $this;
                $_SESSION[SESSION_INDEX]->loginId = $data->loginId;
                $_SESSION[SESSION_INDEX]->isActive = true;
            }

            return (object)[
                'status' => 200,
                'message' => 'success',
                'data' => (object)[
                    'id' => $this->id,
                    'name' => $this->firstname . ' ' . $this->lastname,
                ]
            ];
        } catch (PDOException $e) {
            return (object)[
                'status' => 500,
                'message' => $e->getMessage()
            ];
        } catch (Exception $e) {
            return (object)[
                'status' => 500,
                'message' => $e->getMessage()
            ];
        }
    }

    public function changePassword($currentPassword, $newPassword, $requestScreen, $recoveryRequestId, $connection = null)
    {
        try {
            if (empty($connection)) $connection = getConnection();

            $clientAgent = getClientAgent();

            $query = "CALL saveUserPasswordChange(:id,:username,:requestId,:currentPassword,:newPassword,:requestScreen,:client,@response);";
            $stmt = $connection->getConnection()->prepare($query);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $stmt->bindParam(':username', $this->username, PDO::PARAM_STR);
            $stmt->bindParam(':requestId', $recoveryRequestId, PDO::PARAM_INT);
            $stmt->bindParam(':currentPassword', $currentPassword, PDO::PARAM_STR);
            $stmt->bindParam(':newPassword', $newPassword, PDO::PARAM_STR);
            $stmt->bindParam(':requestScreen', $requestScreen, PDO::PARAM_STR);
            $stmt->bindParam(':client', $clientAgent, PDO::PARAM_STR);
            $stmt->execute();

            $stmt->closeCursor();

            $data = $connection->getConnection()->query("SELECT @response response")->fetch(PDO::FETCH_OBJ);

            return (object)[
                'status' => 200,
                'message' => $data->response,
            ];
        } catch (PDOException $e) {
            return (object)[
                'status' => 500,
                'message' => $e->getMessage()
            ];
        } catch (Exception $e) {
            return (object)[
                'status' => 500,
                'message' => $e->getMessage()
            ];
        }
    }

    public static function getById($id, $connection = null)
    {
        try {
            if (empty($connection)) $connection = getConnection();

            $query = "CALL getUserById(:id);";

            $stmt = $connection->getConnection()->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_OBJ);
            $user = new User(
                $data->id,
                $data->username,
                $data->email,
                $data->firstname,
                $data->lastname,
                $data->userPhotoFilename,
                $data->passwordExpirationDate,
                $data->isFirstLogin,
                $data->passwordChangeRequested,
                $data->loginAttemptsRemaining,
                $data->isLocked,
                $data->firstLogin,
                $data->lastLogin,
                $data->createdAt,
                $data->updatedAt,
                $data->statusCode,
                $data->roleId,
                $data->roleName
            );

            return (object)[
                'status' => 200,
                'message' => 'success',
                'user' => $user
            ];
        } catch (PDOException $e) {
            return (object)[
                'status' => 500,
                'message' => $e->getMessage()
            ];
        } catch (Exception $e) {
            return (object)[
                'status' => 500,
                'message' => $e->getMessage()
            ];
        }
    }

    public function logout($connection = null): object
    {
        try {
            if (empty($connection)) $connection = getConnection();

            $query = "CALL userLogout(:id,:signInId,@dbResponse);";
            $stmt = $connection->getConnection()->prepare($query);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $stmt->bindParam(':signInId', $_SESSION[SESSION_INDEX]->loginId, PDO::PARAM_INT);

            $stmt->execute();

            $stmt->closeCursor();

            $select = $connection->getConnection()->query('SELECT @dbResponse')->fetch(PDO::FETCH_OBJ);

            $response = $select->{"@dbResponse"};

            if ($response == 'success') {
                unset($_SESSION[SESSION_INDEX]);
            }

            return (object)[
                'status' => 200,
                'message' => $response,
                'data' => (object)[
                    'id' => $this->id
                ]
            ];
        } catch (PDOException $e) {
            return (object)[
                'status' => 500,
                'message' => $e->getMessage()
            ];
        } catch (Exception $e) {
            return (object)[
                'status' => 500,
                'message' => $e->getMessage()
            ];
        }
    }

    public static function getAll($statusCode, $connection = null)
    {
        try {
            if (empty($connection)) $connection = getConnection();

            $query = "CALL getAllUsers(:statusCode);";

            $stmt = $connection->getConnection()->prepare($query);
            $stmt->bindParam(':statusCode', $statusCode, PDO::PARAM_STR);
            $stmt->execute();

            $users = $stmt->fetchAll(PDO::FETCH_OBJ);

            return (object)[
                'status' => 200,
                'message' => 'success',
                'data' => $users
            ];
        } catch (PDOException $e) {
            return (object)[
                'status' => 500,
                'message' => $e->getMessage()
            ];
        } catch (Exception $e) {
            return (object)[
                'status' => 500,
                'message' => $e->getMessage()
            ];
        }
    }

    public function save($password = null, $connection = null)
    {
        try {
            if (empty($connection)) $connection = getConnection();

            $query = "CALL saveUser(:id,:username,:firstname,:lastname,:email,:password,:roleId,@response,@id);";
            $stmt = $connection->getConnection()->prepare($query);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $stmt->bindParam(':username', $this->username, PDO::PARAM_STR);
            $stmt->bindParam(':firstname', $this->firstname, PDO::PARAM_STR);
            $stmt->bindParam(':lastname', $this->lastname, PDO::PARAM_STR);
            $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->bindParam(':roleId', $this->roleId, PDO::PARAM_INT);
            $stmt->execute();

            $stmt->closeCursor();

            $data = $connection->getConnection()->query("SELECT @response response,@id id")->fetch(PDO::FETCH_OBJ);

            return (object)[
                'status' => 200,
                'message' => $data->response,
                'data' => (object)[
                    'id' => base64_encode($data->id),
                    'createdAt' => date('Y-m-d H:i:s'),
                ]
            ];
        } catch (PDOException $e) {
            return (object)[
                'status' => 500,
                'message' => $e->getMessage()
            ];
        } catch (Exception $e) {
            return (object)[
                'status' => 500,
                'message' => $e->getMessage()
            ];
        }
    }

    public static function checkUsernameAvailability($id, $username, $connection = null)
    {
        try {
            if (empty($connection)) $connection = getConnection();

            $query = "CALL checkUsernameAvailability(:id,:username,@response);";
            $stmt = $connection->getConnection()->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();

            $stmt->closeCursor();

            $data = $connection->getConnection()->query("SELECT @response response")->fetch(PDO::FETCH_OBJ);

            return (object)[
                'status' => 200,
                'message' => $data->response,
            ];
        } catch (PDOException $e) {
            return (object)[
                'status' => 500,
                'message' => $e->getMessage()
            ];
        } catch (Exception $e) {
            return (object)[
                'status' => 500,
                'message' => $e->getMessage()
            ];
        }
    }

    public function delete($connection = null)
    {
        try {
            if (empty($connection)) $connection = getConnection();

            $currentUserId = App::getUserId();

            $query = "CALL deleteUser(:id,:userAction,@response);";
            $stmt = $connection->getConnection()->prepare($query);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $stmt->bindParam(':userAction', $currentUserId, PDO::PARAM_INT);
            $stmt->execute();

            $stmt->closeCursor();

            $data = $connection->getConnection()->query("SELECT @response response")->fetch(PDO::FETCH_OBJ);

            return (object)[
                'status' => 200,
                'message' => $data->response,
            ];
        } catch (PDOException $e) {
            return (object)[
                'status' => 500,
                'message' => $e->getMessage()
            ];
        } catch (Exception $e) {
            return (object)[
                'status' => 500,
                'message' => $e->getMessage()
            ];
        }
    }

    public function lockUnlock($newStatus, $connection = null)
    {
        try {
            if (empty($connection)) $connection = getConnection();

            $query = "CALL lockUnlockUser(:id,:newStatus,@response);";
            $stmt = $connection->getConnection()->prepare($query);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $stmt->bindParam(':newStatus', $newStatus, PDO::PARAM_INT);
            $stmt->execute();

            $stmt->closeCursor();

            $data = $connection->getConnection()->query("SELECT @response response")->fetch(PDO::FETCH_OBJ);

            return (object)[
                'status' => 200,
                'message' => $data->response,
            ];
        } catch (PDOException $e) {
            return (object)[
                'status' => 500,
                'message' => $e->getMessage()
            ];
        } catch (Exception $e) {
            return (object)[
                'status' => 500,
                'message' => $e->getMessage()
            ];
        }
    }

    public function createTemporalPassword()
    {
        try {
            $request = $this->createRecoveryPasswordRequest($this->email);

            if ($request->status != 200 || ($request->status == 200 && $request->message != 'success')) return $request;

            $emailRequest = User::sendPasswordEmail($this->email, $request->name, $request->password);

            if ($emailRequest->status != 200) return $emailRequest;

            return (object)[
                'status' => 200,
                'message' => 'success',
                'data' => (object)[
                    'email' => $this->email,
                    'password' => $request->password
                ]
            ];
        } catch (PDOException $e) {
            return (object)[
                'status' => 500,
                'message' => $e->getMessage()
            ];
        } catch (Exception $e) {
            return (object)[
                'status' => 500,
                'message' => $e->getMessage()
            ];
        }
    }

    public static function sendPasswordEmail($email, $name, $password = "ABC"): object
    {
        $templateURL = __DIR__ . '/../../docs/templates/temporalPasswordTemplate.html';

        if (!file_exists($templateURL)) return (object)[
            'status' => 500,
            'message' => 'No se encontró la plantilla de correo'
        ];

        $emailProcess = new Email($templateURL, ['name' => $name, 'password' => $password, 'EMAIL' => $email]);
        $asunto = mb_strtoupper("Recuperación de contraseña", "UTF-8");

        return $emailProcess->send($email, $name, $asunto, [], 'support@mrsoftware.tech');
    }

    private function createRecoveryPasswordRequest($email, $connection = null): object
    {
        if (empty($connection)) $connection = getConnection();

        $str = getRandomStr();
        $password = md5($str);

        $query = "CALL saveRecoveryPasswordRequest(:email,:password,@response,@idUsuario,@name);";
        $stmt = $connection->getConnection()->prepare($query);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);

        try {
            $stmt->execute();

            $stmt->closeCursor();

            $tmp = $connection->getConnection()->query("SELECT @response,@idUsuario,@name")->fetch(PDO::FETCH_OBJ);

            $response = $tmp->{'@response'};
            $id = $tmp->{'@idUsuario'};
            $name = $tmp->{'@name'};

            return (object)[
                'status' => 200,
                'message' => $response,
                'password' => $str,
                'requestId' => $id,
                'name' => $name,
                'email' => $email
            ];
        } catch (PDOException $e) {
            return (object)[
                'status' => 500,
                'message' => $e->getMessage()
            ];
        }
    }

    public function updateEmail($password, $connection = null)
    {
        try {
            if (empty($connection)) $connection = getConnection();

            $query = "CALL updateUserEmail(:id,:email,:password,@response);";
            $stmt = $connection->getConnection()->prepare($query);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->execute();

            $stmt->closeCursor();

            $data = $connection->getConnection()->query("SELECT @response response")->fetch(PDO::FETCH_OBJ);

            return (object)[
                'status' => 200,
                'message' => $data->response
            ];
        } catch (PDOException $e) {
            return (object)[
                'status' => 500,
                'message' => $e->getMessage()
            ];
        } catch (Exception $e) {
            return (object)[
                'status' => 500,
                'message' => $e->getMessage()
            ];
        }
    }

    public function updatePhoto($newFilename, $connection = null)
    {
        try {
            if (empty($connection)) $connection = getConnection();

            $query = "CALL updateUserPhoto(:id,:filename,@response);";
            $stmt = $connection->getConnection()->prepare($query);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $stmt->bindParam(':filename', $newFilename, PDO::PARAM_STR);
            $stmt->execute();

            $stmt->closeCursor();

            $data = $connection->getConnection()->query("SELECT @response response")->fetch(PDO::FETCH_OBJ);

            return (object)[
                'status' => 200,
                'message' => $data->response,
                'data' => (object)[
                    'filename' => $newFilename,
                    'id' => $this->id
                ]
            ];
        } catch (PDOException $e) {
            return (object)[
                'status' => 500,
                'message' => $e->getMessage()
            ];
        } catch (Exception $e) {
            return (object)[
                'status' => 500,
                'message' => $e->getMessage()
            ];
        }
    }
}
