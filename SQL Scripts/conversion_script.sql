use master

-- INSERT INTO groep35test.dbo.TBL_User ([user], firstname, lastname, address_line_1, address_line_2, email, password, is_seller, is_verified, verification_code)
--     SELECT Username,
--
--
-- FROM databatch35.dbo.TBL_User


SET IDENTITY_INSERT groep35test2.dbo.TBL_Rubric ON
insert into groep35test2.dbo.TBL_Rubric (rubric, name, super)
SELECT CAST(ID AS INT),
       CAST(Name AS VARCHAR(32)),
       CAST(Parent AS INT)
FROM databatch35.dbo.Categorieen
SET IDENTITY_INSERT groep35test2.dbo.TBL_Rubric OFF

SET IDENTITY_INSERT groep35test2.dbo.TBL_Item ON
INSERT INTO groep35test2.dbo.TBL_Item (item, name, description, price_start/*, shipping_cost*//*, shipping_instructions*/,
                                      address_line_1)
SELECT CAST(ID AS BIGINT),
       CAST(Titel AS VARCHAR(100)),
       CAST(Beschrijving AS VARCHAR(1000)),
       CASE
           WHEN (Prijs is null) THEN NULL
           WHEN (ISNUMERIC(Prijs) = 0) THEN NULL
            WHEN (Valuta = 'EUR') THEN CONVERT(NUMERIC(9, 2), Prijs)
            WHEN (Valuta = 'USD') THEN CONVERT(NUMERIC(9, 2), CONVERT(NUMERIC(9,2),Prijs) * 1.15)
           WHEN (Valuta = 'GBP') THEN CONVERT(NUMERIC(9, 2), CONVERT(NUMERIC(9,2),Prijs) * 0.89)
           END,
       CAST(Postcode + ' ' + Locatie AS VARCHAR(100))
FROM databatch35.dbo.Items

SET IDENTITY_INSERT groep35test2.dbo.TBL_Item OFF

INSERT INTO groep35test2.dbo.TBL_Auction (moment_start, moment_end, item, is_promoted)
SELECT GETDATE(),
       DATEADD(hour, RAND(convert(varbinary, newid()))*24,
           DATEADD(DAY, RAND(convert(varbinary, newid()))*9+1, GETDATE())),
       ID,
       CASE WHEN (RAND(convert(varbinary, newid())) > 0.9) THEN 1 ELSE 0 END

FROM databatch35.dbo.Items


INSERT INTO groep35test2.dbo.TBL_Resource (ITEM, [FILE], MEDIA_TYPE)
SELECT ItemID,
       (SELECT * FROM OPENROWSET(BULK N'C:\img\' + IllustratieFile, SINGLE_BLOB) as T1),
       CASE WHEN IllustratieFile LIKE '%.jpg' THEN 'image/jpg' ELSE NULL END
       --(SELECT COUNT(*) FROM groep35test2.dbo.TBL_Resource WHERE item = ItemID)

FROM databatch35.dbo.Illustraties

-- DELETE FROM groep35test2.dbo.TBL_Auction