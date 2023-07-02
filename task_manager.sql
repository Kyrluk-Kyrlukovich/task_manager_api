-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 02 2023 г., 15:09
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `task_meneger`
--

-- --------------------------------------------------------

--
-- Структура таблицы `channels`
--

CREATE TABLE `channels` (
  `id_channel` bigint UNSIGNED NOT NULL,
  `name_channel` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `channels`
--

INSERT INTO `channels` (`id_channel`, `name_channel`) VALUES
(1, 'Тестировка'),
(10, 'Создание канала'),
(11, 'test'),
(13, 'zxvzxcv'),
(14, 'sadfgsa'),
(15, '3543'),
(16, 'qqqqq'),
(19, 'asdasdasd');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2014_10_12_000000_create_users_table', 1),
(6, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(614, 'App\\Models\\User', 4, 'api', '435053a0e2d3c5bb86a17686415905740d3cf4b856e4efdbfee66ef19fd572e7', '[\"*\"]', '2023-06-18 06:40:35', NULL, '2023-06-18 06:40:19', '2023-06-18 06:40:35'),
(828, 'App\\Models\\User', 3, 'api', '147a09444f8288eef6529b4dd83d10e5ec6fdafdd0a0ca09dd56a46ee9496260', '[\"*\"]', NULL, NULL, '2023-07-02 07:05:31', '2023-07-02 07:05:31'),
(854, 'App\\Models\\User', 1, 'api', '18e2c2a4c840064309178637e7d13715178304643e4823fd6bb3ecab2478c984', '[\"*\"]', '2023-07-02 08:51:59', NULL, '2023-07-02 08:51:56', '2023-07-02 08:51:59');

-- --------------------------------------------------------

--
-- Структура таблицы `statuses`
--

CREATE TABLE `statuses` (
  `id_status` bigint UNSIGNED NOT NULL,
  `name_status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `statuses`
--

INSERT INTO `statuses` (`id_status`, `name_status`) VALUES
(1, 'Срочно и важно'),
(2, 'Срочно, но не важно'),
(3, 'Важно, но не срочно'),
(4, 'Не важно и не срочно');

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id_task` bigint UNSIGNED NOT NULL,
  `text_task` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `head_task` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_publication` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_start` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `id_status` bigint UNSIGNED NOT NULL,
  `id_task_color` bigint UNSIGNED NOT NULL,
  `id_user_channel` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id_task`, `text_task`, `head_task`, `date_publication`, `date_start`, `date_end`, `id_status`, `id_task_color`, `id_user_channel`) VALUES
(1, 'Создание API для проверки фронта', 'Создание API', '2023-04-19 17:17:44', '2023-04-19 19:16:00', '2023-04-20 19:16:00', 1, 1, 1),
(17, 'Проверка создания задачи для API', 'Создание задачи', '2023-04-19 20:13:09', '2023-04-19 22:30:00', '2023-04-19 22:30:00', 1, 1, 1),
(19, 'Проверка обновления задачи', 'Update TaskS', '2023-04-30 14:19:27', '1970-01-01 00:00:00', '2023-04-30 16:18:10', 2, 3, 1),
(24, 'NextMonth', 'Следующий месяц', '2023-05-11 17:00:10', '2023-05-11 17:00:10', '2023-05-17 17:00:10', 1, 1, 1),
(28, 'asdfasdfasdfsdf', 'JFDLKSDKfj', '2023-05-01 15:04:27', '2023-04-01 12:00:00', NULL, 1, 1, 1),
(29, 'LEEEEEEEEE', 'LEEEe', '2023-05-06 12:55:46', '2023-05-07 13:00:00', NULL, 2, 3, 1),
(30, 'asdfsdafsadfqer', 'zxcvxzcvxzcv', '2023-05-09 10:42:47', '2023-04-09 12:00:00', NULL, 1, 10, 1),
(31, 'fgsdfgsdfgdsg', 'zxcvbvcb', '2023-05-09 10:50:25', '2023-05-09 12:00:00', NULL, 1, 1, 1),
(32, 'test', 'testTRY', '2023-05-09 10:59:15', '2023-05-09 01:00:00', NULL, 1, 8, 1),
(34, 'asdfsadfsadfssadf', 'asdfghjklmhgfdrtyuioh', '2023-05-09 11:11:15', '2023-05-11 05:30:00', NULL, 2, 9, 1),
(35, 'nnnnnnnnnnnnnnnnnnn', 'jl;jljl;jlkjljk', '2023-05-11 11:34:01', '2023-05-11 12:00:00', NULL, 1, 2, 2),
(50, '12345677', 'adsfsdafsdfdsf', '2023-06-26 16:27:56', '2023-06-26 12:00:00', NULL, 1, 1, 1),
(51, '333333333333333333', '22222222222222222', '2023-06-26 16:49:07', '2023-06-26 01:30:00', NULL, 1, 2, 1),
(52, 'gggggggggg', '44444', '2023-06-26 16:55:13', '2023-06-26 02:00:00', NULL, 1, 8, 1),
(53, '3456', '123', '2023-06-26 16:58:02', '2023-06-26 03:00:00', NULL, 1, 1, 1),
(54, '123123', '123', '2023-06-26 17:03:06', '2023-06-26 02:30:00', NULL, 1, 1, 1),
(59, 'dsfgsdfgsdfg', 'dsfgdsgdsf', '2023-07-01 14:29:49', '2023-07-01 12:00:00', NULL, 1, 1, 22),
(60, 'asdf', 'safdsafas', '2023-07-01 16:14:37', '2023-07-01 02:00:00', NULL, 1, 1, 23),
(61, 'sadfsa', 'sadfasdf', '2023-07-01 16:14:42', '2023-07-01 12:00:00', NULL, 1, 1, 23),
(62, 'safdsadf', 'sadfdsaf', '2023-07-01 16:14:46', '2023-07-01 12:00:00', NULL, 1, 1, 23),
(63, 'sadfasfsadf', 'dasfsadf', '2023-07-01 16:15:42', '2023-06-26 12:00:00', NULL, 1, 1, 23),
(64, 'fsdfasfs', '13515', '2023-07-01 16:15:59', '2023-07-04 12:00:00', NULL, 1, 1, 24),
(65, '123131231', '124134245', '2023-07-01 16:18:14', '2024-12-07 12:00:00', NULL, 1, 1, 23);

-- --------------------------------------------------------

--
-- Структура таблицы `task_colors`
--

CREATE TABLE `task_colors` (
  `id_color` bigint UNSIGNED NOT NULL,
  `name_color` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag_color` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `task_colors`
--

INSERT INTO `task_colors` (`id_color`, `name_color`, `tag_color`) VALUES
(1, 'black', '000000'),
(2, 'red', '8B0000'),
(3, 'green', '008000'),
(8, 'orange', 'FFA500'),
(9, 'blue', '1E90FF'),
(10, 'purple', '800080');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_user` bigint UNSIGNED NOT NULL,
  `first_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_user` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `patronomic` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `first_name`, `last_name`, `email`, `password`, `phone_user`, `patronomic`, `remember_token`) VALUES
(1, 'Алексей', 'Васильев', '12345@yand.com', '$2y$10$o82Z4JJpsALZCiB0IDbWF.03eQTKsSjyxmIClOYeQRSBUZzsQarBS', '8999111777', NULL, 'UBzcK4DKRaZ2yQejIvIWKgPTSRDK4uiDzhMEWyalyivDC68UM721WbcUiw21'),
(3, 'Leee', 'Iuuuuuu', '12345678w@yand.com', '$2y$10$LBGwqyj0QzvX8w4grDLU3.IlknWtHyB0euWP1mLwNhwwsJxAIZDlG', '1232423', NULL, '4pW2MK00bbIxykiqiV43AUmZNNvtiLYNTwoXniHgNdOFodxbUn6egrW2J8zv'),
(4, 'Alexex', 'Vasilev', '123w@yand.com', '$2y$10$vtzOcfX1cOAOGy2PPIAve.9Dvsl9Mu47txmfA4FVgCI4PDwoxR5VO', '8999111333', NULL, NULL),
(5, 'aydar', 'sarmanov', 'reeeee@gmail.com', '12345', '89008977890', 'vladilenovich', NULL),
(6, 'repa', 'repkin', '1234567qweqw8w@yand.com', '12345', '222222', 'asdasdasd', NULL),
(7, 'leaveFromChannel', 'Leaving', '11w@yand.com', '$2y$10$cQrcuGxgqaX.gYgmgoqvt.YR5W0r8Anme4AbMSX/97Lrzswpg1Zum', '89999999', NULL, NULL),
(8, 'sdfasas', 'asdgvsfdsa', 'd2asfasf@gmail.com', '$2y$10$d/0vMG9tDPjCYL4UnFFyceVOYELDrnXwPBriS3As2ZjSTG2kvdkcm', '436252354', NULL, NULL),
(9, 'fsadf', 'asfa', '123@cock.li', '$2y$10$71epk0Meg1GboSPJzu..E.eNtIjmEhC9aBhYaweOwLagy8CuFr0tO', '124124143123', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `user_channel`
--

CREATE TABLE `user_channel` (
  `id_user_channel` bigint UNSIGNED NOT NULL,
  `name_role` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `creator` tinyint(1) NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `id_channel` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user_channel`
--

INSERT INTO `user_channel` (`id_user_channel`, `name_role`, `creator`, `id_user`, `id_channel`) VALUES
(1, 'сотрудник', 1, 1, 1),
(2, 'creator', 1, 1, 10),
(13, 'Администратор', 1, 1, 11),
(22, 'Администратор', 1, 8, 13),
(23, 'Администратор', 1, 9, 14),
(24, 'Администратор', 1, 9, 15),
(25, 'Администратор', 1, 1, 16),
(28, 'Администратор', 1, 3, 19),
(31, 'Участник', 0, 3, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user_channel_functions`
--

CREATE TABLE `user_channel_functions` (
  `id` bigint UNSIGNED NOT NULL,
  `id_user_channel` bigint UNSIGNED NOT NULL,
  `id_user_function` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user_channel_functions`
--

INSERT INTO `user_channel_functions` (`id`, `id_user_channel`, `id_user_function`) VALUES
(8, 1, 7),
(15, 2, 2),
(16, 13, 2),
(17, 1, 2),
(29, 22, 2),
(30, 23, 2),
(31, 24, 2),
(32, 25, 2),
(35, 28, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `user_functions`
--

CREATE TABLE `user_functions` (
  `id_user_functions` bigint UNSIGNED NOT NULL,
  `name_function` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `function` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user_functions`
--

INSERT INTO `user_functions` (`id_user_functions`, `name_function`, `function`) VALUES
(1, 'Добавление задач', 'add_task'),
(2, 'Все действия', 'all_functions'),
(3, 'Добавление пользователя', 'add_user'),
(4, 'Редактирование задач', 'edit_task'),
(5, 'Удаление пользователя из канала', 'remove_user'),
(6, 'Удаление задачи', 'remove_task'),
(7, 'Только просмотр', 'watch_channel');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `channels`
--
ALTER TABLE `channels`
  ADD PRIMARY KEY (`id_channel`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id_status`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id_task`),
  ADD KEY `id_status` (`id_status`),
  ADD KEY `id_task_color` (`id_task_color`),
  ADD KEY `id_user_channel` (`id_user_channel`);

--
-- Индексы таблицы `task_colors`
--
ALTER TABLE `task_colors`
  ADD PRIMARY KEY (`id_color`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- Индексы таблицы `user_channel`
--
ALTER TABLE `user_channel`
  ADD PRIMARY KEY (`id_user_channel`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_channel` (`id_channel`);

--
-- Индексы таблицы `user_channel_functions`
--
ALTER TABLE `user_channel_functions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user_channel` (`id_user_channel`),
  ADD KEY `id_user_function` (`id_user_function`);

--
-- Индексы таблицы `user_functions`
--
ALTER TABLE `user_functions`
  ADD PRIMARY KEY (`id_user_functions`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `channels`
--
ALTER TABLE `channels`
  MODIFY `id_channel` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=855;

--
-- AUTO_INCREMENT для таблицы `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id_status` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id_task` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT для таблицы `task_colors`
--
ALTER TABLE `task_colors`
  MODIFY `id_color` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `user_channel`
--
ALTER TABLE `user_channel`
  MODIFY `id_user_channel` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT для таблицы `user_channel_functions`
--
ALTER TABLE `user_channel_functions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT для таблицы `user_functions`
--
ALTER TABLE `user_functions`
  MODIFY `id_user_functions` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`id_status`) REFERENCES `statuses` (`id_status`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`id_task_color`) REFERENCES `task_colors` (`id_color`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tasks_ibfk_3` FOREIGN KEY (`id_user_channel`) REFERENCES `user_channel` (`id_user_channel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user_channel`
--
ALTER TABLE `user_channel`
  ADD CONSTRAINT `user_channel_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_channel_ibfk_2` FOREIGN KEY (`id_channel`) REFERENCES `channels` (`id_channel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user_channel_functions`
--
ALTER TABLE `user_channel_functions`
  ADD CONSTRAINT `user_channel_functions_ibfk_1` FOREIGN KEY (`id_user_function`) REFERENCES `user_functions` (`id_user_functions`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_channel_functions_ibfk_2` FOREIGN KEY (`id_user_channel`) REFERENCES `user_channel` (`id_user_channel`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
