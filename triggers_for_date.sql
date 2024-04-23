--trigger for wishlist created and updated
COMMIT;
CREATE OR REPLACE TRIGGER wishlist_created
BEFORE INSERT ON "WISHLIST"
FOR EACH ROW
BEGIN 
    IF :NEW.w_created_date IS NULL THEN
        SELECT SYSDATE INTO :NEW.w_created_date FROM SYS.DUAL;
    END IF;
END;
/

COMMIT;
CREATE OR REPLACE TRIGGER wishlist_created
BEFORE INSERT ON "WISHLIST"
FOR EACH ROW
BEGIN 
    IF :NEW.w_update_date IS NULL THEN
        SELECT SYSDATE INTO :NEW.w_update_date FROM SYS.DUAL;
    END IF;
END;
/

--trigger for cart created and updated
COMMIT;
CREATE OR REPLACE TRIGGER cart_created
BEFORE INSERT ON "CART"
FOR EACH ROW
BEGIN 
    IF :NEW.cart_created IS NULL THEN
        SELECT SYSDATE INTO :NEW.cart_created FROM SYS.DUAL;
    END IF;
END;
/

COMMIT;
CREATE OR REPLACE TRIGGER cart_updated
BEFORE INSERT ON "CART"
FOR EACH ROW
BEGIN 
    IF :NEW.cart_updated IS NULL THEN
        SELECT SYSDATE INTO :NEW.cart_updated FROM SYS.DUAL;
    END IF;
END;
/

--trigger for payment time and date merged into only one attribute name pay_date
COMMIT;
CREATE OR REPLACE TRIGGER payment_date
BEFORE INSERT ON "PAYMENT"
FOR EACH ROW
BEGIN 
    IF :NEW.pay_date IS NULL THEN
        SELECT CURRENT_TIMESTAMP(3) INTO :NEW.pay_date FROM SYS.DUAL;
    END IF;
END;
/

--trigger for report time and date merged into only one attribute name r_date
COMMIT;
CREATE OR REPLACE TRIGGER report_date
BEFORE INSERT ON "REPORT"
FOR EACH ROW
BEGIN 
    IF :NEW.r_date IS NULL THEN
        SELECT CURRENT_TIMESTAMP(3) INTO :NEW.r_date FROM SYS.DUAL;
    END IF;
END;
/

--trigger for review time and date merged into only one attribute name review_date
COMMIT;
CREATE OR REPLACE TRIGGER reviewss_date
BEFORE INSERT ON "REVIEW"
FOR EACH ROW
BEGIN 
    IF :NEW.review_date IS NULL THEN
        SELECT CURRENT_TIMESTAMP(3) INTO :NEW.review_date FROM SYS.DUAL;
    END IF;
END;
/