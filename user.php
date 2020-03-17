<?php

class user{

    //Propiétés

    private $_idUser;
    private $_Login;
    private $_Mdp;

    //Constructeur
    public function __construct($id,$Login,$Mdp)
    {
        $this->_idUser = $id;
        $this->_Login = $Login;
        $this->_Mdp = $Mdp;
    }


}

?>