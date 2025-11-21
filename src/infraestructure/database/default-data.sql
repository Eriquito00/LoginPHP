INSERT INTO usuarios (username, email, password)
VALUES
    ('user1', 'user1@example.com', '0b14d501a594442a01c6859541bcb3e8164d183d32937b851835442f69d5c94e'),
    ('user2', 'user2@example.com', '6cf615d5bcaac778352a8f1f3360d23f02f34ec182e259897fd6ce485d7870d4');

INSERT INTO recomendaciones (user_id, title, description, image)
VALUES
    (1, 'Recomendación 1-1', 'Descripción de la recomendación 1 para el usuario 1', ''),
    (1, 'Recomendación 1-2', 'Descripción de la recomendación 2 para el usuario 1', ''),
    (1, 'Recomendación 1-3', 'Descripción de la recomendación 3 para el usuario 1', ''),
    (1, 'Recomendación 1-4', 'Descripción de la recomendación 4 para el usuario 1', ''),
    (1, 'Recomendación 1-5', 'Descripción de la recomendación 5 para el usuario 1', '');

INSERT INTO recomendaciones (user_id, title, description, image)
VALUES
    (2, 'Recomendación 2-1', 'Descripción de la recomendación 1 para el usuario 2', ''),
    (2, 'Recomendación 2-2', 'Descripción de la recomendación 2 para el usuario 2', ''),
    (2, 'Recomendación 2-3', 'Descripción de la recomendación 3 para el usuario 2', ''),
    (2, 'Recomendación 2-4', 'Descripción de la recomendación 4 para el usuario 2', ''),
    (2, 'Recomendación 2-5', 'Descripción de la recomendación 5 para el usuario 2', '');