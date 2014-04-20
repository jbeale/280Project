
create table recipe(
    recID int auto_increment,
    recName varchar(100) NOT NULL,
    ingred TEXT NOT NULL,
    instruct TEXT NOT NULL,
    image varchar(50) NOT NULL,
    difficulty int NOT NULL,
    prepTime varchar(20) NOT NULL,
    cookTime varchar(20) NOT NULL,
    username varchar(50) NOT NULL,

    PRIMARY KEY(recID)
)

create table gluttenFree(
    recID int,

    PRIMARY KEY(recID)
)
