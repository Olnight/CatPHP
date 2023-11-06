INSERT Category ( name, sym_code)
    VALUES( 'Одежда', 'clothing'),
    ( 'Ботинки', 'boots'),
    ( 'Доски и лыжи', 'boards'),
    ( 'Крепления', 'attachment'),
    ( 'Инструменты', 'tools'),
    ('Разное', 'other');

INSERT User ( email, name, contact, password)
    VALUES ( 'user@gmail.com', 'Dima', '89123452398','1'),
    ( 'user2@gmail.com', 'Tom', '89123432654','2');

INSERT Lot ( name, description, picture, start_price, date_end, rate_step, creator_id, category_id)
    VALUES ( '2014 Rossignol District Snowboard', 'Сноуборд', 'img/lot-1.jpg', '10999', '2023-12-25', 100, 1, 3),
    ( 'DC Ply Mens 2016/2017 Snowboard', 'Сноуборд', 'img/lot-2.jpg', '159999', '2023-12-15', 100, 2, 3),
    ( 'Крепления Union Contact Pro 2015 года размер L/XL', 'Крепления', 'img/lot-3.jpg', '8000', '2023-10-25', 100, 1, 4),
    ( 'Ботинки для сноуборда DC Mutiny Charoca', 'Ботиночки', 'img/lot-4.jpg', '10999', '2023-11-25', 100, 1, 2),
    ( 'Куртка для сноуборда DC Mutiny Charocal', 'Куртка', 'img/lot-5.jpg', '7500', '2023-12-20', 100, 2, 1),
    ( 'Маска Oakley Canopy', 'Маска', 'img/lot-6.jpg', '5400', '2023-12-10', 100, 1, 5);


INSERT Bet(  sum, lot_id, user_id)
    VALUES ( 12000, 1, 2),
    ( 13200, 3, 2);

#Получить список всех категорий
SELECT id, name, sym_code FROM Category;

#получить cписок лотов, которые еще не истекли отсортированных по дате публикации, 
#от новых к старым. Каждый лот должен включать название,
#стартовую цену, ссылку на изображение, название категории и дату окончания торгов;
SELECT Lot.id,  Lot.name as name_lot, picture, start_price, date_end, Category.name FROM Lot
    INNER JOIN Category ON Lot.category_id = Category.id
    WHERE date_end >= CURRENT_DATE ORDER BY date_reg DESC;


#показать информацию о лоте по его ID. Вместо id категории должно выводиться  название категории, к которой принадлежит лот из таблицы категорий;
SELECT Lot.name, description, date_reg, picture, start_price, rate_step, date_end, Category.name FROM Lot
        INNER JOIN Category ON Lot.category_id = Category.id;

#обновить название лота по его идентификатору;
UPDATE Lot SET name = 'name_changed' WHERE id = 1;

#получить список ставок для лота по его идентификатору с сортировкой по дате. 
#Список должен содержать дату и время размещения ставки, цену, 
#по которой пользователь готов приобрести лот, название лота и имя пользователя, сделавшего ставку
SELECT sum, Bet.date_reg, Lot.name, User.name FROM Bet
    INNER JOIN Lot ON Lot.id = Bet.lot_id
    INNER JOIN User ON User.id = Bet.user_id
    WHERE Bet.lot_id = 3 ORDER BY Bet.date_reg DESC;
