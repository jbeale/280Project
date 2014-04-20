create table fridge(
    
    itemID int auto_increment,
    userID int NOT NULL,
    itemName varchar(100) NOT NULL,
    --itemAmount float(15,2) NOT NULL,
    itemAmount int NOT NULL,
    amountType varchar(15) NOT NULL,
    expireDate date NOT NULL,

    PRIMARY KEY(itemID)
)
