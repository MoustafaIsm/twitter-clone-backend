-- Users table
INSERT INTO `users` (`username`, `name`, `password`, `date_of_birth`, `date_of_registration`, `bio`, `location`, `profile_picture_link`, `banner_picture_link`, `website`) 
VALUES (
    'jaafarHawila123', 'Jaafar Hawila', '12341234', '2000-1-1', '2022-3-3', 'NA', 'NA', 'NA', 'NA', 'NA'
);

INSERT INTO `users` (`username`, `name`, `password`, `date_of_birth`, `date_of_registration`, `bio`, `location`, `profile_picture_link`, `banner_picture_link`, `website`) 
VALUES (
    'moustafaism123', 'Moustafa Ismail', '12341234', '2001-1-1', '2022-5-3', 'NA', 'NA', 'NA', 'NA', 'NA'
);

INSERT INTO `users` (`username`, `name`, `password`, `date_of_birth`, `date_of_registration`, `bio`, `location`, `profile_picture_link`, `banner_picture_link`, `website`) 
VALUES (
    'joe123', 'Joe', '12341234', '2004-1-1', '2021-3-3', 'NA', 'NA', 'NA', 'NA', 'NA'
);

INSERT INTO `users` (`username`, `name`, `password`, `date_of_birth`, `date_of_registration`, `bio`, `location`, `profile_picture_link`, `banner_picture_link`, `website`) 
VALUES (
    'simon123', 'Simon', '12341234', '2000-1-1', '2022-3-3', 'NA', 'NA', 'NA', 'NA', 'NA'
);

-- Tweets table
INSERT INTO `tweets`(`tweet_text`, `tweet_image_link`, `date_time_of_creation`, `user_id`)
VALUES ('Hello there, im new','NA','2022-5-4',1);

INSERT INTO `tweets`(`tweet_text`, `tweet_image_link`, `date_time_of_creation`, `user_id`)
VALUES ('Hello there, its jaafar here','NA','2022-6-4',1);

INSERT INTO `tweets`(`tweet_text`, `tweet_image_link`, `date_time_of_creation`, `user_id`)
VALUES ('Hello there, im new','NA','2022-5-4',2);

INSERT INTO `tweets`(`tweet_text`, `tweet_image_link`, `date_time_of_creation`, `user_id`)
VALUES ('Hello there, im new','NA','2022-5-4',3);

-- Likes table
INSERT INTO `likes`(`user_id`, `tweet_id`) 
VALUES (1, 2);

INSERT INTO `likes`(`user_id`, `tweet_id`) 
VALUES (2, 2);

INSERT INTO `likes`(`user_id`, `tweet_id`) 
VALUES (3, 1);

INSERT INTO `likes`(`user_id`, `tweet_id`) 
VALUES (4, 1);

-- Following table
INSERT INTO `following`(`users_id`, `following_user_id`) 
VALUES (1, 2);

INSERT INTO `following`(`users_id`, `following_user_id`) 
VALUES (1, 3);

INSERT INTO `following`(`users_id`, `following_user_id`) 
VALUES (2, 1);

INSERT INTO `following`(`users_id`, `following_user_id`) 
VALUES (2, 4);

-- Blocked
INSERT INTO `blocked`(`user_id`, `blocked_user_id`) 
VALUES (1, 4);

INSERT INTO `blocked`(`user_id`, `blocked_user_id`) 
VALUES (2, 3);

