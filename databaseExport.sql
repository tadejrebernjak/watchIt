-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Gostitelj: 127.0.0.1
-- Čas nastanka: 11. okt 2021 ob 12.20
-- Različica strežnika: 10.4.18-MariaDB
-- Različica PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Zbirka podatkov: `youtube`
--

-- --------------------------------------------------------

--
-- Struktura tabele `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_slovenian_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovenian_ci;

--
-- Odloži podatke za tabelo `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$BbqgiDxWqXv7IDghfX6hOuR8MQKta7WcCwfZLm3l29BRdvK.8PV3C');

-- --------------------------------------------------------

--
-- Struktura tabele `channels`
--

CREATE TABLE `channels` (
  `id` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_slovenian_ci NOT NULL,
  `subscribers` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `banner_picture_url` varchar(255) COLLATE utf8mb4_slovenian_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_slovenian_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovenian_ci;

--
-- Odloži podatke za tabelo `channels`
--

INSERT INTO `channels` (`id`, `url`, `subscribers`, `views`, `banner_picture_url`, `description`, `user_id`) VALUES
(2, '', 0, 309, 'media/uploads/images/202110091136412design-youtube-banner-art.jpg', 'description description description description description description description description description description description description description description description description description description description description description description description description description ', 2),
(3, '', 0, 177, NULL, NULL, 3),
(4, '', 0, 12, 'media/uploads/images/202110102200204thumb-1920-1041382.png', 'test', 4);

-- --------------------------------------------------------

--
-- Struktura tabele `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) NOT NULL,
  `channel_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovenian_ci;

--
-- Odloži podatke za tabelo `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `date`, `user_id`, `channel_id`) VALUES
(8, '2021-10-09 19:09:15', 2, 3),
(9, '2021-10-09 19:34:08', 4, 2),
(10, '2021-10-09 19:54:06', 2, 4),
(11, '2021-10-09 19:57:19', 3, 2);

-- --------------------------------------------------------

--
-- Struktura tabele `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_slovenian_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_slovenian_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_slovenian_ci NOT NULL,
  `profile_picture_url` varchar(255) COLLATE utf8mb4_slovenian_ci DEFAULT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovenian_ci;

--
-- Odloži podatke za tabelo `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `profile_picture_url`, `creation_date`) VALUES
(2, 'Tadej', '$2y$10$Bx8ZQtw9Yjc2xR2XM6W4EO2aJmQdhCZBKWhJi3mYFmmamzaT8U.oy', 'tadej.rebernjak@scv.si', 'media/uploads/images/202110070849452obito.jpg', '2021-09-25 16:49:19'),
(3, 'joedoe', '$2y$10$dZZP1nohdg3SjgthxmBjOu7rODp.57eNBNoKS3HTPHEsnEfLJTnVS', 'joe.doe@gmail.com', NULL, '2021-10-04 07:08:18'),
(4, 'developer', '$2y$10$PJf8ewJLg1qnxZCiby4fK.4GVTeSWeKV4.c7wuGIyd5sE2ZDKVHum', 'tadej.rebernjak1@gmail.com', NULL, '2021-10-09 19:22:21');

-- --------------------------------------------------------

--
-- Struktura tabele `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `video_url` char(255) COLLATE utf8mb4_slovenian_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_slovenian_ci NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_slovenian_ci NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `description` text COLLATE utf8mb4_slovenian_ci DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `listed` int(1) NOT NULL DEFAULT 0,
  `channel_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovenian_ci;

--
-- Odloži podatke za tabelo `videos`
--

INSERT INTO `videos` (`id`, `video_url`, `thumbnail`, `title`, `upload_date`, `description`, `views`, `listed`, `channel_id`) VALUES
(2, 'media/uploads/videos/202109281205042tetris_flipbook.mp4', 'media/uploads/thumbnails/202109281205042IMG_20210927_203209.jpg', 'Tetris Flip-Book', '2021-09-28 10:05:04', 'multimedia project', 314, 1, 2),
(3, 'media/uploads/videos/202110041404463vlc-record-2019-12-22-22h31m56s-videoplayback (2).mp4-.mp4', 'media/uploads/thumbnails/2021100414044632021-10-04_14-00-47.png', 'Whaa', '2021-10-04 12:04:46', 'description description description description <br />\r\n<br />\r\ndescription description description description description description description description description description description description description description description description description description ', 32, 1, 3),
(4, 'media/uploads/videos/202110051251482flipbook_animation_v1.mp4', 'media/uploads/thumbnails/20211005125148249.jpg', 'Tetris flipbook new edit', '2021-10-05 10:51:48', 'tetris tetris tetris tetris tetris tetris tetris tetris tetris tetris tetris tetris ', 18, 1, 2),
(11, 'media/uploads/videos/202110092117572anejflipbook.mp4', '', 'Anej\'s epic flip book', '2021-10-09 19:17:57', 'amazing<br />\r\n<br />\r\n10/10', 4, 1, 2),
(12, 'media/uploads/videos/2021100921235542021-10-07 00-04-47.mp4', '', 'dev preview', '2021-10-09 19:23:55', '', 15, 1, 4),
(13, 'media/uploads/videos/2021100921242442021-10-07 10-57-48.mp4', '', 'dev preview 2', '2021-10-09 19:24:24', '', 0, 1, 4),
(14, 'media/uploads/videos/2021100921243942021-10-07 13-06-33.mp4', 'media/uploads/thumbnails/20211010222314Untitled.png', 'dev preview 3', '2021-10-09 19:24:39', 'development of sidebar', 2, 1, 4);

-- --------------------------------------------------------

--
-- Struktura tabele `video_comments`
--

CREATE TABLE `video_comments` (
  `id` int(11) NOT NULL,
  `comment` text COLLATE utf8mb4_slovenian_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `edited` int(1) NOT NULL DEFAULT 0,
  `edit_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `user_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovenian_ci;

--
-- Odloži podatke za tabelo `video_comments`
--

INSERT INTO `video_comments` (`id`, `comment`, `date`, `edited`, `edit_date`, `user_id`, `video_id`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, ligula ullamcorper auctor accumsan, lacus ex tincidunt sem, quis semper mauris erat et lectus. Donec facilisis massa convallis pellentesque ullamcorper. Maecenas nec nunc vel mauris molestie placerat. Nam tincidunt elit vitae tortor sollicitudin, a viverra nisl aliquet. Nunc eu mauris malesuada, vulputate est at, cursus erat. Fusce nisi tortor, auctor non dolor ac, molestie fermentum tortor. Nullam vitae neque ut metus aliquam volutpat sed at lacus.', '2021-09-30 11:10:28', 0, NULL, 2, 2),
(2, 'Very cool!', '2021-10-04 10:31:04', 1, '2021-10-04 11:28:12', 2, 2),
(4, 'test<br />\nwaw<br />\n<br />\nedited text here', '2021-10-01 09:07:40', 1, '2021-10-04 10:40:27', 2, 2),
(8, 'hmm', '2021-10-01 09:14:59', 0, NULL, 2, 2),
(10, 'epic', '2021-10-04 07:08:55', 0, NULL, 3, 2),
(12, 'whaaa', '2021-10-04 12:05:10', 0, NULL, 3, 3),
(14, 'dwdwd', '2021-10-08 11:55:59', 0, NULL, 2, 3),
(15, 'dwadwa', '2021-10-09 19:59:01', 1, '2021-10-09 19:59:49', 2, 12),
(16, 'woah', '2021-10-09 20:04:21', 0, NULL, 4, 2);

-- --------------------------------------------------------

--
-- Struktura tabele `video_comment_likes`
--

CREATE TABLE `video_comment_likes` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovenian_ci;

--
-- Odloži podatke za tabelo `video_comment_likes`
--

INSERT INTO `video_comment_likes` (`id`, `date`, `user_id`, `comment_id`) VALUES
(24, '2021-10-04 07:08:43', 3, 8),
(25, '2021-10-04 08:55:10', 2, 10),
(44, '2021-10-09 20:08:33', 4, 10),
(47, '2021-10-09 20:08:51', 4, 4);

-- --------------------------------------------------------

--
-- Struktura tabele `video_dislikes`
--

CREATE TABLE `video_dislikes` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `video_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovenian_ci;

--
-- Odloži podatke za tabelo `video_dislikes`
--

INSERT INTO `video_dislikes` (`id`, `date`, `video_id`, `user_id`) VALUES
(22, '2021-10-04 07:09:01', 2, 3);

-- --------------------------------------------------------

--
-- Struktura tabele `video_likes`
--

CREATE TABLE `video_likes` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `video_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovenian_ci;

--
-- Odloži podatke za tabelo `video_likes`
--

INSERT INTO `video_likes` (`id`, `date`, `video_id`, `user_id`) VALUES
(1898, '2021-10-04 12:05:08', 3, 3),
(1900, '2021-10-04 14:56:14', 3, 2),
(1903, '2021-10-07 06:49:07', 2, 2),
(1904, '2021-10-09 19:57:56', 12, 2),
(1905, '2021-10-09 20:17:23', 2, 4);

--
-- Indeksi zavrženih tabel
--

--
-- Indeksi tabele `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indeksi tabele `channels`
--
ALTER TABLE `channels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IX_Relationship7` (`user_id`);

--
-- Indeksi tabele `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IX_Relationship8` (`user_id`),
  ADD KEY `IX_Relationship9` (`channel_id`);

--
-- Indeksi tabele `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeksi tabele `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IX_Relationship10` (`channel_id`);

--
-- Indeksi tabele `video_comments`
--
ALTER TABLE `video_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IX_Relationship22` (`user_id`),
  ADD KEY `IX_Relationship23` (`video_id`);

--
-- Indeksi tabele `video_comment_likes`
--
ALTER TABLE `video_comment_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IX_Relationship20` (`user_id`),
  ADD KEY `IX_Relationship21` (`comment_id`);

--
-- Indeksi tabele `video_dislikes`
--
ALTER TABLE `video_dislikes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IX_Relationship14` (`video_id`),
  ADD KEY `IX_Relationship15` (`user_id`);

--
-- Indeksi tabele `video_likes`
--
ALTER TABLE `video_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IX_Relationship11` (`video_id`),
  ADD KEY `IX_Relationship13` (`user_id`);

--
-- AUTO_INCREMENT zavrženih tabel
--

--
-- AUTO_INCREMENT tabele `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT tabele `channels`
--
ALTER TABLE `channels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT tabele `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT tabele `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT tabele `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT tabele `video_comments`
--
ALTER TABLE `video_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT tabele `video_comment_likes`
--
ALTER TABLE `video_comment_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT tabele `video_dislikes`
--
ALTER TABLE `video_dislikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT tabele `video_likes`
--
ALTER TABLE `video_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1906;

--
-- Omejitve tabel za povzetek stanja
--

--
-- Omejitve za tabelo `channels`
--
ALTER TABLE `channels`
  ADD CONSTRAINT `Relationship7` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omejitve za tabelo `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `Relationship8` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Relationship9` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omejitve za tabelo `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `Relationship10` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omejitve za tabelo `video_comments`
--
ALTER TABLE `video_comments`
  ADD CONSTRAINT `Relationship22` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Relationship23` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omejitve za tabelo `video_comment_likes`
--
ALTER TABLE `video_comment_likes`
  ADD CONSTRAINT `Relationship20` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Relationship21` FOREIGN KEY (`comment_id`) REFERENCES `video_comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omejitve za tabelo `video_dislikes`
--
ALTER TABLE `video_dislikes`
  ADD CONSTRAINT `Relationship14` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Relationship15` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omejitve za tabelo `video_likes`
--
ALTER TABLE `video_likes`
  ADD CONSTRAINT `Relationship11` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Relationship13` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
