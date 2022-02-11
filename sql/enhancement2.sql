--Query 1 
INSERT INTO clients (clientFirstname, clientLastname,clientEmail, clientPassword, clientLevel, comment ) Values ('Tony', 'Stark', 'tony@starkent.com', 'IamIronMan',1,'I am the real Iron Man');

--Query 2 
UPDATE clients SET clientLevel = 3 WHERE clientId = 1;


--Query 3 
UPDATE inventory
SET invDescription = REPLACE(invDescription, 'small interior', 'spacious interior') 
WHERE invId = 12;

--Query 4
SELECT invModel, classificationName
from inventory
INNER JOIN carclassification ON
carclassification.classificationId=inventory.classificationId
WHERE inventory.classificationId = 1;

--Query 5
delete from inventory WHERE invId = 1;

--Query 6 
UPDATE inventory
SET invImage = concat('/phpmotors', invImage), invThumbnail = concat('/phpmotors', invThumbnail);

