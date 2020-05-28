<?php
include_once "DBConnector.php";

class fileUploader
{
    private static $target_directory = "uploads/";
    private static $size_limit = 50000;
    private static $allowTypes = array('jpg','png','jpeg','gif','pdf');
    private $uploadOK= false;
    private $fileName;
    private $fileType;
    private $fileSize;
    private $finalName;
    private $filePath;
    private $username;

    public function setUsername($username){
        $this->$username = $username;
    }

    public function getUsername(){
        return $this->$username;
    }

    public function setOriginalName($fileName){
        $this->fileName = $fileName;
    }

    public function getOriginalName(){
        return $this->file_name;
    }

    public function setType($fileType){
        $this->fileType = $fileType;
    }

    public function getType(){
        return $this->fileType;
    }

    public function setSize($fileSize){
        $this->fileSize = $fileSize;
    }

    public function getSize(){
        return $this->fileSize;
    }

    public function setFinalName($finalName){
        $this->finalName = $finalName;
    }

    public function getFinalName(){
        return $this->finalName;
    }


    public function uploadFile(){

        $conn = new DBConnector();
        $this->moveFile();
        $imagename = $this->fileName;
        $username = $this->username;


        if ($this->uploadOK==true) {
            $res = mysqli_query($conn->conn, "UPDATE user SET image_name= '$imagename' WHERE username= '$username'") or die("Error".mysqli_error());

            unset($_SESSION['username']);
        }
    }

    public function fileAlreadyExists(){
        $this->saveFilePathTo();
        $fileExistsinDir=false;

        if (file_exists($this->filePath)) {
            $fileExistsinDir=true;
        }

        return $fileExistsinDir;
    }

    public function saveFilePathTo(){
        $target_dir = self::$target_directory;
        $target_file = $target_dir . basename($this->fileName);
        $this->filePath=$target_file;
    }

    public function moveFile(){
        $result = move_uploaded_file($this->finalName, $this->filePath);
        if ($result) {
            $this->uploadOK=true;
        }
        return $this->uploadOK;
    }

    public function fileTypeisCorrect(){
        $allowTypes = array('jpg','png','jpeg','gif','jfif');
        $typeFound = false;
        $typeFet= $this->fileType;
        if (in_array($typeFet, $allowTypes)) {
            $typeFound = true;
        }

        return $typeFound;
    }

    public function fileSizeIsCorrect(){
        $sizegood=false;
        if ($this->fileSize<50000) {
            $sizegood=true;
            return $sizegood;
        }
        return $sizegood;
    }

    public function fileWasSelected(){
        $selected=false;
        if ($this->fileName) {
            $this->uploadOK=true;
            $selected=true;
            return $selected;
        }
        return $selected;
    }
}
