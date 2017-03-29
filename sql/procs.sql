DELIMITER $$

DROP PROCEDURE IF EXISTS buy_AddLink$$

CREATE PROCEDURE buy_AddLink(IN l VARCHAR(32), OUT id INT)
	BEGIN

		SET id := (SELECT link_id FROM links WHERE link = l LIMIT 1);

		IF (id IS NULL) THEN

			INSERT INTO links
				(
					link,
					creation_date
				)
			VALUES
				(
					l,
					NOW()
				);

			SET id = LAST_INSERT_ID();

		END IF;
		
	END$$

DELIMITER ;


DELIMITER $$

DROP PROCEDURE IF EXISTS buy_AddItem$$

CREATE PROCEDURE buy_AddItem(IN nm VARCHAR(128), OUT id INT)
	BEGIN

		SET id := (SELECT item_id FROM items WHERE name = nm LIMIT 1);

		IF (id IS NULL) THEN

			INSERT INTO items
				(
					name
				)
			VALUES
				(
					nm
				);

			SET id = LAST_INSERT_ID();
		
		END IF;

	END$$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS buy_AddNewLine$$

CREATE PROCEDURE buy_AddNewLine(IN l VARCHAR(32), IN nm VARCHAR(128), IN cnt TINYINT)
BEGIN
	CALL buy_AddLink(l,@link_id);

	CALL buy_AddItem(nm,@item_id);

	INSERT INTO items_list
		(
			link_id,
			item_id,
			count
		)
	VALUES
		(
			@link_id,
			@item_id,
			cnt
		);

END$$

DELIMITER ;


DELIMITER $$


DROP PROCEDURE IF EXISTS buy_GetList$$

CREATE PROCEDURE buy_GetList(IN l VARCHAR(32))
BEGIN

	DECLARE lid INT;
	SET lid := (SELECT link_id FROM links WHERE link = l LIMIT 1);

	SELECT
		items.name,
		items_list.count
	FROM items_list
	INNER JOIN
		items
	ON items_list.link_id = lid
		AND items_list.item_id = items.item_id;

END$$


DELIMITER ;