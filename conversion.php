<?php
    $hostnaam = "51.38.112.111";
    $databasenaam = "groep35";
    $gebruikersnaam = "sa";
    $wachtwoord = "Hoi123!!";

    try {
        $pdo = new PDO ("sqlsrv:Server=$hostnaam;ConnectionPooling=0", "$gebruikersnaam", "$wachtwoord");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
    } catch (PDOException $e) {
        echo $e;
    }

    try {
        //ignore_user_abort(true);
        set_time_limit(0);

//        $pdo->exec("CREATE DATABASE Temp35");
        $pdo->exec("use Temp35");

//        $pdo->exec(file_get_contents("SQL/CREATE Tables.sql"));
        echo 'hi';
//        $pdo->exec(mb_convert_encoding(file_get_contents("SQL/CREATE Categorieen.sql"), "UTF-8", "Windows-1252"));
//
//        foreach (array_filter(glob('SQL/*'), 'is_dir') as $dir){
//            echo "<br>dir: $dir</br>";
//            foreach (array_filter(glob($dir . "/*.sql"), 'is_file') as $file){
//                echo "<br>file: $file</br>";
//                $pdo->exec(file_get_contents($file));
//            }
//        }
        $rubricIDChanges = array();
        $parents = array();
        $rubrics = $pdo->query("
            SELECT CAST(ID AS INT) as ID,
            CAST(Name AS VARCHAR(32)) as Name,
            CAST(Parent AS INT) as Parent
            FROM Temp35.dbo.Categorieen
            ORDER BY ID ASC
            ");

        while ($rubric = $rubrics->fetch()) {
            $currentRubricID = $pdo->query("SELECT TOP(1) rubric FROM groep35test2.dbo.TBL_Rubric ORDER BY rubric DESC")->fetch()['rubric'] + 1;
            if ($rubric['ID'] != -1) {
                $pdo->exec("
                SET IDENTITY_INSERT groep35test2.dbo.TBL_Rubric ON
                INSERT INTO groep35test2.dbo.TBL_Rubric (rubric, name, super, sort_number) VALUES
                (" . $currentRubricID . ",
                '" . str_replace("'", "&apos;", $rubric['Name']) . "',
                null,
                0)
                SET IDENTITY_INSERT groep35test2.dbo.TBL_Rubric OFF");
                $rubricIDChanges[$rubric['ID']] = $currentRubricID;
                $parents[$currentRubricID] = $rubric['Parent'];
            } elseif ($pdo->query("SELECT TOP(1) rubric FROM groep35test2.dbo.TBL_Rubric WHERE rubric = -1")->fetch()['rubric'] != -1) {
                $currentRubricID = -1;
                $pdo->exec("
                SET IDENTITY_INSERT groep35test2.dbo.TBL_Rubric ON
                INSERT INTO groep35test2.dbo.TBL_Rubric (rubric, name, super, sort_number) VALUES
                (-1,
                'Root',
                null,
                0)
                SET IDENTITY_INSERT groep35test2.dbo.TBL_Rubric OFF");
                $rubricIDChanges[-1] = -1;
            } else {
                $rubricIDChanges[-1] = -1;
                $currentRubricID = -1;
            }
            $items = $pdo->query("
                SELECT CAST(ID AS BIGINT) as ID,
                       CAST(Titel AS VARCHAR(100)) as Titel,
                       CAST(Beschrijving AS VARCHAR(1000)) as Beschrijving,
                       CASE
                           WHEN (Prijs is null) THEN NULL
                           WHEN (ISNUMERIC(Prijs) = 0) THEN NULL
                            WHEN (Valuta = 'EUR') THEN CONVERT(NUMERIC(9, 2), Prijs)
                            WHEN (Valuta = 'USD') THEN CONVERT(NUMERIC(9, 2), CONVERT(NUMERIC(9,2),Prijs) * 1.15)
                           WHEN (Valuta = 'GBP') THEN CONVERT(NUMERIC(9, 2), CONVERT(NUMERIC(9,2),Prijs) * 0.89)
                           END as Prijs,
                       CAST(Postcode + ' ' + Locatie AS VARCHAR(100)) as adresregel_1
                FROM Temp35.dbo.Items
                WHERE Categorie = " . $rubric['ID']
            );
            while ($item = $items->fetch()) {
                $currentItemID = $pdo->query("SELECT TOP(1) item FROM groep35test2.dbo.TBL_Item ORDER BY item DESC")->fetch()['item'] + 1;
                $pdo->exec("
                SET IDENTITY_INSERT groep35test2.dbo.TBL_Item ON
                INSERT INTO groep35test2.dbo.TBL_Item (item, name, description, price_start, address_line_1)
                SELECT CAST(" . $currentItemID . " AS BIGINT),
                       CAST(Titel AS VARCHAR(100)),
                       CAST('" . strip_tags(preg_replace('/<script\b[^>]*>(.*?)<\/script>/i', "", str_replace("'", "&apos;", $item['Beschrijving']))) . "' AS VARCHAR(1000)),
                       CASE
                           WHEN (Prijs is null) THEN NULL
                           WHEN (ISNUMERIC(Prijs) = 0) THEN NULL
                            WHEN (Valuta = 'EUR') THEN CONVERT(NUMERIC(9, 2), Prijs)
                            WHEN (Valuta = 'USD') THEN CONVERT(NUMERIC(9, 2), CONVERT(NUMERIC(9,2),Prijs) * 1.15)
                           WHEN (Valuta = 'GBP') THEN CONVERT(NUMERIC(9, 2), CONVERT(NUMERIC(9,2),Prijs) * 0.89)
                           END,
                       CAST(Postcode + ' ' + Locatie AS VARCHAR(100))
                FROM Temp35.dbo.Items
                WHERE ID = " . $item['ID'] . "
                
                SET IDENTITY_INSERT groep35test2.dbo.TBL_Item OFF
                ");

                $pdo->exec("
                INSERT INTO groep35test2.dbo.TBL_Auction (moment_start, moment_end, item, is_promoted)
                SELECT GETDATE(),
                       DATEADD(hour, RAND(convert(varbinary, newid()))*24,
                           DATEADD(DAY, RAND(convert(varbinary, newid()))*9+1, GETDATE())),
                       " . $currentItemID . ",
                       CASE WHEN (RAND(convert(varbinary, newid())) > 0.9) THEN 1 ELSE 0 END
                
                FROM Temp35.dbo.Items
                WHERE ID = " . $item['ID']
                );
                $pdo->exec("
                INSERT INTO groep35test2.dbo.TBL_item_in_rubric (item, rubric) VALUES
                (" . $currentItemID . ",
                " . $rubricIDChanges[$rubric['ID']] . ")"
                );
                $images = $pdo->query("SELECT ItemID, IllustratieFile FROM Temp35.dbo.Illustraties where ItemID = " . $item['ID']);
                echo "SELECT ItemID, IllustratieFile FROM Temp35.dbo.Illustraties where ItemID = " . $item['ID'];
                //print_r($images);
                while ($image = $images->fetch()) {

                    //To download all images to your pc:
//            file_put_contents("images/databatch3/" . $image['IllustratieFile'], fopen("http://iproject35.icasites.nl/pics/". $image['IllustratieFile'], 'r'));
                    //After downloading, put them in a folder on the same machine you'll be running the conversion script from.
                    //if (preg_match('/^.*\.(jpg)$/i', $image['IllustratieFile'])) {
                    $sort_number = $pdo->query("SELECT COUNT(*) as sort_number FROM groep35test2.dbo.TBL_Resource WHERE item = " . $currentItemID . " GROUP BY item")->fetch()['sort_number'];
                    echo $statement = "
                  INSERT INTO groep35test2.dbo.TBL_Resource (ITEM, [FILE], MEDIA_TYPE, sort_number) VALUES (
                    " . $currentItemID . ",
                    (SELECT * FROM OPENROWSET(BULK N'/var/www/html/iproject/images/databatch/" . $image['IllustratieFile'] . "', SINGLE_BLOB) as BLOB),
                    'image/jpg',
                    " . ($sort_number ? $sort_number : 0) . "
                )"; echo $sort_number;
                    $pdo->exec($statement);
                }
                //}
                $currentItemID++;
            }
            $currentRubricID++;
        }

        foreach ($parents as $rubric => $parent) {
            $pdo->exec("
            UPDATE groep35test2.dbo.TBL_Rubric SET super = " . (isset($rubricIDChanges[$parent]) ? $rubricIDChanges[$parent] : "null") . "
            WHERE rubric = " . $rubric
            );

        }

        /*$oldIDs = array();
        foreach ($rubricIDChanges as $old => $new) {
            $oldIDs[] = $old;
        }
        $images = $pdo->query("SELECT ItemID, IllustratieFile FROM Temp35.dbo.Illustraties  where ItemID in (" . implode(", ", $oldIDs) . ")order by ItemID DESC");
        echo "SELECT ItemID, IllustratieFile FROM Temp35.dbo.Illustraties  where ItemID in (" . implode(", ", $oldIDs) . ")order by ItemID DESC";
        print_r($images);
        while ($image = $images->fetch()) {

            //To download all images to your pc:
//            file_put_contents("images/databatch3/" . $image['IllustratieFile'], fopen("http://iproject35.icasites.nl/pics/". $image['IllustratieFile'], 'r'));
            //After downloading, put them in a folder on the same machine you'll be running the conversion script from.
            if (preg_match('/^.*\.(jpg)$/i', $image['IllustratieFile'])) {
                echo "
                  INSERT INTO groep35test2.dbo.TBL_Resource (ITEM, [FILE], MEDIA_TYPE) VALUES (
                    " . $rubricIDChanges[$image['ItemID']] . ",
                    (SELECT * FROM OPENROWSET(BULK N'/var/www/html/iproject/images/databatch final/" . $image['IllustratieFile'] . "', SINGLE_BLOB) as BLOB),
                    'image/jpg'
                )";
                $pdo->exec("
                  INSERT INTO groep35test2.dbo.TBL_Resource (ITEM, [FILE], MEDIA_TYPE) VALUES (
                    " . $rubricIDChanges[$image['ItemID']] . ",
                    (SELECT * FROM OPENROWSET(BULK N'/var/www/html/iproject/images/databatch final/" . $image['IllustratieFile'] . "', SINGLE_BLOB) as BLOB),
                    'image/jpg'
                )");
            }
        }*/

        //$pdo->exec("DROP DATABASE Temp35");
    } catch (PDOException $e) {
        echo $e;
    }


?>