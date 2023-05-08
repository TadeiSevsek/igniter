<?php 
class baza extends CI_Model{
    public function novUporabnik($username,$email,$pass){
        $sql = "INSERT INTO user(username,email, password) VALUES('$username','$email','$pass')";
        $this->db->query($sql);
    }

    public function preveriUporabnika($username,$email){
        $sql = "SELECT * FROM user WHERE username='$username' || email='$email' ";
        $rez = $this->db->query($sql);
        return($rez);

    }

    public function allGames(){
        $select = "select *,IFNULL((select round(AVG(rating.rating ),2) from rating where game.idgame = rating.game_idgame ),0) as 'avg' from game;";
        $rez = $this->db->query($select);
        return($rez);
    }
    public function featuredGames(){
        $select = "select *,IFNULL((select round(AVG(rating.rating ),2) from rating where game.idgame = rating.game_idgame ),0) as 'avg' from game where game.featured = 1;";
        $rez = $this->db->query($select);
        return($rez);

    }

    public function sportGames(){
        $select = "select *,IFNULL((select round(AVG(rating.rating ),2) from rating where game.idgame = rating.game_idgame ),0) as 'avg' from game where game.genre like '%sport%';";
        $rez = $this->db->query($select);
        return($rez);

    }

    public function actionGames(){
        $select = "select *,IFNULL((select round(AVG(rating.rating ),2) from rating where game.idgame = rating.game_idgame ),0) as 'avg' from game where game.genre like '%action%';";
        $rez = $this->db->query($select);
        return($rez);
    }
    public function shooterGames(){
        $select = "select *,IFNULL((select round(AVG(rating.rating ),2) from rating where game.idgame = rating.game_idgame ),0) as 'avg' from game where game.genre like '%shooter%';";
        $rez = $this->db->query($select);
        return($rez);
    }
    public function filterGame($game){
        $select ="select *,IFNULL((select round(AVG(rating.rating ),2) from rating where game.idgame = rating.game_idgame ),0) as 'avg' from game where game.name like '%$game%';";
        $rez = $this->db->query($select);
        return($rez);
    }

    public function ownedGames($id){
        $select = "select *,IFNULL((select round(AVG(rating.rating ),2) from rating where game.idgame = rating.game_idgame ),0) as 'avg' from game join ownedgames on ownedgames.game_idgame=game.idgame where ownedgames.user_iduser='$id';";
        $rez = $this->db->query($select);
        return($rez);
    }
    public function libFilter($game,$id){
        $select ="select *,IFNULL((select round(AVG(rating.rating ),2) from rating where game.idgame = rating.game_idgame ),0) as 'avg' from game join ownedgames on ownedgames.game_idgame=game.idgame where ownedgames.user_iduser='$id' && game.name like '%$game%';";
        $rez = $this->db->query($select);
        return($rez);
    }

    public function preveriCredit($cardNumber){
        $select = "SELECT * FROM card where card.Cardnumber='$cardNumber' ";
        $rez = $this->db->query($select);
        return($rez);
    }

    public function insertCard($name,$cardNumber,$cardDate,$cvv){
        $insert = "INSERT INTO `card`( `name`, `Cardnumber`, `exp`, `cvv`) VALUES ('$name','$cardNumber','$cardDate','$cvv')";
        $rez = $this->db->query($insert);
    }

    public function updateUser($ime,$sestevek){
        $insert = "UPDATE user SET balance = '$sestevek' WHERE username='$ime';" ;
        $rez = $this->db->query($insert);
    }

    public function uploadGame($name,$description, $novIme,$exe,$displayPrice,$price,$datePublished,$genre,$developer,$studio){
        $insert="INSERT INTO game(name, description, coverImg,exe, displayPrice, price,datePublished, genre,developer,studio) VALUES('$name', '$description','$novIme','$exe', '$displayPrice','$price', '$datePublished','$genre','$developer','$studio')";
        $rez = $this->db->query($insert);
    }

    public function gameId(){
        $select="SELECT * FROM game ORDER BY (game.idgame) DESC LIMIT 1;";
        $rez = $this->db->query($select);
        return($rez);

    }

    public function uploadImg($novIme,$idGame){
        $insert="INSERT INTO `img/video` ( `img/video`, `game_idgame`) VALUES ('$novIme', '$idGame')";
        $this->db->query($insert);
    }

    public function check($id){
        $update ="UPDATE game SET game.featured = 1 WHERE game.idgame = '$id';";
        $this->db->query($update);
    }
    public function uncheck($id){
        $update ="UPDATE game SET game.featured = 0 WHERE game.idgame = '$id';";
        $this->db->query($update);
    }

    public function gameInfo($id){
        $select = "SELECT * FROM game WHERE game.idgame='$id'";
        $rez = $this->db->query($select);
        return($rez);
    }
    public function gameImgs($id){
        $select ="SELECT * FROM `img/video` WHERE `img/video`.`game_idgame` = '$id';";
        $rez = $this->db->query($select);
        return($rez);
    }

    public function gameComments($id){
        $select = "SELECT * FROM `rating` join user on user.iduser=rating.user_iduser where rating.game_idgame='$id';";
        $rez = $this->db->query($select);
        return($rez);
    }

    public function insertComment($comment,$rating,$id,$gameid){
        $insert = "INSERT INTO `rating`( `user_iduser`, `game_idgame`, `rating`, `comment`) VALUES ('$id','$gameid','$rating','$comment')";
        $rez = $this->db->query($insert);
    }

    public function owned($gameid, $userid){
        $select = "SELECT * from ownedgames where ownedgames.user_iduser = '$userid' AND ownedgames.game_idgame = '$gameid';";
        $rez = $this->db->query($select);
        return($rez);
    }

    public function cartGames($ids){
        $select = "SELECT * FROM `game` WHERE idgame in ('$ids');";
        $rez = $this->db->query($select);
        return($rez);
    }

    public function updateBalance($id,$balance){
        $update= "UPDATE `user` SET balance='$balance' WHERE iduser='$id';";
        $rez = $this->db->query($update);
    }

    public function updateOwned($id,$gameid){
        $insert="INSERT INTO `ownedgames`(`user_iduser`, `game_idgame`) VALUES ('$id','$gameid');";
        $this->db->query($insert);
    }
}