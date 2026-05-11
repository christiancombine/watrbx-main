<?php
namespace watrbx\mesages;
use watrlabs\authentication;
class templates {

    static function award_currency($reason, $user, $amountandtype){
        $auth = new authentication();
        $amount = $amountandtype["amount"];
        $type = $amountandtype["type"];
        $userinfo = $auth->getuserbyid($user);
        $username = $userinfo->username;
        $awardedarray = [
            "subject"=>"Your account balance was updated."
            "content"=>"
            Dear $username,

            Your account balance has been updated.
            $reason
            You have been awarded/subtracted $amount $type


            If you have any questions or concerns, contact our support team.
            ";
        ];
        return $awardedarray;
    }

}

?>