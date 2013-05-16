<?php
/*      USERS 
################################################################## */
function create_user( $args ) {
    $query = MySQL::getInstance()->prepare( "INSERT INTO users (username, email, password, name) VALUES (:username, :email, :password, :name)" );
    $query->bindValue( ':username', $args['username'], PDO::PARAM_STR );
    $query->bindValue( ':email', $args['email'], PDO::PARAM_STR );
    $query->bindValue( ':password', $args['password'], PDO::PARAM_STR );
    $query->bindValue( ':name', $args['name'], PDO::PARAM_STR );
    $query->execute();
}

function user_exists( $username ) {
    $query = MySQL::getInstance()->prepare( "SELECT * FROM users WHERE username=:username" );
    $query->bindValue( ':username', $username, PDO::PARAM_STR );
    $query->execute();
    $result = $query->fetchAll( PDO::FETCH_ASSOC );
    $count = count( $result );
    return $count;
}

function email_exists( $email ) {
    $query = MySQL::getInstance()->prepare( "SELECT * FROM users WHERE email=:email" );
    $query->bindValue( ':email', $email, PDO::PARAM_STR );
    $query->execute();
    $result = $query->fetchAll( PDO::FETCH_ASSOC );
    $count = count( $result );
    return $count;
}

function user_log_in() {
    $query = MySQL::getInstance()->prepare( "SELECT * FROM users WHERE email=:email and password=:password" );
    $query->bindValue( ':email', $_POST['email'], PDO::PARAM_STR );
    $query->bindValue( ':password', do_hash( $_POST['password'] ), PDO::PARAM_STR );
    $query->execute();
    $result = $query->fetchAll( PDO::FETCH_ASSOC );
    $count = count( $result );
    if ( $count ) {
        $_SESSION['logged_in']  = true;
        $_SESSION['id']         = $result[0]['id'];
        $_SESSION['username']   = $result[0]['username'];
        $_SESSION['name']       = $result[0]['name'];
        return true;
    }
    return false;
}

function get_recovery_data( $email ) {
    $query = MySQL::getInstance()->prepare( "SELECT * FROM users WHERE email=:email" );
    $query->bindValue( ':email', $email, PDO::PARAM_STR );
    $query->execute();
    $result = $query->fetchAll( PDO::FETCH_ASSOC );
    return array( 'hash' => $result[0]['password'], 'id' => $result[0]['id'] );
}

function change_user_password($id, $hash, $new_hash) {
    $query = MySQL::getInstance()->prepare( "UPDATE users SET password=:newhash WHERE id=:id AND password=:hash" );
    $query->bindValue( ':newhash', $new_hash, PDO::PARAM_STR );
    $query->bindValue( ':id', $id, PDO::PARAM_INT );
    $query->bindValue( ':hash', $hash, PDO::PARAM_STR );
    $query->execute();
}

function get_user_by_id( $id ) {
    $query = MySQL::getInstance()->prepare( "SELECT * FROM users WHERE id=:id" );
    $query->bindValue( ':id', $id, PDO::PARAM_INT );
    $query->execute();
    $result = $query->fetchAll( PDO::FETCH_ASSOC );
    return $result[0];
}

function update_user($id, $column, $value) {
    try {
        $query = MySQL::getInstance()->prepare( "UPDATE users SET $column=:$column WHERE id=:id" );
        $query->bindValue( ':id', $id, PDO::PARAM_INT );
        $query->bindValue( ":$column", $value, PDO::PARAM_STR );
        $query->execute();
        return true;
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
        return false;
    }
}

function update_user_meta($user_id, $meta_name, $meta_value) {
    try {
        if (!user_meta_exists($user_id, $meta_name))
        {
            create_user_meta( $user_id, $meta_name, $meta_value );
            return true;
        }
        $query = MySQL::getInstance()->prepare( "UPDATE users_meta SET value=:value WHERE user_id=:user_id AND name=:name"  );
        $query->bindValue( ':user_id', $user_id, PDO::PARAM_INT );
        $query->bindValue( ":name", $meta_name, PDO::PARAM_STR );
        $query->bindValue( ":value", $meta_value, PDO::PARAM_STR );
        $query->execute();
        return true;
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
        return false;
    }
}

function create_user_meta( $user_id, $meta_name, $meta_value) {
    try {
        $query = MySQL::getInstance()->prepare( "INSERT INTO users_meta (name, value, user_id) VALUES (:name, :value, :user_id)" );
        $query->bindValue( ':user_id', $user_id, PDO::PARAM_INT );
        $query->bindValue( ':name', $meta_name, PDO::PARAM_STR );
        $query->bindValue( ':value', $meta_value, PDO::PARAM_STR );
        $query->execute();
        return true;
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
        return false;
    }
}

function user_meta_exists( $user_id, $meta_name ) {
    $query = MySQL::getInstance()->prepare( "SELECT * FROM users_meta WHERE user_id=:user_id AND name=:name" );
    $query->bindValue( ':user_id', $user_id, PDO::PARAM_INT);
    $query->bindValue( ':name', $meta_name, PDO::PARAM_STR );
    $query->execute();
    $result = $query->fetchAll( PDO::FETCH_ASSOC );
    if (count( $result ))
        return true;
    return false;
}

function get_user_meta( $user_id, $meta_name) {
    try {
        $query = MySQL::getInstance()->prepare( "SELECT * FROM users_meta WHERE user_id=:user_id AND name=:name" );
        $query->bindValue( ':user_id', $user_id, PDO::PARAM_INT );
        $query->bindValue( ':name', $meta_name, PDO::PARAM_STR );
        $query->execute();
        $result = $query->fetchAll( PDO::FETCH_ASSOC );
        return $result[0]['value'];
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
        return false;
    }
}

function user_meta($meta_name) {
    echo get_user_meta($_SESSION['id'], $meta_name);
}


// Functii de verificare parola
function do_hash($password) {
    return md5($password);
}

function check_password($id, $password) {
    try {
        $query = MySQL::getInstance()->prepare( "SELECT * FROM users WHERE id=:id AND password=:password" );
        $query->bindValue( ':id', $id, PDO::PARAM_INT );
        $query->bindValue( ":password", do_hash($password), PDO::PARAM_STR );
        $query->execute();
        $result = $query->fetchAll( PDO::FETCH_ASSOC );
        if (count( $result ) > 0)
            return true;
        return false;
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
        return false;
    }
}


/*      COURSES
#################################################################*/
function get_courses( $offset = '0', $limit = '20' ) {
    $leg2 = " , ";

    // Niciuna nu e setata
    if (( !empty($limit) ) || ( !empty($offset) )) 
        $leg1 = ' LIMIT ';

    // E setata doar limita 
    if (( !empty($limit) ) && ( empty($offset) )) 
        $offset = 0;

    // E setat doar offsetul
    if (( empty($limit) ) && ( !empty($offset) )) 
    {
        $leg1 = ' OFFSET ';
        $leg2 = '';
    }

    $query = MySQL::getInstance()->query( "SELECT * FROM courses ORDER BY published DESC ".$leg1." :offset ".$leg2." :limit" );
    $query->bindValue( ':offset', $offset, PDO::PARAM_INT );
    $query->bindValue( ':limit', $limit, PDO::PARAM_INT );
    return $query->fetchAll();
}

function get_course_by_slug( $slug ) {
    $query = MySQL::getInstance()->prepare( "SELECT * FROM courses WHERE slug=:slug" );
    $query->bindValue( ':slug', $slug, PDO::PARAM_STR );
    $query->execute();
    return $query->fetch( PDO::FETCH_ASSOC );
}

function get_course_by_id( $id ) {
    $query = MySQL::getInstance()->prepare( "SELECT * FROM courses WHERE id=:id" );
    $query->bindValue( ':id', $id, PDO::PARAM_INT );
    $query->execute();
    return $query->fetch( PDO::FETCH_ASSOC );
}

function update_course_meta($course_id, $meta_name, $meta_value) {
    try {
        if (!course_meta_exists($course_id, $meta_name))
        {
            create_course_meta( $course_id, $meta_name, $meta_value );
            return true;
        }
        $query = MySQL::getInstance()->prepare( "UPDATE courses_meta SET value=:value WHERE course_id=:course_id AND name=:name"  );
        $query->bindValue( ':course_id', $course_id, PDO::PARAM_INT );
        $query->bindValue( ":name", $meta_name, PDO::PARAM_STR );
        $query->bindValue( ":value", $meta_value, PDO::PARAM_STR );
        $query->execute();
        return true;
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
        return false;
    }
}

function create_course_meta( $course_id, $meta_name, $meta_value) {
    try {
        $query = MySQL::getInstance()->prepare( "INSERT INTO courses_meta (name, value, course_id) VALUES (:name, :value, :course_id)" );
        $query->bindValue( ':course_id', $course_id, PDO::PARAM_INT );
        $query->bindValue( ':name', $meta_name, PDO::PARAM_STR );
        $query->bindValue( ':value', $meta_value, PDO::PARAM_STR );
        $query->execute();
        return true;
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
        return false;
    }
}

function course_meta_exists( $course_id, $meta_name ) {
    $query = MySQL::getInstance()->prepare( "SELECT * FROM courses_meta WHERE course_id=:course_id AND name=:name" );
    $query->bindValue( ':course_id', $course_id, PDO::PARAM_INT);
    $query->bindValue( ':name', $meta_name, PDO::PARAM_STR );
    $query->execute();
    $result = $query->fetchAll( PDO::FETCH_ASSOC );
    if (count( $result ))
        return true;
    return false;
}

function get_course_meta( $course_id, $meta_name) {
    try {
        $query = MySQL::getInstance()->prepare( "SELECT * FROM courses_meta WHERE course_id=:course_id AND name=:name" );
        $query->bindValue( ':course_id', $course_id, PDO::PARAM_INT );
        $query->bindValue( ':name', $meta_name, PDO::PARAM_STR );
        $query->execute();
        $result = $query->fetchAll( PDO::FETCH_ASSOC );
        return $result[0]['value'];
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
        return false;
    }
}

function course_meta($meta_name) {
    echo get_course_meta($_SESSION['id'], $meta_name);
}












function save_comment( $article_id, $name, $body ) {
    $query = MySQL::getInstance()->prepare( "INSERT INTO comments (article_id, name, body) VALUES (:article_id, :name, :body)" );
    $query->bindValue( ':article_id', $article_id, PDO::PARAM_INT );
    $query->bindValue( ':name', $name, PDO::PARAM_STR );
    $query->bindValue( ':body', $body, PDO::PARAM_STR );
    $query->execute();
}
