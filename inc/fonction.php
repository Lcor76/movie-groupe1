<?php
/**
 * @param array $tableau
 */
function debug($tableau)
{
    echo '<pre style="height:200px;overflow-y: scroll;font-size: .7em;padding:10px;font-family: Consolas, Monospace; background-color: #000;color:#fff;">';
    print_r($tableau);
    echo '</pre>';
}


function imageMovie($movie)
{
    return '<img src="posters/'.$movie['id'].'.jpg" alt="'.$movie['title'].'">';
}



function cleanXss(string $key)
{
    return trim(strip_tags($_POST[$key]));
}

function getError($errors,$key){
    return (!empty($errors[$key])) ? $errors[$key] : '';
}

function getValue($key,$data = null){
    if(!empty($_POST[$key])) {
        return $_POST[$key];
    } else {
        if(!empty($data)) {
            return $data;
        }
    }
    return '';
}
// Validation formulaire
function validText($errors,$data,$key,$min =2,$max = 50)
{
    if(!empty($data)) {
        if(mb_strlen($data) < $min) {
            $errors[$key] = 'min '.$min.' caractères';
        } elseif(mb_strlen($data) > $max) {
            $errors[$key] = 'max '.$max.' caractères';
        }
    } else {
        $errors[$key] = 'Veuillez renseigner ce champ';
    }
    return $errors;
}


function validEmail($errors,$data,$key)
{
    if(!empty($data)) {
        if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
            $errors[$key] = 'Veuillez renseigner un email valide';
        }
    } else{
        $errors[$key] = 'Veuillez renseigner un email';
    }
    return $errors;
}




/**
 * @param string $data
 * @param string $format
 * @return string
 */
function dateFormat($data, string $format = 'd/m/Y à H:i') : string
{
    if($data == null) {
        return '';
    }
    return date($format,strtotime($data));
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function getArticleById($id)
{
   global $pdo;
   $sql = "SELECT * FROM articles WHERE id = :id";
   $query = $pdo->prepare($sql);
   $query->bindValue(':id',$id,PDO::PARAM_INT);
   $query->execute();
   return $query->fetch();
}

function isLogged()
{
    if(!empty($_SESSION['user'])) {
        if(!empty($_SESSION['user']['id'])) {
            if(!empty($_SESSION['user']['pseudo'])) {
                if(!empty($_SESSION['user']['email'])) {
                    if(!empty($_SESSION['user']['role'])) {
                        if(!empty($_SESSION['user']['ip'])) {
                            if($_SESSION['user']['ip'] == $_SERVER['REMOTE_ADDR']) {
                                return true;
                            }
                        }
                    }
                }
            }
        }
    }
    return false;
}
