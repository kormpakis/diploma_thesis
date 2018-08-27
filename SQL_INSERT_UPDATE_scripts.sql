//Various INSERT/UPDATE SQL scripts

INSERT INTO interest_array (user_id, tags_id, count_tags) VALUES ('$user_id', '$tag', 1);

UPDATE interest_array SET count_tags=count_tags+1 WHERE user_id = '$user_id' AND tags_id = '$tag';