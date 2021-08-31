<?php
    require_once "../classes/database.php";
    $select = ($_POST["select"] == "") ? "" :$_POST["select"];
    $where = ($select == "") ? "" : "WHERE courses.course_year = '$select'"; 
    $courses = $obj->read("courses","*", "INNER JOIN user ON courses.teacher = user.id", $where);

    if($courses == "No result"){
        echo $courses;
    }elseif(count($courses) == 9) {
        echo '
            <div class="col-4 mt-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">'. $courses['name'] . '</h5>
                        <p class="card-text">This s will be happening on '. $courses['course_year'] .' and the teacher who be responsible of this course will be '. $courses['first_name'] .' '.$courses["last_name"].'</p>
                    </div>
                </div>
            </div>';
    }else {
        foreach($courses as $course) {
            echo '
            <div class="col-4 mt-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">'. $course['name'] . '</h5>
                        <p class="card-text">This course will be happening on '. $course['course_year'] .' and the teacher who be responsible of this course will be '. $course['first_name'] .' '.$course["last_name"].'</p>
                    </div>
                </div>
            </div>';
        }
    }

?>