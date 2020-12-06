DROP PROCEDURE IF EXISTS levenshtein_ratio;

CREATE FUNCTION levenshtein_ratio( s1 VARCHAR(255), s2 VARCHAR(255) )
	RETURNS INT
DETERMINISTIC
	BEGIN
		DECLARE s1_len, s2_len, max_len INT;
		SET s1_len = LENGTH(s1), s2_len = LENGTH(s2);
		IF s1_len > s2_len THEN
			SET max_len = s1_len;
		ELSE
			SET max_len = s2_len;
		END IF;
		RETURN ROUND((1 - LEVENSHTEIN(s1, s2) / max_len) * 100);
	END;
