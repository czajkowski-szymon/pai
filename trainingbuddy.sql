/*
 Navicat Premium Data Transfer

 Source Server         : pai
 Source Server Type    : PostgreSQL
 Source Server Version : 160001 (160001)
 Source Host           : localhost:5433
 Source Catalog        : db
 Source Schema         : db

 Target Server Type    : PostgreSQL
 Target Server Version : 160001 (160001)
 File Encoding         : 65001

 Date: 30/01/2024 15:29:20
*/


-- ----------------------------
-- Sequence structure for city_city_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "db"."city_city_id_seq";
CREATE SEQUENCE "db"."city_city_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for rating_rating_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "db"."rating_rating_id_seq";
CREATE SEQUENCE "db"."rating_rating_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for role_id_role_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "db"."role_id_role_seq";
CREATE SEQUENCE "db"."role_id_role_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for sport_sport_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "db"."sport_sport_id_seq";
CREATE SEQUENCE "db"."sport_sport_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for training_id_training_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "db"."training_id_training_seq";
CREATE SEQUENCE "db"."training_id_training_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for user_details_user_details_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "db"."user_details_user_details_id_seq";
CREATE SEQUENCE "db"."user_details_user_details_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for user_sport_user_sport_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "db"."user_sport_user_sport_id_seq";
CREATE SEQUENCE "db"."user_sport_user_sport_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for user_user_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "db"."user_user_id_seq";
CREATE SEQUENCE "db"."user_user_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Table structure for city
-- ----------------------------
DROP TABLE IF EXISTS "db"."city";
CREATE TABLE "db"."city" (
  "city_id" int8 NOT NULL GENERATED ALWAYS AS IDENTITY (
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1
),
  "name" text COLLATE "pg_catalog"."default" NOT NULL
)
;

-- ----------------------------
-- Records of city
-- ----------------------------
INSERT INTO "db"."city" OVERRIDING SYSTEM VALUE VALUES (1, 'Warszawa');
INSERT INTO "db"."city" OVERRIDING SYSTEM VALUE VALUES (2, 'Krakow');
INSERT INTO "db"."city" OVERRIDING SYSTEM VALUE VALUES (3, 'Wroclaw');
INSERT INTO "db"."city" OVERRIDING SYSTEM VALUE VALUES (4, 'Katowice');
INSERT INTO "db"."city" OVERRIDING SYSTEM VALUE VALUES (5, 'Lodz');
INSERT INTO "db"."city" OVERRIDING SYSTEM VALUE VALUES (6, 'Tarnow');
INSERT INTO "db"."city" OVERRIDING SYSTEM VALUE VALUES (7, 'Rzeszow');
INSERT INTO "db"."city" OVERRIDING SYSTEM VALUE VALUES (8, 'Poznan');
INSERT INTO "db"."city" OVERRIDING SYSTEM VALUE VALUES (9, 'Gdansk');
INSERT INTO "db"."city" OVERRIDING SYSTEM VALUE VALUES (10, 'Szczecin');
INSERT INTO "db"."city" OVERRIDING SYSTEM VALUE VALUES (11, 'Lublin');
INSERT INTO "db"."city" OVERRIDING SYSTEM VALUE VALUES (12, 'Bydgoszcz');
INSERT INTO "db"."city" OVERRIDING SYSTEM VALUE VALUES (13, 'Bialystok');
INSERT INTO "db"."city" OVERRIDING SYSTEM VALUE VALUES (14, 'Gdynia');

-- ----------------------------
-- Table structure for rating
-- ----------------------------
DROP TABLE IF EXISTS "db"."rating";
CREATE TABLE "db"."rating" (
  "rating_id" int8 NOT NULL GENERATED ALWAYS AS IDENTITY (
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1
),
  "rated_user_id" int8 NOT NULL,
  "rating_user_id" int8 NOT NULL,
  "rating_type" text COLLATE "pg_catalog"."default" NOT NULL
)
;

-- ----------------------------
-- Records of rating
-- ----------------------------
INSERT INTO "db"."rating" OVERRIDING SYSTEM VALUE VALUES (237, 53, 59, 'like');
INSERT INTO "db"."rating" OVERRIDING SYSTEM VALUE VALUES (238, 54, 59, 'like');
INSERT INTO "db"."rating" OVERRIDING SYSTEM VALUE VALUES (239, 55, 59, 'dislike');
INSERT INTO "db"."rating" OVERRIDING SYSTEM VALUE VALUES (240, 56, 59, 'like');
INSERT INTO "db"."rating" OVERRIDING SYSTEM VALUE VALUES (241, 57, 59, 'dislike');
INSERT INTO "db"."rating" OVERRIDING SYSTEM VALUE VALUES (242, 58, 59, 'like');
INSERT INTO "db"."rating" OVERRIDING SYSTEM VALUE VALUES (243, 53, 56, 'dislike');
INSERT INTO "db"."rating" OVERRIDING SYSTEM VALUE VALUES (244, 54, 56, 'like');
INSERT INTO "db"."rating" OVERRIDING SYSTEM VALUE VALUES (245, 55, 56, 'like');
INSERT INTO "db"."rating" OVERRIDING SYSTEM VALUE VALUES (246, 57, 56, 'dislike');
INSERT INTO "db"."rating" OVERRIDING SYSTEM VALUE VALUES (247, 58, 56, 'like');
INSERT INTO "db"."rating" OVERRIDING SYSTEM VALUE VALUES (248, 59, 56, 'like');
INSERT INTO "db"."rating" OVERRIDING SYSTEM VALUE VALUES (249, 53, 54, 'dislike');
INSERT INTO "db"."rating" OVERRIDING SYSTEM VALUE VALUES (250, 55, 54, 'like');
INSERT INTO "db"."rating" OVERRIDING SYSTEM VALUE VALUES (251, 56, 54, 'dislike');
INSERT INTO "db"."rating" OVERRIDING SYSTEM VALUE VALUES (252, 57, 54, 'like');
INSERT INTO "db"."rating" OVERRIDING SYSTEM VALUE VALUES (253, 58, 54, 'dislike');
INSERT INTO "db"."rating" OVERRIDING SYSTEM VALUE VALUES (254, 59, 54, 'like');
INSERT INTO "db"."rating" OVERRIDING SYSTEM VALUE VALUES (255, 54, 58, 'like');
INSERT INTO "db"."rating" OVERRIDING SYSTEM VALUE VALUES (256, 53, 58, 'like');
INSERT INTO "db"."rating" OVERRIDING SYSTEM VALUE VALUES (257, 56, 58, 'like');
INSERT INTO "db"."rating" OVERRIDING SYSTEM VALUE VALUES (258, 59, 58, 'dislike');
INSERT INTO "db"."rating" OVERRIDING SYSTEM VALUE VALUES (259, 54, 55, 'dislike');
INSERT INTO "db"."rating" OVERRIDING SYSTEM VALUE VALUES (260, 53, 55, 'like');
INSERT INTO "db"."rating" OVERRIDING SYSTEM VALUE VALUES (261, 57, 55, 'dislike');
INSERT INTO "db"."rating" OVERRIDING SYSTEM VALUE VALUES (262, 58, 55, 'like');
INSERT INTO "db"."rating" OVERRIDING SYSTEM VALUE VALUES (263, 59, 55, 'like');
INSERT INTO "db"."rating" OVERRIDING SYSTEM VALUE VALUES (265, 56, 55, 'dislike');

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS "db"."role";
CREATE TABLE "db"."role" (
  "role_id" int8 NOT NULL GENERATED ALWAYS AS IDENTITY (
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1
),
  "name" text COLLATE "pg_catalog"."default" NOT NULL
)
;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO "db"."role" OVERRIDING SYSTEM VALUE VALUES (1, 'admin');
INSERT INTO "db"."role" OVERRIDING SYSTEM VALUE VALUES (2, 'user');

-- ----------------------------
-- Table structure for sport
-- ----------------------------
DROP TABLE IF EXISTS "db"."sport";
CREATE TABLE "db"."sport" (
  "sport_id" int8 NOT NULL GENERATED ALWAYS AS IDENTITY (
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1
),
  "name" text COLLATE "pg_catalog"."default" NOT NULL
)
;

-- ----------------------------
-- Records of sport
-- ----------------------------
INSERT INTO "db"."sport" OVERRIDING SYSTEM VALUE VALUES (1, 'Football');
INSERT INTO "db"."sport" OVERRIDING SYSTEM VALUE VALUES (2, 'Volleyball');
INSERT INTO "db"."sport" OVERRIDING SYSTEM VALUE VALUES (3, 'Basketball');
INSERT INTO "db"."sport" OVERRIDING SYSTEM VALUE VALUES (5, 'Crossfit');
INSERT INTO "db"."sport" OVERRIDING SYSTEM VALUE VALUES (6, 'Jogging');
INSERT INTO "db"."sport" OVERRIDING SYSTEM VALUE VALUES (7, 'Cycling');
INSERT INTO "db"."sport" OVERRIDING SYSTEM VALUE VALUES (8, 'Fitness');
INSERT INTO "db"."sport" OVERRIDING SYSTEM VALUE VALUES (9, 'Handball');
INSERT INTO "db"."sport" OVERRIDING SYSTEM VALUE VALUES (10, 'Swimming');
INSERT INTO "db"."sport" OVERRIDING SYSTEM VALUE VALUES (11, 'Tenis');
INSERT INTO "db"."sport" OVERRIDING SYSTEM VALUE VALUES (12, 'Walking');
INSERT INTO "db"."sport" OVERRIDING SYSTEM VALUE VALUES (4, 'Gym');

-- ----------------------------
-- Table structure for training
-- ----------------------------
DROP TABLE IF EXISTS "db"."training";
CREATE TABLE "db"."training" (
  "training_id" int8 NOT NULL GENERATED ALWAYS AS IDENTITY (
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1
),
  "inviting_user_id" int8 NOT NULL,
  "invited_user_id" int8 NOT NULL,
  "date" date NOT NULL,
  "is_accepted" bool NOT NULL
)
;

-- ----------------------------
-- Records of training
-- ----------------------------
INSERT INTO "db"."training" OVERRIDING SYSTEM VALUE VALUES (55, 55, 53, '2024-02-02', 'f');
INSERT INTO "db"."training" OVERRIDING SYSTEM VALUE VALUES (57, 56, 58, '2024-02-08', 'f');
INSERT INTO "db"."training" OVERRIDING SYSTEM VALUE VALUES (59, 56, 55, '2024-02-11', 'f');
INSERT INTO "db"."training" OVERRIDING SYSTEM VALUE VALUES (56, 55, 54, '2024-02-10', 't');
INSERT INTO "db"."training" OVERRIDING SYSTEM VALUE VALUES (60, 54, 53, '2024-02-04', 'f');
INSERT INTO "db"."training" OVERRIDING SYSTEM VALUE VALUES (61, 54, 57, '2024-03-08', 'f');
INSERT INTO "db"."training" OVERRIDING SYSTEM VALUE VALUES (58, 56, 57, '2024-02-03', 't');
INSERT INTO "db"."training" OVERRIDING SYSTEM VALUE VALUES (63, 56, 57, '2024-02-04', 'f');
INSERT INTO "db"."training" OVERRIDING SYSTEM VALUE VALUES (62, 59, 57, '2024-02-08', 't');
INSERT INTO "db"."training" OVERRIDING SYSTEM VALUE VALUES (65, 57, 58, '2024-02-03', 'f');
INSERT INTO "db"."training" OVERRIDING SYSTEM VALUE VALUES (66, 57, 53, '2024-02-08', 'f');
INSERT INTO "db"."training" OVERRIDING SYSTEM VALUE VALUES (64, 55, 57, '2024-01-31', 't');

-- ----------------------------
-- Table structure for user_
-- ----------------------------
DROP TABLE IF EXISTS "db"."user_";
CREATE TABLE "db"."user_" (
  "user_id" int8 NOT NULL GENERATED ALWAYS AS IDENTITY (
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1
),
  "email" text COLLATE "pg_catalog"."default" NOT NULL,
  "password" text COLLATE "pg_catalog"."default" NOT NULL,
  "role_id" int8 DEFAULT 2
)
;

-- ----------------------------
-- Records of user_
-- ----------------------------
INSERT INTO "db"."user_" OVERRIDING SYSTEM VALUE VALUES (52, 'szymon@gmail.com', '$2y$10$GLCNBrKXlY8Sb13lou5H/eczCwFMoMsHb9esP/FHl21UXUoZl1saK', 1);
INSERT INTO "db"."user_" OVERRIDING SYSTEM VALUE VALUES (53, 'marek@gmail.com', '$2y$10$16gQ.uv2rdbQwYZF7WSTruoyXNqeFgsV0E0/e1uWBm4bdzt9h64N.', 2);
INSERT INTO "db"."user_" OVERRIDING SYSTEM VALUE VALUES (54, 'kamila@gmail.com', '$2y$10$o.06rxLX/OOCdMXaG7T8/.uaidESwEEf4zRZoZ5q21VDOGEGdmb7G', 2);
INSERT INTO "db"."user_" OVERRIDING SYSTEM VALUE VALUES (55, 'emilia@gmail.com', '$2y$10$84BcyojzFvfi0/347ehus.0zLm.OJB68rCfb6lAnp9y2E/fmjZPK2', 2);
INSERT INTO "db"."user_" OVERRIDING SYSTEM VALUE VALUES (56, 'jakub@gmail.com', '$2y$10$P0qs.IGfFS12TZq3djdTju8fxoDhI8ACvuSoAs63XOnKIhf0KhYpq', 2);
INSERT INTO "db"."user_" OVERRIDING SYSTEM VALUE VALUES (57, 'karolina@gmail.com', '$2y$10$DCLK5sTdQ.Tnpow.OgfK7ODeaAkVnwztVCcftb/DcDsP6rRfYsElC', 2);
INSERT INTO "db"."user_" OVERRIDING SYSTEM VALUE VALUES (58, 'mateusz@gmail.com', '$2y$10$pk9Q.SGFVI6M9EMOQ92NUOmSf180KEqgauXQtOA5KkdTSoIBRHscW', 2);
INSERT INTO "db"."user_" OVERRIDING SYSTEM VALUE VALUES (59, 'karol@gmail.com', '$2y$10$cU2LOfIC6heLIEY/pecoN.B5wipB/v.agkLbslO9/gUlxczHYJJ4W', 2);

-- ----------------------------
-- Table structure for user_details
-- ----------------------------
DROP TABLE IF EXISTS "db"."user_details";
CREATE TABLE "db"."user_details" (
  "user_details_id" int8 NOT NULL GENERATED ALWAYS AS IDENTITY (
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1
),
  "first_name" text COLLATE "pg_catalog"."default" NOT NULL,
  "photo_url" text COLLATE "pg_catalog"."default" NOT NULL,
  "bio" text COLLATE "pg_catalog"."default" NOT NULL,
  "city_id" int8 NOT NULL,
  "user_id" int8 NOT NULL,
  "likes" int8 NOT NULL DEFAULT 0,
  "dislikes" int8 NOT NULL DEFAULT 0
)
;

-- ----------------------------
-- Records of user_details
-- ----------------------------
INSERT INTO "db"."user_details" OVERRIDING SYSTEM VALUE VALUES (49, 'Kamila', '81.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum id mol.', 1, 54, 3, 1);
INSERT INTO "db"."user_details" OVERRIDING SYSTEM VALUE VALUES (48, 'Marek', '43.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 11, 53, 3, 2);
INSERT INTO "db"."user_details" OVERRIDING SYSTEM VALUE VALUES (50, 'Emilia', '45.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 10, 55, 2, 1);
INSERT INTO "db"."user_details" OVERRIDING SYSTEM VALUE VALUES (53, 'Mateusz', '22.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 5, 58, 3, 1);
INSERT INTO "db"."user_details" OVERRIDING SYSTEM VALUE VALUES (52, 'Karolina', '40.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 4, 57, 1, 3);
INSERT INTO "db"."user_details" OVERRIDING SYSTEM VALUE VALUES (51, 'Jakub', '47.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 13, 56, 2, 2);
INSERT INTO "db"."user_details" OVERRIDING SYSTEM VALUE VALUES (47, 'Szymon', 'f2253-swatch.jpg', 'Administrator', 2, 52, 0, 0);
INSERT INTO "db"."user_details" OVERRIDING SYSTEM VALUE VALUES (54, 'Karol', '82.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 1, 59, 3, 1);

-- ----------------------------
-- Table structure for user_sport
-- ----------------------------
DROP TABLE IF EXISTS "db"."user_sport";
CREATE TABLE "db"."user_sport" (
  "user_sport_id" int8 NOT NULL GENERATED ALWAYS AS IDENTITY (
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1
),
  "user_id" int8 NOT NULL,
  "sport_id" int8 NOT NULL
)
;

-- ----------------------------
-- Records of user_sport
-- ----------------------------
INSERT INTO "db"."user_sport" OVERRIDING SYSTEM VALUE VALUES (93, 52, 1);
INSERT INTO "db"."user_sport" OVERRIDING SYSTEM VALUE VALUES (94, 53, 2);
INSERT INTO "db"."user_sport" OVERRIDING SYSTEM VALUE VALUES (95, 53, 5);
INSERT INTO "db"."user_sport" OVERRIDING SYSTEM VALUE VALUES (96, 53, 8);
INSERT INTO "db"."user_sport" OVERRIDING SYSTEM VALUE VALUES (97, 54, 5);
INSERT INTO "db"."user_sport" OVERRIDING SYSTEM VALUE VALUES (98, 54, 8);
INSERT INTO "db"."user_sport" OVERRIDING SYSTEM VALUE VALUES (99, 55, 5);
INSERT INTO "db"."user_sport" OVERRIDING SYSTEM VALUE VALUES (100, 55, 6);
INSERT INTO "db"."user_sport" OVERRIDING SYSTEM VALUE VALUES (101, 56, 6);
INSERT INTO "db"."user_sport" OVERRIDING SYSTEM VALUE VALUES (102, 56, 8);
INSERT INTO "db"."user_sport" OVERRIDING SYSTEM VALUE VALUES (103, 56, 9);
INSERT INTO "db"."user_sport" OVERRIDING SYSTEM VALUE VALUES (104, 57, 11);
INSERT INTO "db"."user_sport" OVERRIDING SYSTEM VALUE VALUES (105, 57, 12);
INSERT INTO "db"."user_sport" OVERRIDING SYSTEM VALUE VALUES (106, 58, 3);
INSERT INTO "db"."user_sport" OVERRIDING SYSTEM VALUE VALUES (107, 58, 5);
INSERT INTO "db"."user_sport" OVERRIDING SYSTEM VALUE VALUES (108, 59, 3);
INSERT INTO "db"."user_sport" OVERRIDING SYSTEM VALUE VALUES (109, 59, 5);
INSERT INTO "db"."user_sport" OVERRIDING SYSTEM VALUE VALUES (110, 59, 6);

-- ----------------------------
-- Function structure for remove_old_rating
-- ----------------------------
DROP FUNCTION IF EXISTS "db"."remove_old_rating"();
CREATE OR REPLACE FUNCTION "db"."remove_old_rating"()
  RETURNS "pg_catalog"."trigger" AS $BODY$
BEGIN
    DELETE FROM db.rating
    WHERE (rated_user_id, rating_user_id) = (NEW.rated_user_id, NEW.rating_user_id) AND rating_type <> NEW.rating_type;
    RETURN NEW;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;

-- ----------------------------
-- Function structure for update_user_ratings
-- ----------------------------
DROP FUNCTION IF EXISTS "db"."update_user_ratings"();
CREATE OR REPLACE FUNCTION "db"."update_user_ratings"()
  RETURNS "pg_catalog"."trigger" AS $BODY$
BEGIN
    IF NEW.rating_type = 'like' THEN
        UPDATE db.user_details
        SET likes = likes + 1
        WHERE user_id = NEW.rated_user_id;
    ELSIF NEW.rating_type = 'dislike' THEN
        UPDATE db.user_details
        SET dislikes = dislikes + 1
        WHERE user_id = NEW.rated_user_id;
    END IF;
    RETURN NEW;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;

-- ----------------------------
-- Function structure for update_user_ratings_2
-- ----------------------------
DROP FUNCTION IF EXISTS "db"."update_user_ratings_2"();
CREATE OR REPLACE FUNCTION "db"."update_user_ratings_2"()
  RETURNS "pg_catalog"."trigger" AS $BODY$
BEGIN
    IF OLD.rating_type = 'like' THEN
        UPDATE db.user_details
        SET likes = likes - 1
        WHERE user_id = OLD.rated_user_id;
    ELSIF OLD.rating_type = 'dislike' THEN
        UPDATE db.user_details
        SET dislikes = dislikes - 1
        WHERE user_id = OLD.rated_user_id;
    END IF;

    RETURN OLD;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;

-- ----------------------------
-- View structure for users_view
-- ----------------------------
DROP VIEW IF EXISTS "db"."users_view";
CREATE VIEW "db"."users_view" AS  SELECT user_.email,
    user_details.first_name,
    user_details.bio,
    user_details.likes,
    user_details.dislikes,
    city.name AS city_name,
    string_agg(sport.name, ', '::text) AS sport_names
   FROM db.user_
     JOIN db.user_details ON user_.user_id = user_details.user_id
     JOIN db.city ON user_details.city_id = city.city_id
     LEFT JOIN db.user_sport ON user_.user_id = user_sport.user_id
     LEFT JOIN db.sport ON user_sport.sport_id = sport.sport_id
  WHERE user_.role_id <> 1
  GROUP BY user_.email, user_details.first_name, user_details.bio, user_details.likes, user_details.dislikes, city.name;

-- ----------------------------
-- View structure for trainings
-- ----------------------------
DROP VIEW IF EXISTS "db"."trainings";
CREATE VIEW "db"."trainings" AS  SELECT inviting_user.first_name AS inviting_user_name,
    invited_user.first_name AS invited_user_name,
    training.date
   FROM db.training
     JOIN db.user_details inviting_user ON training.inviting_user_id = inviting_user.user_id
     JOIN db.user_details invited_user ON training.invited_user_id = invited_user.user_id;

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "db"."city_city_id_seq"
OWNED BY "db"."city"."city_id";
SELECT setval('"db"."city_city_id_seq"', 14, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "db"."rating_rating_id_seq"
OWNED BY "db"."rating"."rating_id";
SELECT setval('"db"."rating_rating_id_seq"', 272, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "db"."role_id_role_seq"
OWNED BY "db"."role"."role_id";
SELECT setval('"db"."role_id_role_seq"', 2, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "db"."sport_sport_id_seq"
OWNED BY "db"."sport"."sport_id";
SELECT setval('"db"."sport_sport_id_seq"', 12, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "db"."training_id_training_seq"
OWNED BY "db"."training"."training_id";
SELECT setval('"db"."training_id_training_seq"', 66, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "db"."user_details_user_details_id_seq"
OWNED BY "db"."user_details"."user_details_id";
SELECT setval('"db"."user_details_user_details_id_seq"', 55, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "db"."user_sport_user_sport_id_seq"
OWNED BY "db"."user_sport"."user_sport_id";
SELECT setval('"db"."user_sport_user_sport_id_seq"', 112, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "db"."user_user_id_seq"
OWNED BY "db"."user_"."user_id";
SELECT setval('"db"."user_user_id_seq"', 60, true);

-- ----------------------------
-- Auto increment value for city
-- ----------------------------
SELECT setval('"db"."city_city_id_seq"', 14, true);

-- ----------------------------
-- Primary Key structure for table city
-- ----------------------------
ALTER TABLE "db"."city" ADD CONSTRAINT "city_pkey" PRIMARY KEY ("city_id");

-- ----------------------------
-- Auto increment value for rating
-- ----------------------------
SELECT setval('"db"."rating_rating_id_seq"', 272, true);

-- ----------------------------
-- Triggers structure for table rating
-- ----------------------------
CREATE TRIGGER "remove_old_rating_trigger" BEFORE INSERT ON "db"."rating"
FOR EACH ROW
EXECUTE PROCEDURE "db"."remove_old_rating"();
CREATE TRIGGER "update_user_ratings_2" BEFORE DELETE ON "db"."rating"
FOR EACH ROW
EXECUTE PROCEDURE "db"."update_user_ratings_2"();
CREATE TRIGGER "update_user_ratings_trigger" AFTER INSERT ON "db"."rating"
FOR EACH ROW
EXECUTE PROCEDURE "db"."update_user_ratings"();

-- ----------------------------
-- Uniques structure for table rating
-- ----------------------------
ALTER TABLE "db"."rating" ADD CONSTRAINT "rating_rated_user_id_rating_user_id_rating_type_key" UNIQUE ("rated_user_id", "rating_user_id", "rating_type");

-- ----------------------------
-- Primary Key structure for table rating
-- ----------------------------
ALTER TABLE "db"."rating" ADD CONSTRAINT "rating_pkey" PRIMARY KEY ("rating_id");

-- ----------------------------
-- Auto increment value for role
-- ----------------------------
SELECT setval('"db"."role_id_role_seq"', 2, true);

-- ----------------------------
-- Primary Key structure for table role
-- ----------------------------
ALTER TABLE "db"."role" ADD CONSTRAINT "role_pkey" PRIMARY KEY ("role_id");

-- ----------------------------
-- Auto increment value for sport
-- ----------------------------
SELECT setval('"db"."sport_sport_id_seq"', 12, true);

-- ----------------------------
-- Primary Key structure for table sport
-- ----------------------------
ALTER TABLE "db"."sport" ADD CONSTRAINT "sport_pkey" PRIMARY KEY ("sport_id");

-- ----------------------------
-- Auto increment value for training
-- ----------------------------
SELECT setval('"db"."training_id_training_seq"', 66, true);

-- ----------------------------
-- Uniques structure for table training
-- ----------------------------
ALTER TABLE "db"."training" ADD CONSTRAINT "training_inviting_user_id_invited_user_id_date_key" UNIQUE ("inviting_user_id", "invited_user_id", "date");

-- ----------------------------
-- Primary Key structure for table training
-- ----------------------------
ALTER TABLE "db"."training" ADD CONSTRAINT "training_pkey" PRIMARY KEY ("training_id");

-- ----------------------------
-- Auto increment value for user_
-- ----------------------------
SELECT setval('"db"."user_user_id_seq"', 60, true);

-- ----------------------------
-- Primary Key structure for table user_
-- ----------------------------
ALTER TABLE "db"."user_" ADD CONSTRAINT "user__pkey" PRIMARY KEY ("user_id");

-- ----------------------------
-- Auto increment value for user_details
-- ----------------------------
SELECT setval('"db"."user_details_user_details_id_seq"', 55, true);

-- ----------------------------
-- Primary Key structure for table user_details
-- ----------------------------
ALTER TABLE "db"."user_details" ADD CONSTRAINT "user_details_pkey" PRIMARY KEY ("user_details_id");

-- ----------------------------
-- Auto increment value for user_sport
-- ----------------------------
SELECT setval('"db"."user_sport_user_sport_id_seq"', 112, true);

-- ----------------------------
-- Primary Key structure for table user_sport
-- ----------------------------
ALTER TABLE "db"."user_sport" ADD CONSTRAINT "user_sport_pkey" PRIMARY KEY ("user_sport_id");

-- ----------------------------
-- Foreign Keys structure for table rating
-- ----------------------------
ALTER TABLE "db"."rating" ADD CONSTRAINT "rating_rated_user_id_fkey" FOREIGN KEY ("rated_user_id") REFERENCES "db"."user_" ("user_id") ON DELETE CASCADE ON UPDATE NO ACTION;
ALTER TABLE "db"."rating" ADD CONSTRAINT "rating_rating_user_id_fkey" FOREIGN KEY ("rating_user_id") REFERENCES "db"."user_" ("user_id") ON DELETE CASCADE ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Keys structure for table training
-- ----------------------------
ALTER TABLE "db"."training" ADD CONSTRAINT "training_invited_user_id_fkey" FOREIGN KEY ("invited_user_id") REFERENCES "db"."user_" ("user_id") ON DELETE CASCADE ON UPDATE NO ACTION;
ALTER TABLE "db"."training" ADD CONSTRAINT "training_inviting_user_id_fkey" FOREIGN KEY ("inviting_user_id") REFERENCES "db"."user_" ("user_id") ON DELETE CASCADE ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Keys structure for table user_
-- ----------------------------
ALTER TABLE "db"."user_" ADD CONSTRAINT "user__role_id_fkey" FOREIGN KEY ("role_id") REFERENCES "db"."role" ("role_id") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Keys structure for table user_details
-- ----------------------------
ALTER TABLE "db"."user_details" ADD CONSTRAINT "user_details_city_id_fkey" FOREIGN KEY ("city_id") REFERENCES "db"."city" ("city_id") ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE "db"."user_details" ADD CONSTRAINT "user_details_user_id_fkey" FOREIGN KEY ("user_id") REFERENCES "db"."user_" ("user_id") ON DELETE CASCADE ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Keys structure for table user_sport
-- ----------------------------
ALTER TABLE "db"."user_sport" ADD CONSTRAINT "user_sport_sport_id_fkey" FOREIGN KEY ("sport_id") REFERENCES "db"."sport" ("sport_id") ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE "db"."user_sport" ADD CONSTRAINT "user_sport_user_id_fkey" FOREIGN KEY ("user_id") REFERENCES "db"."user_" ("user_id") ON DELETE CASCADE ON UPDATE NO ACTION;
