<?php

try {
    // Establishing a connection to the database
    $connect = new PDO("mysql:host=localhost;dbname=digital_dynasry", "root", "");

    // Checking if data for submitting a review is received
    if(isset($_POST["rating_data"])) {

        // Prepare data to be inserted into the database
        $data = array(
            ':user_name'        =>  $_POST["user_name"],
            ':user_rating'      =>  $_POST["rating_data"],
            ':user_review'      =>  $_POST["user_review"],
            ':datetime'     => date('Y-m-d H:i:s') // Using date() to format the timestamp correctly
        );

        // SQL query to insert review data into the database
        $query = "
        INSERT INTO review 
        (user_name, user_rating, user_review, datetime) 
        VALUES (:user_name, :user_rating, :user_review, :datetime)
        ";

        // Prepare the SQL query
        $statement = $connect->prepare($query);

        // Execute the query with the provided data
        $statement->execute($data);

        // Return success message to the user
        echo "Your Review & Rating Successfully Submitted";
    }

    // Checking if action for fetching review data is received
    if(isset($_POST["action"])) {
        $average_rating = 0;
        $total_review = 0;
        $five_star_review = 0;
        $four_star_review = 0;
        $three_star_review = 0;
        $two_star_review = 0;
        $one_star_review = 0;
        $total_user_rating = 0;
        $review_content = array();

        // SQL query to fetch review data from the database
        $query = "
        SELECT * FROM review
        ORDER BY review_id DESC
        ";

        // Execute the query
        $result = $connect->query($query, PDO::FETCH_ASSOC);

        // Loop through each fetched review data
        foreach($result as $row) {
            // Format the review data
            $review_content[] = array(
                'user_name'        =>    $row["user_name"],
                'user_review'    =>    $row["user_review"],
                'rating'        =>    $row["user_rating"],
                'datetime'   => date('l jS, F Y h:i:s A', strtotime($row["datetime"])) // Fixing typo
            );

            // Counting each star rating
            switch($row["user_rating"]) {
                case '5':
                    $five_star_review++;
                    break;
                case '4':
                    $four_star_review++;
                    break;
                case '3':
                    $three_star_review++;
                    break;
                case '2':
                    $two_star_review++;
                    break;
                case '1':
                    $one_star_review++;
                    break;
            }

            // Counting total reviews and calculating total rating
            $total_review++;
            $total_user_rating += $row["user_rating"];
        }

        // Calculating average rating
        if($total_review > 0) {
            $average_rating = $total_user_rating / $total_review;
        }

        // Prepare output data
        $output = array(
            'average_rating'    =>    number_format($average_rating, 1),
            'total_review'        =>    $total_review,
            'five_star_review'    =>    $five_star_review,
            'four_star_review'    =>    $four_star_review,
            'three_star_review'    =>    $three_star_review,
            'two_star_review'    =>    $two_star_review,
            'one_star_review'    =>    $one_star_review,
            'review_data'        =>    $review_content
        );

        // Return review data in JSON format
        echo json_encode($output);
    }
} catch(PDOException $e) {
    // Handle PDO exceptions
    echo "Error: " . $e->getMessage();
}

?>
