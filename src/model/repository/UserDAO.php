<?php 
interface UserDAO {
    public function createUser($user);
    public function updateUser($user, $newUser);
    public function deleteUser($user);
    public function getAllUsers();
    public function getUserById($id);
}
?>