

CREATE TABLE users
(
  id Int NOT NULL AUTO_INCREMENT,
  username Varchar(100) NOT NULL,
  password Varchar(255) NOT NULL,
  email Varchar(255) NOT NULL,
  profile_picture_url Varchar(255),
  creation_date Timestamp NOT NULL,
  PRIMARY KEY (id)
)
;



CREATE TABLE videos
(
  id Int NOT NULL AUTO_INCREMENT,
  url Varchar(255) NOT NULL,
  video_url Char(255) NOT NULL,
  thumbnail Varchar(255) NOT NULL,
  title Varchar(100) NOT NULL,
  upload_date Timestamp NOT NULL,
  description Text,
  views Int NOT NULL DEFAULT 0,
  listed Int(1) NOT NULL DEFAULT 0,
  channel_id Int NOT NULL,
  PRIMARY KEY (id)
)
;

CREATE INDEX IX_Relationship10 ON videos (channel_id)
;



CREATE TABLE video_comments
(
  id Int NOT NULL AUTO_INCREMENT,
  comment Text NOT NULL,
  date Timestamp NOT NULL,
  user_id Int NOT NULL,
  video_id Int NOT NULL,
  PRIMARY KEY (id)
)
;

CREATE INDEX IX_Relationship22 ON video_comments (user_id)
;

CREATE INDEX IX_Relationship23 ON video_comments (video_id)
;



CREATE TABLE video_likes
(
  id Int NOT NULL AUTO_INCREMENT,
  date Timestamp NOT NULL,
  video_id Int NOT NULL,
  user_id Int NOT NULL,
  PRIMARY KEY (id)
)
;

CREATE INDEX IX_Relationship11 ON video_likes (video_id)
;

CREATE INDEX IX_Relationship13 ON video_likes (user_id)
;



CREATE TABLE video_dislikes
(
  id Int NOT NULL AUTO_INCREMENT,
  date Timestamp NOT NULL,
  video_id Int NOT NULL,
  user_id Int NOT NULL,
  PRIMARY KEY (id)
)
;

CREATE INDEX IX_Relationship14 ON video_dislikes (video_id)
;

CREATE INDEX IX_Relationship15 ON video_dislikes (user_id)
;



CREATE TABLE video_comment_likes
(
  id Int NOT NULL AUTO_INCREMENT,
  date Timestamp NOT NULL,
  user_id Int NOT NULL,
  comment_id Int NOT NULL,
  PRIMARY KEY (id)
)
;

CREATE INDEX IX_Relationship20 ON video_comment_likes (user_id)
;

CREATE INDEX IX_Relationship21 ON video_comment_likes (comment_id)
;



CREATE TABLE subscriptions
(
  id Int NOT NULL AUTO_INCREMENT,
  date Timestamp NOT NULL,
  user_id Int NOT NULL,
  channel_id Int NOT NULL,
  PRIMARY KEY (id)
)
;

CREATE INDEX IX_Relationship8 ON subscriptions (user_id)
;

CREATE INDEX IX_Relationship9 ON subscriptions (channel_id)
;



CREATE TABLE channels
(
  id Int NOT NULL AUTO_INCREMENT,
  url Varchar(255) NOT NULL,
  subscribers Int NOT NULL,
  views Int NOT NULL,
  banner_picture_url Varchar(255),
  description Text,
  user_id Int NOT NULL,
  PRIMARY KEY (id)
)
;

CREATE INDEX IX_Relationship7 ON channels (user_id)
;



CREATE TABLE playlists
(
  id Int NOT NULL AUTO_INCREMENT,
  name Varchar(100) NOT NULL,
  description Text,
  channel_id Int NOT NULL,
  PRIMARY KEY (id)
)
;

CREATE INDEX IX_Relationship16 ON playlists (channel_id)
;



CREATE TABLE posts
(
  id Int NOT NULL AUTO_INCREMENT,
  url Varchar(255) NOT NULL,
  text Text NOT NULL,
  date Timestamp NOT NULL,
  image_url Varchar(255),
  channel_id Int NOT NULL,
  PRIMARY KEY (id)
)
;

CREATE INDEX IX_Relationship28 ON posts (channel_id)
;



CREATE TABLE post_likes
(
  id Int NOT NULL AUTO_INCREMENT,
  date Timestamp NOT NULL,
  user_id Int NOT NULL,
  post_id Int NOT NULL,
  PRIMARY KEY (id)
)
;

CREATE INDEX IX_Relationship24 ON post_likes (user_id)
;

CREATE INDEX IX_Relationship25 ON post_likes (post_id)
;



CREATE TABLE playlists_videos
(
  id Int NOT NULL AUTO_INCREMENT,
  playlist_id Int NOT NULL,
  video_id Int NOT NULL,
  PRIMARY KEY (id)
)
;

CREATE INDEX IX_Relationship18 ON playlists_videos (playlist_id)
;

CREATE INDEX IX_Relationship19 ON playlists_videos (video_id)
;



CREATE TABLE post_comments
(
  id Int NOT NULL AUTO_INCREMENT,
  comment Text NOT NULL,
  date Timestamp NOT NULL,
  post_id Int NOT NULL,
  user_id Int NOT NULL,
  PRIMARY KEY (id)
)
;

CREATE INDEX IX_Relationship31 ON post_comments (post_id)
;

CREATE INDEX IX_Relationship32 ON post_comments (user_id)
;



CREATE TABLE post_comment_likes
(
  id Int NOT NULL AUTO_INCREMENT,
  date Timestamp NOT NULL,
  user_id Int NOT NULL,
  comment_id Int NOT NULL,
  PRIMARY KEY (id)
)
;

CREATE INDEX IX_Relationship29 ON post_comment_likes (user_id)
;

CREATE INDEX IX_Relationship33 ON post_comment_likes (comment_id)
;



ALTER TABLE channels ADD CONSTRAINT Relationship7 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE subscriptions ADD CONSTRAINT Relationship8 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE subscriptions ADD CONSTRAINT Relationship9 FOREIGN KEY (channel_id) REFERENCES channels (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE videos ADD CONSTRAINT Relationship10 FOREIGN KEY (channel_id) REFERENCES channels (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE video_likes ADD CONSTRAINT Relationship11 FOREIGN KEY (video_id) REFERENCES videos (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE video_likes ADD CONSTRAINT Relationship13 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE video_dislikes ADD CONSTRAINT Relationship14 FOREIGN KEY (video_id) REFERENCES videos (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE video_dislikes ADD CONSTRAINT Relationship15 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE playlists ADD CONSTRAINT Relationship16 FOREIGN KEY (channel_id) REFERENCES channels (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE playlists_videos ADD CONSTRAINT Relationship18 FOREIGN KEY (playlist_id) REFERENCES playlists (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE playlists_videos ADD CONSTRAINT Relationship19 FOREIGN KEY (video_id) REFERENCES videos (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE video_comment_likes ADD CONSTRAINT Relationship20 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE video_comment_likes ADD CONSTRAINT Relationship21 FOREIGN KEY (comment_id) REFERENCES video_comments (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE video_comments ADD CONSTRAINT Relationship22 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE video_comments ADD CONSTRAINT Relationship23 FOREIGN KEY (video_id) REFERENCES videos (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE post_likes ADD CONSTRAINT Relationship24 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE post_likes ADD CONSTRAINT Relationship25 FOREIGN KEY (post_id) REFERENCES posts (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE posts ADD CONSTRAINT Relationship28 FOREIGN KEY (channel_id) REFERENCES channels (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE post_comment_likes ADD CONSTRAINT Relationship29 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE post_comments ADD CONSTRAINT Relationship31 FOREIGN KEY (post_id) REFERENCES posts (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE post_comments ADD CONSTRAINT Relationship32 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE post_comment_likes ADD CONSTRAINT Relationship33 FOREIGN KEY (comment_id) REFERENCES post_comments (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;


