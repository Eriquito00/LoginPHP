INSERT INTO roles (role_name) VALUES ('admin'), ('user'), ('moderator');

INSERT INTO users (username, email, role_id, password) VALUES
('admin', 'admin@example.com', 1, 'adminpass'),
('user1', 'user1@example.com', 2, 'user1pass'),
('user2', 'user2@example.com', 2, 'user2pass'),
('mod1', 'mod1@example.com', 3, 'mod1pass'),
('user3', 'user3@example.com', 2, 'user3pass');

INSERT INTO recomendations (user_id, title, description, image_url) VALUES
(2, 'Recomendación 1', 'Descripción de la recomendación 1', 'img1.jpg');

INSERT INTO recomendations (user_id, title, description, image_url) VALUES
(2, 'Recomendación 2', 'Descripción de la recomendación 2', 'img2.jpg');

INSERT INTO recomendations (user_id, title, description, image_url) VALUES
(2, 'Recomendación 3', 'Descripción de la recomendación 3', 'img3.jpg');

INSERT INTO recomendations (user_id, title, description, image_url) VALUES
(3, 'Recomendación 4', 'Descripción de la recomendación 4', 'img4.jpg');

INSERT INTO recomendations (user_id, title, description, image_url) VALUES
(3, 'Recomendación 5', 'Descripción de la recomendación 5', 'img5.jpg');

INSERT INTO recomendations (user_id, title, description, image_url) VALUES
(3, 'Recomendación 6', 'Descripción de la recomendación 6', 'img6.jpg');

INSERT INTO recomendations (user_id, title, description, image_url) VALUES
(4, 'Recomendación 7', 'Descripción de la recomendación 7', 'img7.jpg');

INSERT INTO recomendations (user_id, title, description, image_url) VALUES
(4, 'Recomendación 8', 'Descripción de la recomendación 8', 'img8.jpg');

INSERT INTO recomendations (user_id, title, description, image_url) VALUES
(4, 'Recomendación 9', 'Descripción de la recomendación 9', 'img9.jpg');

INSERT INTO recomendations (user_id, title, description, image_url) VALUES
(5, 'Recomendación 10', 'Descripción de la recomendación 10', 'img10.jpg');

INSERT INTO recomendations (user_id, title, description, image_url) VALUES
(5, 'Recomendación 11', 'Descripción de la recomendación 11', 'img11.jpg');

INSERT INTO recomendations (user_id, title, description, image_url) VALUES
(5, 'Recomendación 12', 'Descripción de la recomendación 12', 'img12.jpg');

INSERT INTO recomendations (user_id, title, description, image_url) VALUES
(2, 'Recomendación 13', 'Descripción de la recomendación 13', 'img13.jpg');

INSERT INTO recomendations (user_id, title, description, image_url) VALUES
(3, 'Recomendación 14', 'Descripción de la recomendación 14', 'img14.jpg');

INSERT INTO recomendations (user_id, title, description, image_url) VALUES
(4, 'Recomendación 15', 'Descripción de la recomendación 15', 'img15.jpg');

INSERT INTO recomendations (user_id, title, description, image_url) VALUES
(2, 'One Piece: Mi opinión', 'La historia de One Piece es increíblemente extensa y llena de personajes memorables. Recomiendo ver el arco de Enies Lobby.', 'onepiece.jpg');

INSERT INTO recomendations (user_id, title, description, image_url) VALUES
(3, 'Ataque a los titanes', 'Shingeki no Kyojin tiene una animación brutal y una trama que te mantiene pegado al asiento. El final es polémico pero vale la pena.', 'aot.jpg');

INSERT INTO recomendations (user_id, title, description, image_url) VALUES
(4, 'Death Note: Recomendación', 'Death Note es perfecto para quienes disfrutan los thrillers psicológicos. La batalla intelectual entre Light y L es lo mejor.', 'deathnote.jpg');

INSERT INTO recomendations (user_id, title, description, image_url) VALUES
(5, 'Naruto: Nostalgia', 'Naruto marcó mi infancia. Sus enseñanzas sobre la perseverancia y la amistad son muy valiosas. El arco de Pain es mi favorito.', 'naruto.jpg');

INSERT INTO recomendations (user_id, title, description, image_url) VALUES
(2, 'Jujutsu Kaisen', 'Jujutsu Kaisen destaca por sus peleas y personajes carismáticos. Satoru Gojo es simplemente épico.', 'jujutsu.jpg');

INSERT INTO recomendations (user_id, title, description, image_url) VALUES
(3, 'Demon Slayer', 'Kimetsu no Yaiba tiene una animación espectacular y una banda sonora que emociona. El arco del tren infinito es imprescindible.', 'demonslayer.jpg');

INSERT INTO recomendations (user_id, title, description, image_url) VALUES
(4, 'Mob Psycho 100', 'Mob Psycho 100 es divertido y profundo a la vez. El desarrollo de Mob como personaje es muy inspirador.', 'mobpsycho.jpg');

INSERT INTO recomendations (user_id, title, description, image_url) VALUES
(5, 'Fullmetal Alchemist', 'Fullmetal Alchemist Brotherhood es una obra maestra del anime. La historia y los valores que transmite son geniales.', 'fma.jpg');

INSERT INTO recomendations (user_id, title, description, image_url) VALUES
(2, 'Spy x Family', 'Spy x Family es una comedia familiar con acción y ternura. Anya es el alma de la serie.', 'spyxfamily.jpg');

INSERT INTO recomendations (user_id, title, description, image_url) VALUES
(3, 'Dragon Ball Z', 'Dragon Ball Z es el clásico de los clásicos. Las batallas y la evolución de Goku son legendarias.', 'dbz.jpg');

INSERT INTO recomendations (user_id, title, description, image_url) VALUES
(4, 'Haikyuu!!', 'Haikyuu!! te motiva a superarte y trabajar en equipo. Los partidos de voleibol son emocionantes.', 'haikyuu.jpg');

INSERT INTO recomendations (user_id, title, description, image_url) VALUES
(5, 'Tokyo Ghoul', 'Tokyo Ghoul tiene una atmósfera oscura y una historia trágica. Kaneki es un personaje muy complejo.', 'tokyoghoul.jpg');

INSERT INTO recomendations (user_id, title, description, image_url) VALUES
(2, 'My Hero Academia', 'Boku no Hero Academia es ideal para quienes aman los superhéroes. El desarrollo de Deku es muy bueno.', 'mha.jpg');

INSERT INTO recomendations (user_id, title, description, image_url) VALUES
(3, 'Hunter x Hunter', 'Hunter x Hunter tiene una narrativa excelente y personajes profundos. El arco de las hormigas quimera es brutal.', 'hxh.jpg');

INSERT INTO recomendations (user_id, title, description, image_url) VALUES
(4, 'Re:Zero', 'Re:Zero juega con los viajes en el tiempo y el sufrimiento del protagonista. Muy recomendable para fans del drama.', 'rezero.jpg');