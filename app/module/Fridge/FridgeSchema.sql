create table fridge_username(
    itemID int auto_increment,
    itemName varchar(100) NOT NULL,
    itemAmount int NOT NULL,
    expireDate date NOT NULL,

    PRIMARY KEY(itemID)
)
