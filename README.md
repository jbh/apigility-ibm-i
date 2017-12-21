Apigility for the IBM i
=======================

This is a complete example for Apigility on the IBM i. It includes an example API
service called `EcommerceUser` that utilizes an Entity and Mapper. The DB2 SQL
for  defining the Apigility Schema, EcommerceUser Table, and example values is defined as:

```sql
CREATE SCHEMA APIGILITY ;

/* `FOR COLUMN` allows a long name and short name to be assigned to the column. */
CREATE TABLE APIGILITY/ECOMMERCE_USERS (
    ID FOR COLUMN EUUSERID BIGINT GENERATED ALWAYS AS IDENTITY (
        START WITH 1
        INCREMENT BY 1,
        NO ORDER,
        NO CYCLE,
        NO MINVALUE,
        NO MAXVALUE,
        CACHE 20
    ),

    USERNAME   FOR COLUMN EUUSER  VARCHAR(64) NOT NULL,
    EMAIL      FOR COLUMN EUEMAIL VARCHAR(64) NOT NULL,
    FIRST_NAME FOR COLUMN EUFNAME VARCHAR(32),
    LAST_NAME  FOR COLUMN EULNAME VARCHAR(32),

    CREATED_AT FOR COLUMN EUCRT TIMESTAMP NOT NULL
        DEFAULT CURRENT TIMESTAMP,
    MODIFIED_AT FOR COLUMN EUMOD TIMESTAMP
        FOR EACH ROW ON UPDATE AS ROW CHANGE TIMESTAMP NOT NULL,

    PRIMARY KEY (ID),
    UNIQUE (EMAIL)
) RCDFMT EUFMT ;

/* For Greenscreen applications */
RENAME TABLE APIGILITY/ECOMMERCE_USERS
  TO SYSTEM NAME ECOMMUSERS ;

/* *FILE Object Text Descripton */
LABEL ON TABLE APIGILITY/ECOMMERCE_USERS IS 'ECOMMERCE USERS' ;

/* Field Text Description */
LABEL ON COLUMN APIGILITY/ECOMMERCE_USERS (
    ID          TEXT IS 'ID',
    USERNAME    TEXT IS 'USERNAME',
    EMAIL       TEXT IS 'EMAIL',
    FIRST_NAME  TEXT IS 'FIRST NAME',
    LAST_NAME   TEXT IS 'LAST NAME',
    CREATED_AT  TEXT IS 'CREATED DATE',
    MODIFIED_AT TEXT IS 'LAST MODIFIED'
) ;

/* Field Column Headings */
LABEL ON COLUMN APIGILITY/ECOMMERCE_USERS (
    ID          IS 'ID',
    USERNAME    IS 'USERNAME',
    EMAIL       IS 'EMAIL',
    FIRST_NAME  IS 'FIRST NAME',
    LAST_NAME   IS 'LAST NAME',
    CREATED_AT  IS 'CREATED DATE',
    MODIFIED_AT IS 'LAST MODIFIED'
) ;

/* Inserts to populate ECOMMERCE_USERS with example data */
INSERT INTO APIGILITY/ECOMMERCE_USERS (USERNAME, EMAIL, FIRST_NAME, LAST_NAME)
VALUES ('pip', 'pip@example.com', 'Pip', 'Jenkins') ;

INSERT INTO APIGILITY/ECOMMERCE_USERS (USERNAME, EMAIL, FIRST_NAME, LAST_NAME)
VALUES ('eleanor', 'eleanor@example.com', 'Eleanor', 'Fant') ;

INSERT INTO APIGILITY/ECOMMERCE_USERS (USERNAME, EMAIL, FIRST_NAME, LAST_NAME)
VALUES ('natalya', 'natalya@example.com', 'Natalya', 'Undergrowth') ;
```
