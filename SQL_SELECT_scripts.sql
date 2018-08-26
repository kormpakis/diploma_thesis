//Various SELECT SQL scripts

SELECT ID FROM wp_users;

SELECT tags_id FROM interest_array WHERE user_id='$r_id' ORDER BY count_tags DESC LIMIT 3;

SELECT tags_id FROM interest_array WHERE user_id='$r_id' ORDER BY count_tags DESC LIMIT 4,6;