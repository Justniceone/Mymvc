<?php
class UserController
{
    public function usersAction()
    {
        $user = new UserModel();
        $lists = $user->getAll();
        require './application/home/view/user.php';
    }

    public function userAction($id=1)
    {
        $id =  $_GET['id']  ? :$id;
        $user = new UserModel();
        $list = $user->get($id);
        print_r($list);
    }
}